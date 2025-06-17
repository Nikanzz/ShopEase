
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
</head>
<body>
    <h1>Manage Orders</h1>
    <ul>
        <li>Shop: {{ DB::table('sellers')->where('user_id' ,Auth::user()->id)->firstOrFail()->shopname }}</li>
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
      <th style="width: 300px">Kepada</th> 
      <th style="width: 120px">Jumlah</th>
      <th style="width: 120px">Harga</th>
      <th style="width: 120px">Total</th>
    </tr> 
  </thead> 
  <tbody> 
    @foreach($orders as $row) 
      <tr> 
        <td> 
           {{$row->bought_at}} 
        </td> 
        <td> 
          {{$row->item}}
        </td>
        <td> 
          {{DB::table('users')->where($row->user_id)->username}}({{$row->user_id}})
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
      </tr> 
    @endforeach 
  </tbody> 
</table> 
</body>
</html>