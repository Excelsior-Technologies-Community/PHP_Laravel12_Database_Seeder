<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with('category')->latest();

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

        if ($request->filled('sort')) {
            if ($request->sort === 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort === 'price_desc') {
                $query->orderBy('price', 'desc');
            } elseif ($request->sort === 'newest') {
                $query->latest();
            }
        }

        $products = $query->paginate(10)->withQueryString();
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'image_url' => ['nullable', 'url'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        }

        unset($validated['image_url']);
        $validated['featured'] = $request->boolean('featured');

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product): View
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
    }

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
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'image_url' => ['nullable', 'url'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        } elseif (!empty($validated['image_url'])) {
            $validated['image'] = $validated['image_url'];
        }

        unset($validated['image_url']);
        $validated['featured'] = $request->boolean('featured');

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
