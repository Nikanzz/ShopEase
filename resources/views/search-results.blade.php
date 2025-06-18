<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container mx-auto px-4 py-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">
                Hasil Pencarian untuk: "{{ $query }}"
            </h1>
            <p class="text-gray-600">
                Ditemukan {{ $products->total() }} produk
            </p>
        </div>

        <div class="mb-8">
            <form action="{{ route('products.search') }}" method="GET" class="flex gap-2">
                <input type="text" 
                    name="query" 
                    value="{{ $query }}" 
                    placeholder="Cari produk..." 
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button type="submit" 
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition duration-200 cursor-pointer">
                    Cari
                </button>
                <a href="{{ route('dashboard') }}" 
                   class="px-6 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400 transition duration-200">
                    Kembali ke Dashboard
                </a>
            </form>
             @error ('query')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach($products as $product)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200 flex flex-col gap-10">
                        <div class="w-full aspect-square bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500"><img src="https://img.freepik.com/premium-vector/supermarket-products-cartoon_24640-55629.jpg" alt="{{ $product->name }}" class="w-full h-full object-cover"></span>
                        </div>

                        <div class="p-4 flex flex-col flex-grow">
                            <div class="mb-4">
                                <h3 class="font-semibold text-lg text-gray-800 mb-2 truncate">
                                    {{ $product->name }}
                                </h3>
                                
                                @if($product->category)
                                    <span class="inline-block bg-gray-100 text-gray-600 text-xs px-2 py-1 rounded mb-2">
                                        {{ $product->category->name }}
                                    </span>
                                @endif
                                
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                    {{ $product->description }}
                                </p>
                            </div>
                            <div class="flex items-center justify-between mt-auto">
                                <span class="text-xl font-bold text-blue-600">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                                
                                <a href="{{ route('product.detail', $product->id) }}" 
                                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200 text-sm">
                                    Detail
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-center">
                {{ $products->appends(['query' => $query])->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="mb-4">
                    <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">Tidak ada produk ditemukan</h3>
                <p class="text-gray-500 mb-4">
                    Coba gunakan kata kunci yang berbeda atau lebih umum
                </p>
                <a href="{{ route('dashboard') }}" 
                class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Kembali ke Homepage
                </a>
            </div>
        @endif
    </div>
</body>
