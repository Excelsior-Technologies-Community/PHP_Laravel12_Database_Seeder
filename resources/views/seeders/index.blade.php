<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Seeder Management</title>

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
            max-width: 1200px;
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

        .topbar h2 {
            margin: 0;
        }

        nav a {
            text-decoration: none;
            color: #111827;
            margin-left: 15px;
            font-weight: 600;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(
                auto-fit,
                minmax(220px, 1fr)
            );
            gap: 20px;
        }

        .card {
            background: white;
            border-radius: 12px;
            padding: 22px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .card small {
            color: #6b7280;
            font-weight: 600;
        }

        .card h3 {
            margin: 10px 0 0;
            font-size: 30px;
        }

        .panel {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-top: 25px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .panel h3 {
            margin-top: 0;
        }

        .message {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .success {
            background: #dcfce7;
            color: #166534;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
        }

        .seeder-grid {
            display: grid;
            grid-template-columns: repeat(
                auto-fit,
                minmax(280px, 1fr)
            );
            gap: 20px;
        }

        .seeder-card {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 20px;
        }

        .seeder-card h4 {
            margin-top: 0;
            margin-bottom: 8px;
        }

        .seeder-card p {
            color: #6b7280;
            min-height: 45px;
            line-height: 1.5;
        }

        .btn {
            display: inline-block;
            border: none;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            background: #111827;
            color: white;
            cursor: pointer;
            font-weight: 600;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn.success-btn {
            background: #166534;
        }

        .btn.warning-btn {
            background: #b45309;
        }

        .btn.danger-btn {
            background: #dc2626;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
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
            vertical-align: top;
        }

        th {
            background: #f9fafb;
        }

        .badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge.success-badge {
            background: #dcfce7;
            color: #166534;
        }

        .badge.failed-badge {
            background: #fee2e2;
            color: #991b1b;
        }

        .badge.running-badge {
            background: #fef3c7;
            color: #92400e;
        }

        .warning-box {
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #9a3412;
            padding: 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .reset-form {
            margin-top: 15px;
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .reset-form input {
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            min-width: 220px;
        }

        .empty {
            color: #6b7280;
            padding: 15px 0;
        }

        @media (max-width: 768px) {
            nav {
                width: 100%;
            }

            nav a {
                display: inline-block;
                margin: 5px 10px 5px 0;
            }

            table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="topbar">

        <h2>Seeder Management</h2>

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

            <a href="{{ route('profile') }}">
                Profile
            </a>
        </nav>

    </div>


    {{-- Success message --}}
    @if(session('success'))
        <div class="message success">
            {{ session('success') }}
        </div>
    @endif


    {{-- Error message --}}
    @if(session('error'))
        <div class="message error">
            {{ session('error') }}
        </div>
    @endif


    {{-- Database statistics --}}
    <div class="grid">

        <div class="card">
            <small>Total Users</small>
            <h3>{{ $statistics['users'] }}</h3>
        </div>

        <div class="card">
            <small>Total Categories</small>
            <h3>{{ $statistics['categories'] }}</h3>
        </div>

        <div class="card">
            <small>Total Products</small>
            <h3>{{ $statistics['products'] }}</h3>
        </div>

    </div>


    {{-- Seeder controls --}}
    <div class="panel">

        <h3>Available Seeders</h3>

        <div class="seeder-grid">

            @foreach($seeders as $seeder)

                <div class="seeder-card">

                    <h4>
                        {{ $seeder['name'] }}
                    </h4>

                    <p>
                        {{ $seeder['description'] }}
                    </p>

                    @if($seeder['name'] === 'Admin User Seeder')

                        <form
                            method="POST"
                            action="{{ route('seeders.run') }}"
                        >
                            @csrf

                            <input
                                type="hidden"
                                name="seeder"
                                value="admin"
                            >

                            <button
                                type="submit"
                                class="btn"
                            >
                                Run Seeder
                            </button>
                        </form>

                    @elseif($seeder['name'] === 'Category Seeder')

                        <form
                            method="POST"
                            action="{{ route('seeders.run') }}"
                        >
                            @csrf

                            <input
                                type="hidden"
                                name="seeder"
                                value="category"
                            >

                            <button
                                type="submit"
                                class="btn"
                            >
                                Run Seeder
                            </button>
                        </form>

                    @elseif($seeder['name'] === 'Product Seeder')

                        <form
                            method="POST"
                            action="{{ route('seeders.run') }}"
                        >
                            @csrf

                            <input
                                type="hidden"
                                name="seeder"
                                value="product"
                            >

                            <button
                                type="submit"
                                class="btn"
                            >
                                Run Seeder
                            </button>
                        </form>

                    @endif

                </div>

            @endforeach

        </div>


        <div style="margin-top: 25px;">

            <form
                method="POST"
                action="{{ route('seeders.seed-all') }}"
            >
                @csrf

                <button
                    type="submit"
                    class="btn success-btn"
                    onclick="
                        return confirm(
                            'Run all database seeders?'
                        )
                    "
                >
                    Run All Seeders
                </button>

            </form>

        </div>

    </div>


    {{-- Reset and reseed --}}
    <div class="panel">

        <h3>Reset &amp; Reseed Database</h3>

        <div class="warning-box">

            <strong>Warning:</strong>

            This operation deletes all records from:

            <strong>
                users
            </strong>,
            <strong>
                categories
            </strong>
            and
            <strong>
                products
            </strong>.

            It then runs the complete
            <strong>DatabaseSeeder</strong>
            again.

            <br><br>

            This does <strong>not</strong> run
            <code>migrate:fresh</code>
            and does not delete your database tables.

        </div>

        <form
            method="POST"
            action="{{ route('seeders.reset-reseed') }}"
            class="reset-form"
            onsubmit="
                return confirm(
                    'WARNING: This will delete all users, categories and products. Continue?'
                )
            "
        >

            @csrf

            <input
                type="text"
                name="confirmation"
                placeholder="Type RESET"
                required
            >

            <button
                type="submit"
                class="btn danger-btn"
            >
                Reset &amp; Reseed
            </button>

        </form>

    </div>


    {{-- Seeder history --}}
    <div class="panel">

        <h3>Seeder Execution History</h3>

        @if($recentRuns->count())

            <table>

                <thead>
                    <tr>
                        <th>Seeder</th>
                        <th>Status</th>
                        <th>Started</th>
                        <th>Completed</th>
                        <th>Message</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($recentRuns as $run)

                        <tr>

                            <td>
                                <strong>
                                    {{ $run->seeder_name }}
                                </strong>
                            </td>

                            <td>

                                @if($run->status === 'success')

                                    <span class="badge success-badge">
                                        Success
                                    </span>

                                @elseif($run->status === 'failed')

                                    <span class="badge failed-badge">
                                        Failed
                                    </span>

                                @else

                                    <span class="badge running-badge">
                                        Running
                                    </span>

                                @endif

                            </td>

                            <td>
                                {{ $run->started_at?->format('d M Y H:i:s') ?? '-' }}
                            </td>

                            <td>
                                {{ $run->completed_at?->format('d M Y H:i:s') ?? '-' }}
                            </td>

                            <td>
                                {{ $run->message ?? '-' }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            <div class="empty">
                No seeder operations have been performed yet.
            </div>

        @endif

    </div>

</div>

</body>
</html>