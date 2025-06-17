@php
$allow = true;
@endphp
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Cart</title>
      @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body>
      <div class="flex p-4 justify-between items-center bg-gray-100">
          <h1 class="text-2xl font-bold mb-4">Your Cart</h1>
          <a href="{{ route('dashboard') }}" class="text-blue-500 hover:underline mb-4 inline-block">Back to Dashboard</a>
      </div>

      @isset($failed)
        <h2>{{$failed}}</h2>
      @endisset
  <!-- <table border="1" cellpadding="5" cellspacing="0"> 
    <thead> 
      <tr> 
        <th style="width: 300px">Produk</th> 
        <th style="width: 120px">Jumlah</th>
        <th style="width: 120px">Harga</th>
        <th style="width: 120px">Total</th>
        <th style="wodth: 200px">Manage</th>
      </tr> 
    </thead> 
    @php
      $end = 0;
    @endphp
    <tbody> 
      @foreach($items as $row)
      @php
      $p = DB::table('products')->where('id',$row['productId'])->firstOrFail();
      $end = $end + $p->price*$row['amount'];
      @endphp
        <tr> 
          <td> 
            {{$p->name}}
          </td>
          <td> 
            <a href="/changeamount/{{$p->id}}">{{$row['amount']}}</a>
            @if($row['amount'] > $p->stock)
            @php
            $allowed = false;
            @endphp
            <p>*</p>
            @endif
          </td> 
          <td> 
            {{$p->price}}
          </td>
          <td> 
            {{$p->price*$row['amount']}}
          </td>
          <td>
            <a href="/removecart/{{$p->id}}">Remove</a>
          </td>
        </tr> 
      @endforeach 
      <tr> 
          <td> 
          TOTAL
          </td>
          <td> 
            -
          </td> 
          <td> 
            -
          </td>
          <td> 
            {{$end}}
          </td>
          <td>
            -
          </td>
        </tr> 
    </tbody> 
  </table>  -->
  <div class="grid grid-cols-1 gap-6 mb-8">
    @if(count($items) == 0)
    <div class="bg-white rounded-lg shadow-md p-4">
      <h3 class="font-semibold text-lg text-gray-800 mb-2">Your cart is empty</h3>
      <p class="text-gray-600 text-sm mb-3">Add some products to your cart to see them here.</p>
    </div>
    @else
      @foreach($items as $row)
        @php
        $p = DB::table('products')->where('id',$row['productId'])->firstOrFail();
        if($row['amount'] > $p->stock) {
          $allow = false;
        }
        @endphp
        <div class="bg-white rounded-lg shadow-md p-4">
          <h3 class="font-semibold text-lg text-gray-800 mb-2">
            {{ $p->name }}
          </h3>
          <p class="text-gray-600 text-sm mb-3">
            {{ Str::limit($p->description, 100) }}
          </p>
          <p class="text-gray-600 text-sm mb-3">
            Price: Rp {{ number_format($p->price, 0, ',', '.') }}
          </p>
          <p class="text-gray-600 text-sm mb-3">
            Amount: <a href="/changeamount/{{$p->id}}">{{$row['amount']}}</a>
            @if($row['amount'] > $p->stock)
            <span class="text-red-500">* Stock not available for the amount requested</span>
            @endif
          </p>
          <p class="text-gray-600 text-sm mb-3">
            Total: Rp {{ number_format($p->price * $row['amount'], 0, ',', '.') }}
          </p>
          <div>
            <form method="POST" action="/removecart/{{$p->id}}" class="inline-block">
              @csrf
              @method('DELETE')
              <button type="submit" class="cursor-pointer bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition duration-200">
                Remove
              </button>
            </form>
            <form method="GET" action="/changeamount/{{$p->id}}" class="inline-block">
              @csrf
              <button type="submit" class=" cursor-pointer bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">
                Change Amount
              </button>
            </form>
          </div>
        </div>
      @endforeach
    @endif
  </div>
  <div class="flex justify-between items-center bg-gray-100 p-4">
      <div class="p-4">
        <p>Balance : Rp {{ number_format(Auth::user()->balance, 0, ',', '.') }}</p>
        <p>Total Purchase : Rp {{ number_format($end, 0, ',', '.') }}</p>
        @if($end > Auth::user()->balance)
          <p class="text-red-500">Remaining Balance : Insufficient funds</p>
        @else
          <p>Remaining Balance : Rp {{ number_format(Auth::user()->balance - $end, 0, ',', '.') }}</p>
        @endif
      </div>

      @if($end > Auth::user()->balance)
      <p>You don't have enough balance to buy these items</p>
      @elseif($allow)
      
      <div class="p-4">
        <form method="POST" action="{{ route('buy') }}">
            @csrf
            <br>
            <button type="submit" class="cursor-pointer bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-200">Complete Purchase</button>
            @if (session('error'))
            <p class="text-red-500 text-sm">{{ session('error') }}</p>
            @elseif (session('success'))
            <p class="text-green-500 text-sm">{{ session('success') }}</p>
            @endif
        </form>
      </div>
      @else
      <p>* Stock not available for the amount requested</p>
      @endif
  </div>
  </body>
</html>