
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Seller</title>
</head>
<body>
    <h1>Input your shopName</h1>
    <form method="POST" action="{{ route('register.seller') }}">
        @csrf
        <label for="name">Shop name:</label>
        <input type="text" id="name" name="name" maxlength="40"><br><br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>