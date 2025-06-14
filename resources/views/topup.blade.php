<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ Auth::user()->name }}'s Profile</title>
</head>
<body>
    <form method="POST" action="{{ route('topup.process') }}">
        @csrf
        <h1>Edit Profile</h1>
        
        <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required>
        <br>
        <button type="submit">Top-up</button>
    </form>

    <form method="GET" action="{{ route('dashboard') }}">
        @csrf
        <br><br><button type="submit">Cancel</button>
    </form>
</body>
</html>