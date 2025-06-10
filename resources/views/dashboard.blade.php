<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
    <p>You are logged in!</p>

    <h2>User Information</h2>
    <ul>
        <li>Name: {{ Auth::user()->name }}</li>
        <li>Email: {{ Auth::user()->email }}</li>
    </ul>

    <form method="GET" action="{{ route('purchase.history') }}">
        @csrf
        <button type="submit">Riwayat</button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>