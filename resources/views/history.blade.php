
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="flex p-4 justify-between items-center bg-gray-100">
        <h1 class="text-2xl font-bold mb-4">Purchase History</h1>
        <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline mb-4 inline-block">Back to Dashboard</a>
    </div>
    @if (count($history) == 0)
        <div class="bg-white rounded-lg shadow-md p-4">
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
                                <select name="rating" id="rating-{{$purchase->id}}" required class="w-full border p-1 rounded">
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
                            <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">Kirim Ulasan</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    @endif                 
    <h1>Your Purchase History</h1>
    <ul>
        <li>Name: {{ Auth::user()->name }}</li>
        <li>Email: {{ Auth::user()->email }}</li>
    </ul>
    <form method="GET" action="{{ route('dashboard') }}">
        @csrf
        <button type="submit">Back to dashboard</button><br><br>
    </form>
<table border="1" cellpadding="5" cellspacing="0"> 
  <thead> 
    <tr> 
      <th style="width: 50px">Tanggal</th> 
      <th style="width: 300px">Produk</th> 
      <th style="width: 120px">Jumlah</th>
      <th style="width: 120px">Harga</th>
      <th style="width: 120px">Total</th>
      <th style="width: 120px">Recieved</th>
    </tr> 
  </thead> 
  <tbody> 
    @foreach($history as $row) 
      <tr> 
        <td> 
           {{$row->bought_at}} 
        </td> 
        <td> 
          {{$row->item}}
        </td>
        <td> 
          {{$row->amount}}
        </td> 
        <td> 
          {{$row->price}}
        </td>
        <td> 
          {{$row->price*$row->amount}}
        </td>
        <td> 
          @if($row->fullfilled)
          Yes
          @else
          No
          @endif
        </td>
      </tr> 
    @endforeach 
  </tbody> 
</table> 
</body>
</html>