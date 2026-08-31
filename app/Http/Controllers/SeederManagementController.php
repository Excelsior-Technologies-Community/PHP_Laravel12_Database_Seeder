<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SeederRun;
use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ProductSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Throwable;

class SeederManagementController extends Controller
{
    /**
     * Display the seeder management dashboard.
     */
    public function index()
    {
        $statistics = [
            'users' => User::count(),
            'categories' => Category::count(),
            'products' => Product::count(),
        ];

        $seeders = [
            [
                'name' => 'Admin User Seeder',
                'class' => AdminUserSeeder::class,
                'description' => 'Creates the default administrator account.',
            ],
            [
                'name' => 'Category Seeder',
                'class' => CategorySeeder::class,
                'description' => 'Creates the default product categories.',
            ],
            [
                'name' => 'Product Seeder',
                'class' => ProductSeeder::class,
                'description' => 'Creates the sample product catalog.',
            ],
        ];

        $recentRuns = SeederRun::latest()->take(10)->get();

        return view('seeders.index', compact(
            'statistics',
            'seeders',
            'recentRuns'
        ));
    }

    /**
     * Run one specific seeder.
     */
    public function run(Request $request)
    {
        $validated = $request->validate([
            'seeder' => [
                'required',
                'in:admin,category,product',
            ],
        ]);

        $seederMap = [
            'admin' => [
                'name' => 'Admin User Seeder',
                'class' => AdminUserSeeder::class,
            ],
            'category' => [
                'name' => 'Category Seeder',
                'class' => CategorySeeder::class,
            ],
            'product' => [
                'name' => 'Product Seeder',
                'class' => ProductSeeder::class,
            ],
        ];

        $selectedSeeder = $seederMap[$validated['seeder']];

        /*
         * ProductSeeder requires categories to exist.
         */
        if ($validated['seeder'] === 'product' && Category::count() === 0) {
            return redirect()
                ->route('seeders.index')
                ->with(
                    'error',
                    'Cannot run Product Seeder because no categories exist. Run Category Seeder first.'
                );
        }

        $run = SeederRun::create([
            'seeder_name' => $selectedSeeder['name'],
            'status' => 'running',
            'started_at' => now(),
        ]);

        try {
            Artisan::call(
                'db:seed',
                [
                    '--class' => $selectedSeeder['class'],
                    '--force' => true,
                ]
            );

            $output = trim(Artisan::output());

            $run->update([
                'status' => 'success',
                'message' => $output ?: 'Seeder executed successfully.',
                'completed_at' => now(),
            ]);

            return redirect()
                ->route('seeders.index')
                ->with(
                    'success',
                    $selectedSeeder['name'] . ' executed successfully.'
                );
        } catch (Throwable $e) {
            $run->update([
                'status' => 'failed',
                'message' => $e->getMessage(),
                'completed_at' => now(),
            ]);

            return redirect()
                ->route('seeders.index')
                ->with(
                    'error',
                    'Seeder failed: ' . $e->getMessage()
                );
        }
    }

    /**
     * Run all project seeders.
     */
    public function seedAll()
    {
        $run = SeederRun::create([
            'seeder_name' => 'All Seeders',
            'status' => 'running',
            'started_at' => now(),
        ]);

        try {
            DB::transaction(function () {
                Artisan::call('db:seed', [
                    '--force' => true,
                ]);
            });

            $output = trim(Artisan::output());

            $run->update([
                'status' => 'success',
                'message' => $output ?: 'All seeders executed successfully.',
                'completed_at' => now(),
            ]);

            return redirect()
                ->route('seeders.index')
                ->with(
                    'success',
                    'All seeders executed successfully.'
                );
        } catch (Throwable $e) {
            $run->update([
                'status' => 'failed',
                'message' => $e->getMessage(),
                'completed_at' => now(),
            ]);

            return redirect()
                ->route('seeders.index')
                ->with(
                    'error',
                    'Seeding failed: ' . $e->getMessage()
                );
        }
    }

    /**
     * Reset application data and reseed everything.
     *
     * This does NOT run migrate:fresh.
     * It only removes records from the application's
     * users, categories and products tables.
     */
    public function resetAndReseed(Request $request)
    {
        $validated = $request->validate([
            'confirmation' => [
                'required',
                'in:RESET',
            ],
        ]);

        if ($validated['confirmation'] !== 'RESET') {
            return redirect()
                ->route('seeders.index')
                ->with('error', 'Reset confirmation failed.');
        }

        $run = SeederRun::create([
            'seeder_name' => 'Reset & Reseed',
            'status' => 'running',
            'started_at' => now(),
        ]);

        try {
            DB::transaction(function () {
                /*
                 * Delete dependent data first.
                 * Products depend on categories.
                 */
                Product::query()->delete();

                Category::query()->delete();

                User::query()->delete();

                /*
                 * Run the complete DatabaseSeeder.
                 *
                 * DatabaseSeeder creates:
                 * - factory users
                 * - categories
                 * - products
                 * - admin user
                 */
                Artisan::call('db:seed', [
                    '--force' => true,
                ]);
            });

            $output = trim(Artisan::output());

            $run->update([
                'status' => 'success',
                'message' => $output ?: 'Database reset and reseeded successfully.',
                'completed_at' => now(),
            ]);

            return redirect()
                ->route('seeders.index')
                ->with(
                    'success',
                    'Database reset and reseeded successfully.'
                );
        } catch (Throwable $e) {
            $run->update([
                'status' => 'failed',
                'message' => $e->getMessage(),
                'completed_at' => now(),
            ]);

            return redirect()
                ->route('seeders.index')
                ->with(
                    'error',
                    'Reset & Reseed failed: ' . $e->getMessage()
                );
        }
    }
}