<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>{{ $category->name }}</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
      <div class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">
          Kategori {{$category->name}}
        </h2>
        
        <div class="flex gap-4 mb-6">
          <form method="GET" action="{{ route('dashboard') }}">
            @csrf
            <button type="submit" class="cursor-pointer bg-gray-500 hover:bg-gray-600 text-white font-medium py-2 px-4 rounded transition duration-200">
              Back to Dashboard
            </button>
          </form>
          
          <form method="GET" action="{{ route('cart') }}">
            @csrf
            <button type="submit" class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded transition duration-200">
              Cart
            </button>
          </form>
        </div>

        <div class="overflow-x-auto shadow-lg rounded-lg">
          <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                  Nama Produk
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                  Harga
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                  Nama Toko
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                  Aksi
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach($products as $product)
                <tr class="hover:bg-gray-50 transition duration-150">
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                    {{$product->name}}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                    Rp.{{number_format($product->price, 0, ',', '.')}}
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 hover:text-blue-800">
                    <a href="{{ route('store.detail', $product->seller) }}" class="hover:underline">
                      {{ $product->seller->shopname ?? 'Toko tidak ditemukan' }}
                    </a>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm">
                    <form method="GET" action="{{ route('product.detail',$product) }}">
                      @csrf
                      <button type="submit" class="cursor-pointer bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded transition duration-200">
                        Lihat Produk
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
  </body>
<html>