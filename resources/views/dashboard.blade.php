<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f3f4f6; color: #111827; }
        .container { max-width: 1200px; margin: 32px auto; padding: 0 20px; }
        .topbar { display: flex; justify-content: space-between; align-items: center; padding: 16px 0; }
        nav a { margin-left: 16px; text-decoration: none; color: #111827; font-weight: 600; }
        .grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; }
        .card { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .card small { color: #6b7280; }
        .card h3 { font-size: 28px; margin: 12px 0 0; }
        .panel { margin-top: 30px; background: white; border-radius: 12px; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid #e5e7eb; text-align: left; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 999px; background: #dcfce7; color: #166534; font-size: 12px; }
        .badge.inactive { background: #fee2e2; color: #991b1b; }
        .btn { display: inline-block; text-decoration: none; padding: 10px 16px; border-radius: 8px; background: #111827; color: white; margin-right: 10px; }
        .btn.secondary { background: #e5e7eb; color: #111827; }
    </style>
</head>
<body>
    <div class="container">
        <div class="topbar">
            <h2>Admin Dashboard</h2>
            <nav>
                <a href="{{ route('dashboard') }}">Dashboard</a>
                <a href="{{ route('users.index') }}">Users</a>
                <a href="{{ route('products.index') }}">Products</a>
                <a href="{{ route('categories.index') }}">Categories</a>
                <a href="{{ route('profile') }}">Profile</a>
            </nav>
        </div>

        <div class="grid">
            <div class="card">
                <small>Total Users</small>
                <h3>{{ $totalUsers }}</h3>
            </div>
            <div class="card">
                <small>Active Users</small>
                <h3>{{ $activeUsers }}</h3>
            </div>
            <div class="card">
                <small>Inactive Users</small>
                <h3>{{ $inactiveUsers }}</h3>
            </div>
            <div class="card">
                <small>Total Products</small>
                <h3>{{ $totalProducts }}</h3>
            </div>
        </div>

        <div class="panel">
            <h3>Recent Registrations</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentUsers as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge {{ $user->status === 'inactive' ? 'inactive' : '' }}">{{ ucfirst($user->status) }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="panel">
            <h3>Recent Products</h3>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentProducts as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>${{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
