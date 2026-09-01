<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\View\View;

class ProductController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Product List
    |--------------------------------------------------------------------------
    */

    public function index(Request $request): View
    {
        $query = Product::with('category');

        /*
        |--------------------------------------------------------------------------
        | Search
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Category Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        /*
        |--------------------------------------------------------------------------
        | Featured Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('featured')) {
            if ($request->featured === 'yes') {
                $query->where('featured', true);
            }

            if ($request->featured === 'no') {
                $query->where('featured', false);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Stock Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('stock')) {
            if ($request->stock === 'low') {
                $query->where('stock', '<=', 5);
            }

            if ($request->stock === 'out') {
                $query->where('stock', 0);
            }

            if ($request->stock === 'available') {
                $query->where('stock', '>', 0);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Sorting
        |--------------------------------------------------------------------------
        */

        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;

                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;

                case 'stock_asc':
                    $query->orderBy('stock', 'asc');
                    break;

                case 'stock_desc':
                    $query->orderBy('stock', 'desc');
                    break;

                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;

                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;

                case 'oldest':
                    $query->oldest();
                    break;

                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $products = $query
            ->paginate(5)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact(
            'products',
            'categories'
        ));
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('products.create', compact('categories'));
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'featured' => ['nullable', 'boolean'],
            'status' => ['required', 'in:active,inactive'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:2048'
            ],
            'image_url' => ['nullable', 'url'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('products', 'public');
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        }

        unset($validated['image_url']);

        $validated['featured'] = $request->boolean('featured');

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */

    public function edit(Product $product): View
    {
        $categories = Category::orderBy('name')->get();

        return view(
            'products.edit',
            compact('product', 'categories')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'featured' => ['nullable', 'boolean'],
            'status' => ['required', 'in:active,inactive'],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,webp',
                'max:2048'
            ],
            'image_url' => ['nullable', 'url'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('products', 'public');
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        }

        unset($validated['image_url']);

        $validated['featured'] = $request->boolean('featured');

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Product updated successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Single Product
    |--------------------------------------------------------------------------
    */

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Bulk Delete Products
    |--------------------------------------------------------------------------
    */

    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'product_ids' => ['required', 'array'],
            'product_ids.*' => ['integer', 'exists:products,id'],
        ]);

        $count = Product::whereIn(
            'id',
            $validated['product_ids']
        )->delete();

        return redirect()
            ->route('products.index')
            ->with(
                'success',
                "{$count} product(s) deleted successfully."
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Export Products CSV
    |--------------------------------------------------------------------------
    */
public function export(Request $request)
{
    $query = Product::with('category');

    if ($request->filled('search')) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        });
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    if ($request->filled('featured')) {
        $query->where('featured', $request->featured);
    }

    if ($request->filled('sort')) {
        if ($request->sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($request->sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($request->sort === 'newest') {
            $query->latest();
        }
    }

    $products = $query->get();

    $fileName = 'products-' . now()->format('Y-m-d-H-i-s') . '.csv';

    return response()->streamDownload(function () use ($products) {
        $handle = fopen('php://output', 'w');

        fputcsv($handle, [
            'ID',
            'Name',
            'Category',
            'Description',
            'Price',
            'Stock',
            'Featured',
            'Status',
            'Created At',
        ]);

        foreach ($products as $product) {
            fputcsv($handle, [
                $product->id,
                $product->name,
                $product->category?->name ?? '',
                $product->description ?? '',
                $product->price,
                $product->stock,
                $product->featured ? 'Yes' : 'No',
                ucfirst($product->status),
                $product->created_at?->format('Y-m-d H:i:s'),
            ]);
        }

        fclose($handle);
    }, $fileName, [
        'Content-Type' => 'text/csv',
    ]);
}
}