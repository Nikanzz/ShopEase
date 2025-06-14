
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Seller</title>
</head>
<body>
    <h1>Input your shop name</h1>
    <form method="POST" action="{{ route('register.seller') }}">
        @csrf
        <label for="name">Shop name:</label>
        <input type="text" id="name" name="name" maxlength="40"><br><br>
        <button type="submit">Submit</button>
    </form>

    <br>
    @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'profile')
        <form method="GET" action="{{ route('profile') }}">
            @csrf
            <button type="submit">Back to Profile</button>
        </form>
    @elseif(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'dashboard')
        <form method="GET" action="{{ route('dashboard') }}">
            @csrf
            <button type="submit">Back to Dashboard</button>
        </form>
    @endif
    
</body>
</html>