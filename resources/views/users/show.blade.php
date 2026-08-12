<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; color: #111827; }
        .container { max-width: 800px; margin: 40px auto; padding: 0 20px; }
        .panel { background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        .avatar { width: 120px; height: 120px; object-fit: cover; border-radius: 50%; background: #e5e7eb; margin-bottom: 20px; }
        .info { margin-bottom: 10px; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 999px; background: #dcfce7; color: #166534; }
        .badge.inactive { background: #fee2e2; color: #991b1b; }
        .btn { display: inline-block; margin-top: 20px; text-decoration: none; padding: 10px 16px; border-radius: 8px; background: #111827; color: white; }
    </style>
</head>
<body>
<div class="container">
    <div class="panel">
        @if($user->avatar)
            <img class="avatar" src="{{ Storage::url($user->avatar) }}" alt="{{ $user->name }}">
        @else
            <div class="avatar" style="display:flex;align-items:center;justify-content:center;">N/A</div>
        @endif
        <h2>{{ $user->name }}</h2>
        <div class="info"><strong>Email:</strong> {{ $user->email }}</div>
        <div class="info"><strong>Phone:</strong> {{ $user->phone ?? '-' }}</div>
        <div class="info"><strong>Status:</strong> <span class="badge {{ $user->status === 'inactive' ? 'inactive' : '' }}">{{ ucfirst($user->status) }}</span></div>
        <div class="info"><strong>Created At:</strong> {{ $user->created_at->format('d M Y') }}</div>
        <a href="{{ route('users.index') }}" class="btn">Back to Users</a>
    </div>
</div>
</body>
</html>
