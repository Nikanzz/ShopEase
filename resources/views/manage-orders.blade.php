<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">Manage Orders</h1>
        <ul class="mb-4">
            <li class="text-lg">Shop: {{ DB::table('sellers')->where('user_id' ,Auth::user()->id)->firstOrFail()->shopname }}</li>
        </ul>
        <form method="GET" action="{{ route('dashboard') }}" class="mb-6">
            @csrf
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 cursor-pointer">Back to dashboard</button>
        </form>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border">Tanggal</th>
                    <th class="px-4 py-2 border">Produk</th>
                    <th class="px-4 py-2 border">Kepada</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Harga</th>
                    <th class="px-4 py-2 border">Total</th>
                    <th class="px-4 py-2 border">To Send</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $row)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ $row->bought_at }}</td>
                        <td class="px-4 py-2 border">{{ DB::table('products')->where('id', $row->product_id)->firstOrFail()->name }}</td>
                        <td class="px-4 py-2 border">{{ DB::table('users')->where('id', $row->user_id)->firstOrFail()->username }} ({{ $row->user_id }})</td>
                        <td class="px-4 py-2 border">{{ $row->amount }}</td>
                        <td class="px-4 py-2 border">{{ $row->price }}</td>
                        <td class="px-4 py-2 border">{{ $row->price * $row->amount }}</td>
                        <td class="px-4 py-2 border">
                            @if($row->fullfilled)
                                <span class="text-green-500">Sent!</span>
                            @else
                                <form method="GET" action="{{ route('send.order', $row->id) }}">
                                    @csrf
                                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 cursor-pointer">Send</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>