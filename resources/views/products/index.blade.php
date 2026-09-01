<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>Products</title>

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
            max-width: 1350px;
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
            margin-bottom: 20px;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 16px;
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
            border: none;
            text-decoration: none;
            padding: 10px 16px;
            border-radius: 8px;
            background: #111827;
            color: white;
            cursor: pointer;
        }

        .btn.secondary {
            background: #e5e7eb;
            color: #111827;
        }

        .btn.success {
            background: #166534;
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
            vertical-align: middle;
        }

        th {
            background: #f9fafb;
        }

        img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 10px;
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

        .badge.featured {
            background: #fef3c7;
            color: #92400e;
        }

        .badge.low-stock {
            background: #fee2e2;
            color: #991b1b;
        }

        .actions a,
        .actions button {
            margin-right: 8px;
            text-decoration: none;
            color: #111827;
        }

        .actions button {
            background: #dc2626;
            color: white;
            border: none;
            padding: 8px 10px;
            border-radius: 6px;
            cursor: pointer;
        }

        form.inline {
            display: inline;
        }

        .message {
            padding: 14px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .success-message {
            background: #dcfce7;
            color: #166534;
        }

        .error-message {
            background: #fee2e2;
            color: #991b1b;
        }

        .bulk-toolbar {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
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
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            height: 38px;
            padding: 0 10px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            text-decoration: none;
            color: #111827;
            background: white;
        }

        .pagination .active span {
            background: #111827;
            color: white;
            border-color: #111827;
        }

        .pagination .disabled span {
            opacity: 0.45;
        }

        @media (max-width: 768px) {

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

            <h2>Products</h2>

            <nav>

                <a href="{{ route('dashboard') }}">
                    Dashboard
                </a>

                <a href="{{ route('users.index') }}">
                    Users
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


        {{-- Messages --}}

        @if(session('success'))

        <div class="message success-message">
            {{ session('success') }}
        </div>

        @endif


        @if(session('error'))

        <div class="message error-message">
            {{ session('error') }}
        </div>

        @endif


        <div class="panel">

            <div class="toolbar">

                <div>

                    <a
                        href="{{ route('products.create') }}"
                        class="btn">
                        Add Product
                    </a>

                    <a
                        href="{{ route('products.export', request()->query()) }}"
                        class="btn success">
                        Export CSV
                    </a>

                </div>


                <form
                    method="GET"
                    action="{{ route('products.index') }}">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search product">


                    <select name="category_id">

                        <option value="">
                            All categories
                        </option>

                        @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>

                        @endforeach

                    </select>


                    <select name="status">

                        <option value="">
                            All status
                        </option>

                        <option
                            value="active"
                            {{ request('status') === 'active' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option
                            value="inactive"
                            {{ request('status') === 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>


                    <select name="featured">

                        <option value="">
                            All products
                        </option>

                        <option
                            value="yes"
                            {{ request('featured') === 'yes' ? 'selected' : '' }}>
                            Featured
                        </option>

                        <option
                            value="no"
                            {{ request('featured') === 'no' ? 'selected' : '' }}>
                            Not Featured
                        </option>

                    </select>


                    <select name="stock">

                        <option value="">
                            All stock
                        </option>

                        <option
                            value="low"
                            {{ request('stock') === 'low' ? 'selected' : '' }}>
                            Low Stock
                        </option>

                        <option
                            value="out"
                            {{ request('stock') === 'out' ? 'selected' : '' }}>
                            Out of Stock
                        </option>

                        <option
                            value="available"
                            {{ request('stock') === 'available' ? 'selected' : '' }}>
                            Available
                        </option>

                    </select>


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

                        <option
                            value="price_asc"
                            {{ request('sort') === 'price_asc' ? 'selected' : '' }}>
                            Price Low to High
                        </option>

                        <option
                            value="price_desc"
                            {{ request('sort') === 'price_desc' ? 'selected' : '' }}>
                            Price High to Low
                        </option>

                        <option
                            value="stock_asc"
                            {{ request('sort') === 'stock_asc' ? 'selected' : '' }}>
                            Stock Low to High
                        </option>

                        <option
                            value="stock_desc"
                            {{ request('sort') === 'stock_desc' ? 'selected' : '' }}>
                            Stock High to Low
                        </option>

                    </select>


                    <button
                        type="submit"
                        class="btn secondary">
                        Filter
                    </button>

                </form>

            </div>


            {{-- Bulk Actions --}}

            <form
                method="POST"
                action="{{ route('products.bulk-delete') }}"
                id="bulkDeleteForm">

                @csrf

                <div class="bulk-toolbar">

                    <button
                        type="submit"
                        class="btn danger"
                        onclick="return confirm('Delete selected products?')">
                        Delete Selected
                    </button>

                    <span id="selectedCount">
                        0 selected
                    </span>

                </div>


                <table>

                    <thead>

                        <tr>

                            <th>
                                <input
                                    type="checkbox"
                                    id="selectAll">
                            </th>

                            <th>
                                Image
                            </th>

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

                            <th>
                                Featured
                            </th>

                            <th>
                                Status
                            </th>

                            <th>
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($products as $product)

                        <tr>

                            <td>

                                <input
                                    type="checkbox"
                                    name="product_ids[]"
                                    value="{{ $product->id }}"
                                    class="product-checkbox">

                            </td>


                            <td>

                                @if($product->image)

                                <img
                                    src="{{ str_starts_with($product->image, 'http') ? $product->image : Storage::url($product->image) }}"
                                    alt="{{ $product->name }}">

                                @else

                                N/A

                                @endif

                            </td>


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

                                    <span class="badge low-stock">
                                    {{ $product->stock }}
                                    </span>

                                    @else

                                    {{ $product->stock }}

                                    @endif

                            </td>


                            <td>

                                @if($product->featured)

                                <span class="badge featured">
                                    Featured
                                </span>

                                @else

                                -

                                @endif

                            </td>


                            <td>

                                <span
                                    class="badge {{ $product->status === 'inactive' ? 'inactive' : '' }}">
                                    {{ ucfirst($product->status) }}
                                </span>

                            </td>


                            <td class="actions">

                                <a
                                    href="{{ route('products.edit', $product) }}">
                                    Edit
                                </a>


                                <form
                                    class="inline"
                                    method="POST"
                                    action="{{ route('products.destroy', $product) }}">

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Delete product?')">
                                        Delete
                                    </button>

                                </form>

                            </td>

                        </tr>

                        @empty

                        <tr>

                            <td
                                colspan="9"
                                style="text-align:center;">
                                No products found.
                            </td>

                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </form>


            {{-- Numeric Pagination --}}

            <div class="pagination">

                @if($products->onFirstPage())

                <span>
                    Previous
                </span>

                @else

                <a href="{{ $products->previousPageUrl() }}">
                    Previous
                </a>

                @endif


                @for(
                $page = 1;
                $page <= $products->lastPage();
                    $page++
                    )

                    @if($page == $products->currentPage())

                    <span class="active">
                        {{ $page }}
                    </span>

                    @else

                    <a href="{{ $products->url($page) }}">
                        {{ $page }}
                    </a>

                    @endif

                    @endfor


                    @if($products->hasMorePages())

                    <a href="{{ $products->nextPageUrl() }}">
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


    <script>
        const selectAll =
            document.getElementById('selectAll');

        const checkboxes =
            document.querySelectorAll('.product-checkbox');

        const selectedCount =
            document.getElementById('selectedCount');


        function updateSelectedCount() {
            const selected =
                document.querySelectorAll(
                    '.product-checkbox:checked'
                ).length;

            selectedCount.textContent =
                selected + ' selected';
        }


        selectAll.addEventListener(
            'change',
            function() {

                checkboxes.forEach(
                    checkbox => {
                        checkbox.checked =
                            selectAll.checked;
                    }
                );

                updateSelectedCount();

            }
        );


        checkboxes.forEach(
            checkbox => {

                checkbox.addEventListener(
                    'change',
                    function() {

                        updateSelectedCount();

                    }
                );

            }
        );
    </script>

</body>

</html>