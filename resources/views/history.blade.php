
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="flex p-4 justify-between items-center bg-gray-100 px-10 py-5">
        <h1 class="text-2xl font-bold mb-4">Purchase History</h1>
        <form method="GET" action="{{ route('dashboard') }}" class="inline-block">
            @csrf
            <button type="submit" class="bg-blue-100 hover:bg-blue-200 cursor-pointer text-gray-700 px-6 py-3 rounded-lg flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Dashboard
            </button>
        </form>
    </div>
    @if (count($history) == 0)
        <div class="bg-white rounded-lg shadow-md flex justify-center">
            <h3 class="font-semibold text-lg text-gray-800 mb-2">No purchase history available</h3>
            <p class="text-gray-600 text-sm mb-3">You haven't made any purchases yet.</p>
        </div>
    @else
        <div class="grid grid-cols-1 gap-6 mb-8 p-4 mx-w-4xl">
            @foreach ($history as $purchase)
                <div class="flex justify-between bg-white rounded-lg shadow-md p-4">
                    <div>
                      <h3 class="font-semibold text-lg text-gray-800 mb-2">
                          Produk: {{ $purchase->item}}
                      </h3>
                      <p class="text-gray-600 text-sm mb-3">
                          Date: {{ $purchase->bought_at }}
                      </p>
                      <p class="text-gray-600 text-sm mb-3">
                          Amount: {{ $purchase->amount }}
                      </p>
                      <p class="text-gray-600 text-sm mb-3">
                          Price: Rp {{ number_format($purchase->price, 0, ',', '.') }}
                      </p>
                      <p class="text-gray-600 text-sm mb-3">
                          Total: Rp {{ number_format($purchase->price * $purchase->amount, 0, ',', '.') }}
                      </p>
                      <p class="text-gray-600 text-sm mb-3">
                          Recieved: {{ $purchase->fullfilled ? 'Yes' : 'No' }}
                      </p>
                    </div>
                    @if($purchase->review)
                        <div class="p-3 rounded">
                            <p class="text-gray-800">{{ $purchase->review->comment }}</p>
                            <small class="text-gray-500">Reviewed on: {{ $purchase->review->created_at->format('d M Y') }}</small>
                        </div>
                    @else
                        <form method="POST" action="{{ route('reviews.store') }}" class="w-full md:w-1/3">
                            @csrf
                            <input type="hidden" name="history_id" value="{{ $purchase->id }}">
                            <input type="hidden" name="product_id" value="{{ $purchase->product_id }}">
                            
                            <div class="mb-2">
                                <label for="rating-{{$purchase->id}}">Rating:</label>
                                <select name="rating" id="rating-{{$purchase->id}}" required class="w-full border p-1 rounded cursor-pointer">
                                    <option value="">Pilih Rating</option>
                                    <option value="5">⭐⭐⭐⭐⭐</option>
                                    <option value="4">⭐⭐⭐⭐</option>
                                    <option value="3">⭐⭐⭐</option>
                                    <option value="2">⭐⭐</option>
                                    <option value="1">⭐</option>
                                </select>
                            </div>
                            <div class="mb-2">
                                <label for="comment-{{$purchase->id}}">Komentar:</label>
                                <textarea name="comment" id="comment-{{$purchase->id}}" rows="3" placeholder="Tulis ulasan Anda..." class="w-full border p-1 rounded"></textarea>
                            </div>
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 cursor-pointer">Kirim Ulasan</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @endif                 
</body>
</html>