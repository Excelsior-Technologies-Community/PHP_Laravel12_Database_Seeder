<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Category</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; color: #111827; }
        .container { max-width: 700px; margin: 40px auto; padding: 0 20px; }
        .panel { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        label { display: block; margin-top: 16px; font-weight: 600; }
        input, textarea { width: 100%; box-sizing: border-box; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; margin-top: 6px; }
        .btn { display: inline-block; margin-top: 20px; padding: 10px 16px; border: none; background: #111827; color: white; border-radius: 8px; cursor: pointer; }
        .btn.secondary { background: #e5e7eb; color: #111827; }
    </style>
</head>
<body>
<div class="container">
    <div class="panel">
        <h2>Create Category</h2>
        <form method="POST" action="{{ route('categories.store') }}">
            @csrf
            <label>Name
                <input type="text" name="name" required>
            </label>
            <label>Description
                <textarea name="description" rows="4"></textarea>
            </label>
            <button class="btn" type="submit">Save Category</button>
            <a href="{{ route('categories.index') }}" class="btn secondary">Back</a>
        </form>
    </div>
</div>
</body>
</html>
