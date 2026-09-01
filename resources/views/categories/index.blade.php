<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Categories</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
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
            margin-bottom: 20px;
            gap: 20px;
            flex-wrap: wrap;
        }

        nav a {
            text-decoration: none;
            color: #111827;
            margin-left: 15px;
            font-weight: 600;
        }

        .panel {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .toolbar form {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        input,
        select {
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            background: #111827;
            color: white;
            border: none;
            cursor: pointer;
        }

        .btn.secondary {
            background: #e5e7eb;
            color: #111827;
        }

        .btn.danger {
            background: #dc2626;
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

        .actions a {
            text-decoration: none;
            margin-right: 10px;
            color: #111827;
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

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            min-width: 38px;
            height: 38px;
            padding: 0 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            text-decoration: none;
            color: #111827;
            background: white;
        }

        .pagination .active span {
            background: #111827;
            color: white;
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

            <h2>Categories</h2>

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

                <a href="{{ route('seeders.index') }}">
                    Seeders
                </a>

                <a href="{{ route('profile') }}">
                    Profile
                </a>

            </nav>

        </div>


        @if(session('success'))

        <div class="message success">
            {{ session('success') }}
        </div>

        @endif


        <div class="panel">

            <div class="toolbar">

                <a
                    href="{{ route('categories.create') }}"
                    class="btn">
                    Add Category
                </a>


                <form
                    method="GET"
                    action="{{ route('categories.index') }}">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search category">


                    <select name="sort">

                        <option value="">
                            Sort
                        </option>

                        <option
                            value="newest"
                            {{ request('sort') === 'newest' ? 'selected' : '' }}>
                            Newest
                        </option>

                        <option
                            value="oldest"
                            {{ request('sort') === 'oldest' ? 'selected' : '' }}>
                            Oldest
                        </option>

                        <option
                            value="name_asc"
                            {{ request('sort') === 'name_asc' ? 'selected' : '' }}>
                            Name A-Z
                        </option>

                        <option
                            value="name_desc"
                            {{ request('sort') === 'name_desc' ? 'selected' : '' }}>
                            Name Z-A
                        </option>

                    </select>


                    <button
                        type="submit"
                        class="btn secondary">
                        Search
                    </button>

                </form>

            </div>


            <table>

                <thead>

                    <tr>

                        <th>
                            ID
                        </th>

                        <th>
                            Name
                        </th>

                        <th>
                            Description
                        </th>

                        <th>
                            Created
                        </th>

                        <th>
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($categories as $category)

                    <tr>

                        <td>
                            {{ $category->id }}
                        </td>

                        <td>
                            {{ $category->name }}
                        </td>

                        <td>
                            {{ $category->description ?? '-' }}
                        </td>

                        <td>
                            {{ $category->created_at?->format('d M Y') }}
                        </td>

                        <td class="actions">

                            <a
                                href="{{ route('categories.edit', $category) }}">
                                Edit
                            </a>


                            <form
                                method="POST"
                                action="{{ route('categories.destroy', $category) }}"
                                style="display:inline;">

                                @csrf

                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn danger"
                                    onclick="return confirm('Delete category?')">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td
                            colspan="5"
                            style="text-align:center;">
                            No categories found.
                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>


            <div class="pagination">

                @if($categories->onFirstPage())

                <span>
                    Previous
                </span>

                @else

                <a href="{{ $categories->previousPageUrl() }}">
                    Previous
                </a>

                @endif


                @for(
                $page = 1;
                $page <= $categories->lastPage();
                    $page++
                    )

                    @if($page == $categories->currentPage())

                    <span class="active">
                        {{ $page }}
                    </span>

                    @else

                    <a href="{{ $categories->url($page) }}">
                        {{ $page }}
                    </a>

                    @endif

                    @endfor


                    @if($categories->hasMorePages())

                    <a href="{{ $categories->nextPageUrl() }}">
                        Next
                    </a>

                    @else

                    <span>
                        Next
                    </span>

                    @endif

            </div>

        </div>

    </div>

</body>

</html>