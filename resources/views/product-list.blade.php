<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ DB::table('sellers')->where('user_id', Auth::user()->id)->first()->shopname }} Products</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">{{ DB::table('sellers')->where('user_id', Auth::user()->id)->first()->shopname }}'s Products</h1>
        
        <div class="mb-4">
            <form method="GET" action="{{ route('dashboard') }}">
                @csrf
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-blue-600">Back to Dashboard</button>
            </form>
        </div>
        
        <div class="mb-4">
            <form method="GET" action="{{ route('create.product') }}">
                @csrf
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded cursor-pointer hover:bg-green-600">Create Product</button>
            </form>
        </div>

        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">Product ID</th>
                    <th class="border px-4 py-2">Product Name</th>
                    <th class="border px-4 py-2">Description</th>
                    <th class="border px-4 py-2">Price</th>
                    <th class="border px-4 py-2">Stock</th>
                    <th class="border px-4 py-2">Category</th>
                    <th class="border px-4 py-2">Manage</th>
                    <th class="border px-4 py-2 text-red-500">Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $p)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">{{ $p->id }}</td>
                        <td class="border px-4 py-2">{{ $p->name }}</td>
                        <td class="border px-4 py-2">{{ $p->description }}</td>
                        <td class="border px-4 py-2">{{ $p->price }}</td>
                        <td class="border px-4 py-2">{{ $p->stock }}</td>
                        <td class="border px-4 py-2">{{ DB::table('categories')->where('id', $p->category_id)->first()->name }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('manage.product', $p->id) }}" class="text-blue-500 hover:underline">Change</a>
                        </td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('delete.product', $p->id) }}" class="text-red-500 hover:underline">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
