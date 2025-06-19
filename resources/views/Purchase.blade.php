<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="flex p-4 justify-between items-center bg-gray-100">
        <h1 class="text-2xl font-bold mb-4">Add to Cart</h1>
        <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline mb-4 inline-block">Back to Dashboard</a>
    </div>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4"> Add to Cart</h2>
        <p class="text-gray-700 mb-4">Nama produk : {{ $product->name }}</p>
        <p class="text-gray-700 mb-4">Harga satuan : Rp{{ number_format($product->price, 0, ',', '.') }}</p>
        <p class="text-gray-700 mb-4">Nama toko : {{ $product->seller->shopname }}</p>
        <p class="text-gray-700 mb-4">Stok tersedia: {{ $product->stock }}</p>
        <form method="POST" action="{{ route('add.to.cart') }}">
            @csrf
            <label for="quantity">Jumlah yang ingin dibeli: </label>
            <input type="hidden" name="pid" value="{{$product->id}}">
            <input 
                type="number" 
                id="quantity" 
                name="quantity" 
                value="0" 
                min="1" 
                max="{{ $product->stock }}" 
                oninput="updateTotal()" 
                class="bg-gray-100 rounded px-4 hover:bg-gray-200"
                required
            ><br><br>

            Total harga: 
            <span id="total">Rp0</span><br><br>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 cursor-pointer">Masukkan</button>
            @if (session('error'))
                 <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif
        </form>
        <br>
        <button type="button" onclick="history.back();" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition duration-200 cursor-pointer">Kembali</button>
    </div>
</body>
<script>
    const price = {{ $product->price }};
    const maxStock = {{ $product->stock }};

    function updateTotal() {
        let quantityInput = document.getElementById('quantity');
        let quantity = parseInt(quantityInput.value);

        const total = price * quantity;
        document.getElementById('total').innerText = 'Rp' + total.toLocaleString('id-ID');
    }
</script>
</html>
