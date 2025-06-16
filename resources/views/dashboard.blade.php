<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @include('components.navigation-bar')

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Categories</h1>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200">
                    <a href="{{ route('product.category', $category->id) }}" class="block p-4">
                        <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $category->name }}</h3>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <hr class="my-8">
  
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Recommended</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition duration-200 flex flex-col gap-10">
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500"><img src="https://img.freepik.com/premium-vector/supermarket-products-cartoon_24640-55629.jpg" alt="{{ $product->name }}" class="w-full h-full object-cover"></span>
                    </div>

                    <div class="p-4 flex flex-col flex-grow">
                        <div>
                            <h3 class="font-semibold text-lg text-gray-800 mb-2 truncate">{{ $product->name }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ $product->description }}</p>
                        </div>

                        <div class="mt-auto">
                            <p class="text-blue-600 font-bold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            <a href="{{ route('product.detail', $product->id) }}" 
                            class="inline-block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>