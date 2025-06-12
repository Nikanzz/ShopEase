<h2>{{$seller->shopname}}</h2>

<form method="GET" action="{{ route('dashboard') }}">
        @csrf
        <button type="submit">Back to Dashboard</button>
</form>

<h2> Daftar produk {{$seller->shopname}}</h2>

<table border="1" cellpadding="5" cellspacing="0"> 
  <thead> 
    <tr> 
      <th style="width: 50px">nama produk</th> 
      <th style="width: 300px">harga</th> 
      <th style="width: 300px">aksi</th> 
    </tr> 
  </thead> 
  <tbody> 
    @foreach($product as $products) 
      <tr> 
        <td> 
           {{$products->name}} 
        </td> 
        <td> 
          Rp.{{$products->price}}
        </td>

        <td>
          
        <form method="GET" action="{{ route('product.detail',$products)  }}">
        @csrf
            <button type="submit">Lihat Produk</button>
        </form>
</td>
      </tr> 
    @endforeach 
  </tbody> 
</table>     

