<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Produk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="flex p-4 justify-between items-center bg-gray-100">
        <h1 class="text-2xl font-bold mb-4">Detail Produk</h1>
        <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline mb-4 inline-block">Back to Dashboard</a>
    </div>

    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4"> {{$product->name}}</h2>
        <p class="text-gray-700 mb-4">Harga: Rp. {{ number_format($product->price, 0, ',', '.') }}</p>
        <p class="text-gray-700 mb-4">Stok: {{ $product->stock }}</p>
        <p class="text-gray-700 mb-4">Deskripsi: {{ $product->description }}</p>
        <p class="text-gray-700 mb-4">Nama Toko: 
            <a href="{{ route('store.detail', $seller) }}" class="text-blue-500 hover:underline">
                {{ $seller->shopname }}
            </a>
        </p>
        <form method="GET" action="{{ route('purchase' , $product) }}">
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200 cursor-pointer">
            Masukkan Keranjang
        </button>
    </form>
    </div>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-xl font-semibold mb-4">Ulasan Produk</h2>
        @if(DB::table('reviews')->where('product_id' , $product->id)->exists())
          @foreach (DB::table('reviews')->where('product_id' , $product->id)->get() as $review)
              <div class="bg-white rounded-lg shadow-md p-4 mb-4">
                  <strong>{{ DB::table('users')->where('id' , $review->user_id)->first()->username }}</strong> -
                  <span>Rating: {{ str_repeat('⭐', $review->rating) }}</span>
                  <p>{{ $review->comment }}</p>
                  <small>Pada: {{ $review->created_at }}</small>
              </div>
          @endforeach
          @else 
          <p>Belum ada ulasan untuk produk ini.</p>
        @endif
    </div>
</body>
</html>