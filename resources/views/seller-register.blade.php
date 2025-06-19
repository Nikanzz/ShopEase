<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Seller</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h1 class="text-2xl font-bold mb-4">Input your shop name</h1>
        <form method="POST" action="{{ route('register.seller') }}">
            @csrf
            <label for="name" class="block text-sm font-medium text-gray-700">Shop name:</label>
            <input type="text" id="name" name="name" maxlength="40" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-500 focus:border-blue-500 p-2" required><br><br>
            <button type="submit" class="mt-4 w-full bg-blue-500 text-white font-semibold py-2 rounded-md hover:bg-blue-600">Submit</button>
        </form>

        <br>
        @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'profile')
            <form method="GET" action="{{ route('profile') }}">
                @csrf
                <button type="submit" class="mt-4 w-full bg-gray-300 text-gray-700 font-semibold py-2 rounded-md hover:bg-gray-400">Back to Profile</button>
            </form>
        @elseif(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'dashboard')
            <form method="GET" action="{{ route('dashboard') }}">
                @csrf
                <button type="submit" class="mt-4 w-full bg-gray-300 text-gray-700 font-semibold py-2 rounded-md hover:bg-gray-400">Back to Dashboard</button>
            </form>
        @endif
    </div>
</body>
</html>
