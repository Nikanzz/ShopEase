<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Auth::user()->name }}'s Profile</title>
</head>
<body>
    <h1>{{ Auth::user()->name }}'s Profile</h1>
    <p>Email: {{ Auth::user()->email }}</p>
    
    <form method="GET" action="{{ route('dashboard') }}">
        @csrf
        <button type="submit">Back to Dashboard</button>
    </form>
    <br>
    <h2>Account Information</h2>
    <ul>
        <li>Name: {{ Auth::user()->name }}</li>
        <li>Username: {{ Auth::user()->username }}</li>
        <li>Email: {{ Auth::user()->email }}</li>
        <li>Phone: {{ Auth::user()->phone }}</li>
        <li>Created At: {{ Auth::user()->created_at }}</li>
        <li>Updated At: {{ Auth::user()->updated_at }}</li>
    </ul>
    <form method="GET" action="{{ route('profile.edit') }}">
        @csrf
        <button type="submit">Edit Profile</button>
    </form>
    <br>
    <h2>Account Actions</h2>
    <form method="POST" action="{{ route('profile.delete') }}">
        @csrf
        <button type="submit">Delete Account</button>
    </form>
    <br>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <br>
    
</body>
</html>