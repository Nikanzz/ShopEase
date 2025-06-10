<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Auth::user()->name }}'s Profile</title>
</head>
<body>
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        <h1>Edit Profile</h1>
        
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required>
        <br>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="{{ Auth::user()->username }}" required>
        <br>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone" value="{{ Auth::user()->phone }}" required>
        <br>

        <button type="submit">Update Profile</button>
    </form>
</body>
</html>