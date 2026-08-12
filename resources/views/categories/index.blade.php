<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; color: #111827; }
        .container { max-width: 1100px; margin: 32px auto; padding: 0 20px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
        nav a { text-decoration: none; color: #111827; margin-left: 15px; font-weight: 600; }
        .panel { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .toolbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; }
        .btn { display: inline-block; text-decoration: none; padding: 10px 16px; border-radius: 8px; background: #111827; color: white; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        .actions a, .actions button { margin-right: 8px; text-decoration: none; color: #111827; }
        .actions button { background: #dc2626; color: white; border: none; padding: 8px 10px; border-radius: 6px; cursor: pointer; }
        form.inline { display: inline; }
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
        <h2>Categories</h2>
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('users.index') }}">Users</a>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('profile') }}">Profile</a>
        </nav>
    </div>

    <div class="panel">
        <div class="toolbar">
            <a href="{{ route('categories.create') }}" class="btn">Add Category</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->description ?? '-' }}</td>
                        <td class="actions">
                            <a href="{{ route('categories.edit', $category) }}">Edit</a>
                            <form class="inline" method="POST" action="{{ route('categories.destroy', $category) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete category?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $categories->links() }}
        </div>
    </div>
</div>
</body>
</html>
