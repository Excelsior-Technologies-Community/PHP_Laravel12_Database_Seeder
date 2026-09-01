<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f3f4f6;
            color: #111827;
        }

        .container {
            max-width: 1300px;
            margin: 32px auto;
            padding: 0 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            flex-wrap: wrap;
        }

        nav a {
            margin-left: 15px;
            text-decoration: none;
            color: #111827;
            font-weight: 600;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit,
                    minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .card small {
            color: #6b7280;
        }

        .card h3 {
            margin: 10px 0 0;
            font-size: 30px;
        }

        .panel {
            margin-top: 25px;
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }

        th {
            background: #f9fafb;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 999px;
            background: #dcfce7;
            color: #166534;
            font-size: 12px;
        }

        .badge.inactive {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge.warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge.danger {
            background: #fee2e2;
            color: #991b1b;
        }

        @media(max-width:768px) {

            table {
                display: block;
                overflow-x: auto;
            }

            nav {
                width: 100%;
            }

            nav a {
                display: inline-block;
                margin: 5px 10px 5px 0;
            }

        }
    </style>

</head>

<body>

    <div class="container">

        <div class="topbar">

            <h2>
                Admin Dashboard
            </h2>

            <nav>

                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>

                <a href="{{ route('users.index') }}">
                    Users
                </a>

                <a href="{{ route('products.index') }}">
                    Products
                </a>

                <a href="{{ route('categories.index') }}">
                    Categories
                </a>

                <a href="{{ route('seeders.index') }}">
                    Seeders
                </a>

                <a href="{{ route('profile') }}">
                    Profile
                </a>

            </nav>

        </div>


        {{-- User Statistics --}}

        <div class="grid">

            <div class="card">

                <small>
                    Total Users
                </small>

                <h3>
                    {{ $totalUsers }}
                </h3>

            </div>


            <div class="card">

                <small>
                    Active Users
                </small>

                <h3>
                    {{ $activeUsers }}
                </h3>

            </div>


            <div class="card">

                <small>
                    Inactive Users
                </small>

                <h3>
                    {{ $inactiveUsers }}
                </h3>

            </div>


            <div class="card">

                <small>
                    Total Categories
                </small>

                <h3>
                    {{ $totalCategories }}
                </h3>

            </div>


            <div class="card">

                <small>
                    Total Products
                </small>

                <h3>
                    {{ $totalProducts }}
                </h3>

            </div>


            <div class="card">

                <small>
                    Active Products
                </small>

                <h3>
                    {{ $activeProducts }}
                </h3>

            </div>


            <div class="card">

                <small>
                    Featured Products
                </small>

                <h3>
                    {{ $featuredProducts }}
                </h3>

            </div>


            <div class="card">

                <small>
                    Low Stock Products
                </small>

                <h3>
                    {{ $lowStockProducts }}
                </h3>

            </div>

        </div>


        {{-- Recent Users --}}

        <div class="panel">

            <h3>
                Recent Registrations
            </h3>

            <table>

                <thead>

                    <tr>

                        <th>
                            Name
                        </th>

                        <th>
                            Email
                        </th>

                        <th>
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($recentUsers as $user)

                    <tr>

                        <td>
                            {{ $user->name }}
                        </td>

                        <td>
                            {{ $user->email }}
                        </td>

                        <td>

                            <span
                                class="badge {{ $user->status === 'inactive' ? 'inactive' : '' }}">
                                {{ ucfirst($user->status) }}
                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="3">
                            No users found.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Recent Products --}}

        <div class="panel">

            <h3>
                Recent Products
            </h3>

            <table>

                <thead>

                    <tr>

                        <th>
                            Name
                        </th>

                        <th>
                            Category
                        </th>

                        <th>
                            Price
                        </th>

                        <th>
                            Stock
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($recentProducts as $product)

                    <tr>

                        <td>
                            {{ $product->name }}
                        </td>

                        <td>
                            {{ $product->category?->name ?? '-' }}
                        </td>

                        <td>
                            ${{ number_format($product->price, 2) }}
                        </td>

                        <td>

                            @if($product->stock <= 5)

                                <span class="badge danger">
                                {{ $product->stock }}
                                </span>

                                @else

                                {{ $product->stock }}

                                @endif

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4">
                            No products found.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Low Stock --}}

        <div class="panel">

            <h3>
                Low Stock Products
            </h3>

            <table>

                <thead>

                    <tr>

                        <th>
                            Product
                        </th>

                        <th>
                            Category
                        </th>

                        <th>
                            Stock
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($lowStockList as $product)

                    <tr>

                        <td>
                            {{ $product->name }}
                        </td>

                        <td>
                            {{ $product->category?->name ?? '-' }}
                        </td>

                        <td>

                            <span class="badge warning">
                                {{ $product->stock }}
                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="3">
                            No low stock products.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>