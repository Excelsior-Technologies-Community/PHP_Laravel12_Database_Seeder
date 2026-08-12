<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; color: #111827; }
        .container { max-width: 700px; margin: 40px auto; padding: 0 20px; }
        .panel { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        label { display: block; margin-top: 16px; font-weight: 600; }
        input, textarea, select { width: 100%; box-sizing: border-box; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; margin-top: 6px; }
        .btn { display: inline-block; margin-top: 20px; padding: 10px 16px; border: none; background: #111827; color: white; border-radius: 8px; cursor: pointer; }
        .btn.secondary { background: #e5e7eb; color: #111827; }
        .errors { color: #b91c1c; margin-bottom: 10px; }
    </style>
</head>
<body>
<div class="container">
    <div class="panel">
        <h2>Edit Product</h2>

        @if($errors->any())
            <div class="errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label>Name
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
            </label>
            <label>Category
                <select name="category_id" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </label>
            <label>Description
                <textarea name="description" rows="4">{{ old('description', $product->description) }}</textarea>
            </label>
            <label>Price
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required>
            </label>
            <label>Stock
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required>
            </label>
            <label>Status
                <select name="status">
                    <option value="active" {{ old('status', $product->status) === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status', $product->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </label>
            <label>Featured
                <select name="featured">
                    <option value="0" {{ old('featured', $product->featured) == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ old('featured', $product->featured) == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </label>
            <label>Upload Image
                <input type="file" name="image" accept="image/*">
            </label>
            <label>Or Image URL
                <input type="url" name="image_url" value="{{ old('image_url', $product->image) }}">
            </label>
            <button class="btn" type="submit">Update Product</button>
            <a href="{{ route('products.index') }}" class="btn secondary">Back</a>
        </form>
    </div>
</div>
</body>
</html>
