<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; color: #111827; }
        .container { max-width: 700px; margin: 40px auto; padding: 0 20px; }
        .panel { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        label { display: block; margin-top: 16px; font-weight: 600; }
        input { width: 100%; box-sizing: border-box; padding: 10px 12px; border: 1px solid #d1d5db; border-radius: 8px; margin-top: 6px; }
        .btn { display: inline-block; margin-top: 20px; padding: 10px 16px; border: none; background: #111827; color: white; border-radius: 8px; cursor: pointer; }
        .avatar { width: 120px; height: 120px; object-fit: cover; border-radius: 50%; margin-bottom: 20px; }
    </style>
</head>
<body>
<div class="container">
    <div class="panel">
        <h2>Profile Management</h2>

        @if($user->avatar)
            <img class="avatar" src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}">
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label>Name
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
            </label>
            <label>Email
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
            </label>
            <label>Phone
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
            </label>
            <label>Avatar
                <input type="file" name="avatar" accept="image/*">
            </label>
            <label>New Password
                <input type="password" name="password">
            </label>
            <label>Confirm Password
                <input type="password" name="password_confirmation">
            </label>
            <button class="btn" type="submit">Update Profile</button>
        </form>
    </div>
</div>
</body>
</html>
