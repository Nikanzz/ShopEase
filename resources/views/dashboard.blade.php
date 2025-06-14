<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
    <p>You are logged in!</p>

    <h2>User Information</h2>
    <ul>
        <li>Name: {{ Auth::user()->name }}</li>
        <li>Email: {{ Auth::user()->email }}</li>
        <li>Saldo: {{ Auth::user()->balance }}</li>
    </ul>
    <form method="GET" action="{{ route('profile') }}">
        @csrf
        <button type="submit">Profile</button>
    </form>

    <form method="GET" action="{{ route('topup') }}">
        @csrf
        <button type="submit">Top-up</button>
    </form>
    <br>

    <form method="GET" action="{{ route('purchase.history') }}">
        @csrf
        <button type="submit">Riwayat</button>
    </form>
    <br>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <br>
    <br>

    @if (DB::table('sellers')->where('user_id' , Auth::user()->id)->exists())
        <h1>You are a seller!</h1>
        <h2>Manage your shop: {{ DB::table('sellers')->where('user_id' , Auth::user()->id)->first()->shopname }}</h2>
        <br>
        <form method="GET" action="{{ route('product.list') }}">
            @csrf
            <button type="submit">Manage Products</button>
        </form>
        <br>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Manage orders</button>
        </form>
        <br>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Order history</button>
        </form>
        <br>
    @else
        <h1>You are not a seller!</h1>
        <br>
        <form method="POST" action="{{ route('become.seller') }}">
        @csrf
            <button type="submit">Become a seller</button>
        </form>
    @endif
    
  <h2>Kategori Produk</h2>
<table border="1" cellpadding="5" cellspacing="0"> 
  <thead> 
    
  </thead> 
  <tbody> 
    @foreach($category as $categories) 
      <tr> 

      
        <td>
          {{Log::info($categories)}} 
           <a href = "{{ route('product.category', $categories) }}"> 
           {{$categories->name}} 
            </a>
        </td> 
        

  
      </tr> 
    @endforeach 
  </tbody> 
</table>

</body>
</html>