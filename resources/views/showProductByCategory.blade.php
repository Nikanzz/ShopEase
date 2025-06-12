<h2>
  Kategori {{$category->name}}
</h2>
<form method="GET" action="{{ route('dashboard') }}">
        @csrf
        <button type="submit">Back to Dashboard</button>
    </form>
<table border="1" cellpadding="5" cellspacing="0"> 
  <thead> 
    <tr> 
      <th style="width: 50px">nama produk</th> 
      <th style="width: 300px">harga</th> 
      <th style="width: 300px">nama toko</th> 
      <th style="width: 300px">aksi</th> 
    </tr> 
  </thead> 
  <tbody> 
    @foreach($products as $product) 
      <tr> 
        <td> 
           {{$product->name}} 
        </td> 
        <td> 
          Rp.{{$product->price}}
        </td>

        <td>
          <a href="{{ route('store.detail', $product->seller) }}">
        {{ $product->seller->shopname ?? 'Toko tidak ditemukan' }}
</a>
        </td>

        <td>
        <form method="GET" action="{{ route('product.detail',$product)  }}">
        @csrf
            <button type="submit">Lihat Produk</button>
        </form>
</td>
      </tr> 
    @endforeach 
  </tbody> 
</table>     

