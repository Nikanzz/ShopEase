@php
$allow = true;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <ul>
    </ul>
    <form method="GET" action="{{ route('dashboard') }}">
        @csrf
        <button type="submit">Back to dashboard</button><br><br>
    </form>

    @isset($failed)
      <h2>{{$failed}}</h2>
    @endisset
<table border="1" cellpadding="5" cellspacing="0"> 
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
</table> 
  <p>Balance : {{Auth::user()->balance}}</p>
  @if($end > Auth::user()->balance)
  <p>You don't have enough balance to buy these items</p>
  @elseif($allow)
  <form method="GET" action="{{route('buy')}}">
  @csrf
  <br>
  <button type="submit">COMPLETE PURCHASE</button>
  </form>
  @else
  <p>* Stock not available for the amount requested</p>
  @endif
</body>
</html>