<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; color: #111827; }
        .container { max-width: 700px; margin: 40px auto; padding: 0 20px; }
        .panel { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        label { display: block; margin-top: 16px; font-weight: 600; }
        input, select { width: 100%; box-sizing: border-box; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; margin-top: 6px; }
        .btn { display: inline-block; margin-top: 20px; padding: 10px 16px; border: none; background: #111827; color: white; border-radius: 8px; cursor: pointer; }
        .btn.secondary { background: #e5e7eb; color: #111827; }
        .errors { color: #b91c1c; margin-bottom: 10px; }
    </style>
</head>
<body>
<div class="container">
    <div class="panel">
        <h2>Create User</h2>

        @if($errors->any())
            <div class="errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
            @csrf
            <label>Name
                <input type="text" name="name" value="{{ old('name') }}" required>
            </label>
            <label>Email
                <input type="email" name="email" value="{{ old('email') }}" required>
            </label>
            <label>Phone
                <input type="text" name="phone" value="{{ old('phone') }}">
            </label>
            <label>Status
                <select name="status">
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </label>
            <label>Avatar
                <input type="file" name="avatar" accept="image/*">
            </label>
            <label>Password
                <input type="password" name="password" required>
            </label>
            <label>Confirm Password
                <input type="password" name="password_confirmation" required>
            </label>
            <button class="btn" type="submit">Save User</button>
            <a href="{{ route('users.index') }}" class="btn secondary">Back</a>
        </form>
    </div>
</div>
</body>
</html>
