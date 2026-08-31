<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeederManagementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [AdminController::class, 'dashboard'])
    ->name('dashboard');

Route::resource('users', UserController::class);

Route::resource('products', ProductController::class);

Route::resource('categories', CategoryController::class);

Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile');

Route::put('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');

/*
|--------------------------------------------------------------------------
| Seeder Management
|--------------------------------------------------------------------------
*/

Route::get('/seeders', [SeederManagementController::class, 'index'])
    ->name('seeders.index');

Route::post('/seeders/run', [SeederManagementController::class, 'run'])
    ->name('seeders.run');

Route::post('/seeders/seed-all', [SeederManagementController::class, 'seedAll'])
    ->name('seeders.seed-all');

Route::post('/seeders/reset-reseed', [SeederManagementController::class, 'resetAndReseed'])
    ->name('seeders.reset-reseed');