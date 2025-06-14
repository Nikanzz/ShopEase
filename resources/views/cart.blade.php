
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
  <tbody> 
    @foreach($items as $row)
    @php
    $p = DB::table('products')->where('id',$row['productId'])->firstorfail();
    @endphp
      <tr> 
        <td> 
          {{$p->name}}
        </td>
        <td> 
          <a>{{$row['amount']}}</a>
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
  </tbody> 
</table> 
</body>
</html>