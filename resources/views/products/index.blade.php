<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; color: #111827; }
        .container { max-width: 1250px; margin: 32px auto; padding: 0 20px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        nav a { text-decoration: none; color: #111827; margin-left: 15px; font-weight: 600; }
        .panel { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .toolbar { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 16px; }
        .toolbar form { display: flex; gap: 10px; flex-wrap: wrap; }
        .btn { display: inline-block; text-decoration: none; padding: 10px 16px; border-radius: 8px; background: #111827; color: white; }
        .btn.secondary { background: #e5e7eb; color: #111827; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        img { width: 60px; height: 60px; object-fit: cover; border-radius: 10px; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 999px; background: #dcfce7; color: #166534; }
        .badge.inactive { background: #fee2e2; color: #991b1b; }
        .actions a, .actions button { margin-right: 8px; text-decoration: none; color: #111827; }
        .actions button { background: #dc2626; color: white; border: none; padding: 8px 10px; border-radius: 6px; cursor: pointer; }
        form.inline { display: inline; }
        input, select { padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; }
        .pagination { list-style: none; padding: 0; margin: 20px 0 0; display: flex; justify-content: flex-end; gap: 8px; flex-wrap: wrap; }
        .pagination li { display: inline-block; }
        .pagination a, .pagination span { display: inline-flex; align-items: center; justify-content: center; min-width: 38px; min-height: 38px; padding: 0 12px; border-radius: 8px; border: 1px solid #d1d5db; background: white; color: #111827; text-decoration: none; }
        .pagination .active span { background: #111827; color: white; border-color: #111827; }
        .pagination .disabled span { opacity: 0.45; }
    </style>
</head>
<body>
<div class="container">
    <div class="topbar">
        <h2>Products</h2>
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('users.index') }}">Users</a>
            <a href="{{ route('categories.index') }}">Categories</a>
            <a href="{{ route('profile') }}">Profile</a>
        </nav>
    </div>

    <div class="panel">
        <div class="toolbar">
            <a href="{{ route('products.create') }}" class="btn">Add Product</a>
            <form method="GET" action="{{ route('products.index') }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product">
                <select name="category_id">
                    <option value="">All categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                <select name="status">
                    <option value="">All status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                <select name="sort">
                    <option value="">Sort</option>
                    <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>Newest</option>
                    <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price Low to High</option>
                    <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price High to Low</option>
                </select>
                <button type="submit" class="btn secondary">Filter</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ str_starts_with($product->image, 'http') ? $product->image : Storage::url($product->image) }}" alt="{{ $product->name }}">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category?->name ?? '-' }}</td>
                        <td>${{ number_format($product->price, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td><span class="badge {{ $product->status === 'inactive' ? 'inactive' : '' }}">{{ ucfirst($product->status) }}</span></td>
                        <td class="actions">
                            <a href="{{ route('products.edit', $product) }}">Edit</a>
                            <form class="inline" method="POST" action="{{ route('products.destroy', $product) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $products->links() }}
        </div>
    </div>
</div>
</body>
</html>
