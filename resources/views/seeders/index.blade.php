<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">


    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

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
            max-width: 1250px;
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

        nav a:hover {
            text-decoration: underline;
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
            grid-template-columns: repeat(auto-fit,
                    minmax(280px, 1fr));
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

        .btn.secondary {
            background: #e5e7eb;
            color: #111827;
        }

        .btn.blue-btn {
            background: #2563eb;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .history-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 20px;
        }

        .filter-form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        input,
        select {
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: white;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #2563eb;
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
            min-width: 220px;
        }

        .empty {
            color: #6b7280;
            padding: 20px 0;
            text-align: center;
        }

        .stat-label {
            font-size: 13px;
            color: #6b7280;
        }

        .stat-value {
            font-size: 28px;
            font-weight: bold;
            margin-top: 8px;
        }

        .export-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .pagination-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
        }

        .pagination-wrapper nav {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }

        .pagination-wrapper a,
        .pagination-wrapper span {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            min-height: 38px;
            padding: 0 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            text-decoration: none;
            background: white;
            color: #111827;
        }

        .pagination-wrapper .active span {
            background: #111827;
            color: white;
            border-color: #111827;
        }

        .pagination-wrapper .disabled span {
            opacity: 0.45;
        }

        .message-text {
            max-width: 400px;
            word-break: break-word;
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

            .filter-form {
                width: 100%;
            }

            .filter-form input,
            .filter-form select {
                width: 100%;
            }

            .filter-form .btn {
                width: 100%;
            }

            .history-toolbar {
                align-items: stretch;
            }
        }
    </style>

</head>

<body>

    <div class="container">

  
        {{-- =========================================================
     HEADER
========================================================== --}}

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

                <a href="{{ route('seeders.index') }}">
                    Seeders
                </a>

                <a href="{{ route('profile') }}">
                    Profile
                </a>

            </nav>

        </div>


        {{-- =========================================================
     FLASH MESSAGES
========================================================== --}}

        @if(session('success'))

        <div class="message success">
            {{ session('success') }}
        </div>

        @endif


        @if(session('error'))

        <div class="message error">
            {{ session('error') }}
        </div>

        @endif


        {{-- =========================================================
     DATABASE STATISTICS
========================================================== --}}

        <div class="grid">

            <div class="card">

                <div class="stat-label">
                    Total Users
                </div>

                <div class="stat-value">
                    {{ $statistics['users'] }}
                </div>

            </div>


            <div class="card">

                <div class="stat-label">
                    Total Categories
                </div>

                <div class="stat-value">
                    {{ $statistics['categories'] }}
                </div>

            </div>


            <div class="card">

                <div class="stat-label">
                    Total Products
                </div>

                <div class="stat-value">
                    {{ $statistics['products'] }}
                </div>

            </div>


            <div class="card">

                <div class="stat-label">
                    Seeder Runs
                </div>

                <div class="stat-value">
                    {{ $totalSeederRuns ?? $recentRuns->count() }}
                </div>

            </div>


            <div class="card">

                <div class="stat-label">
                    Successful Runs
                </div>

                <div class="stat-value">
                    {{ $successfulRuns ?? 0 }}
                </div>

            </div>


            <div class="card">

                <div class="stat-label">
                    Failed Runs
                </div>

                <div class="stat-value">
                    {{ $failedRuns ?? 0 }}
                </div>

            </div>

        </div>


        {{-- =========================================================
     AVAILABLE SEEDERS
========================================================== --}}

        <div class="panel">

            <h3>
                Available Seeders
            </h3>

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
                        action="{{ route('seeders.run') }}">

                        @csrf

                        <input
                            type="hidden"
                            name="seeder"
                            value="admin">

                        <button
                            type="submit"
                            class="btn">
                            Run Seeder
                        </button>

                    </form>


                    @elseif($seeder['name'] === 'Category Seeder')

                    <form
                        method="POST"
                        action="{{ route('seeders.run') }}">

                        @csrf

                        <input
                            type="hidden"
                            name="seeder"
                            value="category">

                        <button
                            type="submit"
                            class="btn">
                            Run Seeder
                        </button>

                    </form>


                    @elseif($seeder['name'] === 'Product Seeder')

                    <form
                        method="POST"
                        action="{{ route('seeders.run') }}">

                        @csrf

                        <input
                            type="hidden"
                            name="seeder"
                            value="product">

                        <button
                            type="submit"
                            class="btn">
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
                    action="{{ route('seeders.seed-all') }}">

                    @csrf

                    <button
                        type="submit"
                        class="btn success-btn"
                        onclick="return confirm('Run all database seeders?')">
                        Run All Seeders
                    </button>

                </form>

            </div>

        </div>


        {{-- =========================================================
     RESET AND RESEED
========================================================== --}}

        <div class="panel">

            <h3>
                Reset &amp; Reseed Database
            </h3>

            <div class="warning-box">

                <strong>Warning:</strong>

                This operation deletes all records from:

                <strong>users</strong>,
                <strong>categories</strong>
                and
                <strong>products</strong>.

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
                onsubmit="return confirm('WARNING: This will delete all users, categories and products. Continue?')">

                @csrf

                <input
                    type="text"
                    name="confirmation"
                    placeholder="Type RESET"
                    required>

                <button
                    type="submit"
                    class="btn danger-btn">
                    Reset &amp; Reseed
                </button>

            </form>

        </div>


        {{-- =========================================================
     SEEDER HISTORY
========================================================== --}}

        <div class="panel">

            <div class="history-toolbar">

                <h3 style="margin: 0;">
                    Seeder Execution History
                </h3>


                <div class="export-buttons">

                    {{-- Refresh --}}

                    <a
                        href="{{ route('seeders.index') }}"
                        class="btn secondary">
                        Refresh
                    </a>


                    {{-- Export --}}

                    <a
                        href="{{ route('seeders.export') }}"
                        class="btn blue-btn">
                        Export CSV
                    </a>


                    {{-- Clear History --}}

                    <form
                        method="POST"
                        action="{{ route('seeders.clear-history') }}"
                        style="display:inline;"
                        onsubmit="return confirm('Delete all seeder execution history?')">

                        @csrf

                        @method('DELETE')

                        <button
                            type="submit"
                            class="btn danger-btn">
                            Clear History
                        </button>

                    </form>

                </div>

            </div>


            {{-- =====================================================
         SEARCH / FILTER
    ====================================================== --}}

            <form
                method="GET"
                action="{{ route('seeders.index') }}"
                class="filter-form">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search seeder...">


                <select name="status">

                    <option value="">
                        All Status
                    </option>

                    <option
                        value="success"
                        {{ request('status') === 'success' ? 'selected' : '' }}>
                        Success
                    </option>

                    <option
                        value="failed"
                        {{ request('status') === 'failed' ? 'selected' : '' }}>
                        Failed
                    </option>

                    <option
                        value="running"
                        {{ request('status') === 'running' ? 'selected' : '' }}>
                        Running
                    </option>

                </select>


                <button
                    type="submit"
                    class="btn">
                    Search
                </button>


                @if(request()->filled('search') || request()->filled('status'))

                <a
                    href="{{ route('seeders.index') }}"
                    class="btn secondary">
                    Clear Filter
                </a>

                @endif

            </form>


            <div style="margin-top: 20px;">

                @if($recentRuns->count())

                <table>

                    <thead>

                        <tr>

                            <th>
                                #
                            </th>

                            <th>
                                Seeder
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Started
                            </th>

                            <th>
                                Completed
                            </th>

                            <th>
                                Duration
                            </th>

                            <th>
                                Message
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @foreach($recentRuns as $run)

                        <tr>

                            <td>
                                {{ $run->id }}
                            </td>


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

                                @if($run->started_at && $run->completed_at)

                                {{ $run->started_at->diffInSeconds($run->completed_at) }}
                                sec

                                @else

                                -

                                @endif

                            </td>


                            <td>

                                <div class="message-text">

                                    {{ $run->message ?? '-' }}

                                </div>

                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>


                {{-- =================================================
                 PAGINATION
            ================================================== --}}

                @if(method_exists($recentRuns, 'links'))

                <div class="pagination-wrapper">

                    {{ $recentRuns->appends(request()->query())->links() }}

                </div>

                @endif


                @else

                <div class="empty">

                    No seeder operations have been performed yet.

                </div>

                @endif

            </div>

        </div>
   

    </div>

</body>

</html>