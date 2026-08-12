<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; color: #111827; }
        .container { max-width: 1200px; margin: 32px auto; padding: 0 20px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .topbar nav a { text-decoration: none; color: #111827; margin-left: 16px; font-weight: 600; }
        .panel { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .toolbar { display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 16px; }
        .btn { display: inline-block; text-decoration: none; padding: 10px 16px; border-radius: 8px; background: #111827; color: white; }
        .btn.secondary { background: #e5e7eb; color: #111827; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 999px; background: #dcfce7; color: #166534; }
        .badge.inactive { background: #fee2e2; color: #991b1b; }
        form.inline { display: inline; }
        input, select { padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; }
        .actions a, .actions button { margin-right: 8px; text-decoration: none; color: #111827; }
        .actions button { background: #dc2626; color: white; border: none; padding: 8px 10px; border-radius: 6px; cursor: pointer; }
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
        <h2>User Management</h2>
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('categories.index') }}">Categories</a>
            <a href="{{ route('profile') }}">Profile</a>
        </nav>
    </div>

    <div class="panel">
        <div class="toolbar">
            <a href="{{ route('users.create') }}" class="btn">Add User</a>
            <form method="GET" action="{{ route('users.index') }}">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name/email">
                <select name="status">
                    <option value="">All status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                <button type="submit" class="btn secondary">Filter</button>
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td><span class="badge {{ $user->status === 'inactive' ? 'inactive' : '' }}">{{ ucfirst($user->status) }}</span></td>
                        <td class="actions">
                            <a href="{{ route('users.show', $user) }}">View</a>
                            <a href="{{ route('users.edit', $user) }}">Edit</a>
                            <form class="inline" method="POST" action="{{ route('users.destroy', $user) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $users->links() }}
        </div>
    </div>
</div>
</body>
</html>
