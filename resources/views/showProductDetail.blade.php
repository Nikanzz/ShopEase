@if (session('error'))
    <div id="error-alert" style="background-color: red; color: white; padding: 10px; border-radius: 5px; margin-bottom: 15px;">
        {{ session('error') }}
    </div>

    <script>
        // Hilangkan alert setelah 5 detik (5000ms)
        setTimeout(function() {
            const alert = document.getElementById('error-alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000);
    </script>
@endif

<h2> {{$product->name}}  </h2>
Saldo anda: Rp.{{ Auth::user()->balance }} <br><br>
<form method="GET" action="{{ route('dashboard') }}">
        @csrf
        <button type="submit">Back to Dashboard</button>
    </form>

<table border="1" cellpadding="5" cellspacing="0"> 
  <thead> 
    <tr> 
      <th style="width: 50px">nama produk</th> 
      <th style="width: 300px">harga</th> 
      <th style="width: 300px">stok</th> 
      <th style="width: 300px">deskripsi</th> 
      <th style="width: 300px">Nama toko</th> 
    </tr> 
  </thead> 
  <tbody> 
      <tr> 
        <td> 
          
           {{$product->name}} 

        </td> 
        <td> 
          Rp.{{$product->price}}
        </td>
        <td> 
          {{$product->stock}}
        </td>
        

        <td> 
          {{$product->description}}
        </td>

        <td> 
          <a href="{{ route('store.detail', $seller) }}">
          {{$seller->shopname}}
</a>
        </td>
      </tr> 
 
  </tbody> 
</table>  

<br>

<form method="GET" action="{{ route('purchase', $product->id)  }}">
        @csrf
<button>
BELI
</button>
</form>


<button>
MASUKKAN KERANJANG
</button>
<h2>
ULASAN 
</h2>


