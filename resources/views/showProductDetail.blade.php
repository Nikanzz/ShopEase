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

  <form method="GET" action="{{ route('purchase' , $product) }}">
    <button>
    MASUKKAN KERANJANG
    </button>
  </form>
  <h2>ULASAN</h2>

@auth
    <h3>Berikan Ulasan Anda</h3>
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <div>
            <label for="rating">Rating:</label>
            <select name="rating" id="rating" required>
                <option value="">Pilih Rating</option>
                <option value="5">⭐⭐⭐⭐⭐ (Sangat Baik)</option>
                <option value="4">⭐⭐⭐⭐ (Baik)</option>
                <option value="3">⭐⭐⭐ (Cukup)</option>
                <option value="2">⭐⭐ (Kurang)</option>
                <option value="1">⭐ (Buruk)</option>
            </select>
            @error('rating')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="comment">Komentar:</label>
            <textarea name="comment" id="comment" rows="4" placeholder="Tulis ulasan Anda di sini..."></textarea>
            @error('comment')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Kirim Ulasan</button>
    </form>
    <hr>
@else
    <p>Anda harus <a href="{{ route('login') }}">login</a> untuk memberikan ulasan.</p>
@endauth
@if(DB::table('reviews')->where('product_id' , $product->id)->exists())
@foreach (DB::table('reviews')->where('product_id' , $product->id)->get() as $review)
    <div>
        <strong>{{ DB::table('users')->where('id' , $review->user_id)->first()->username }}</strong> -
        <span>Rating: {{ str_repeat('⭐', $review->rating) }}</span>
        <p>{{ $review->comment }}</p>
        <small>Pada: {{ $review->created_at }}</small>
    </div>
    <hr>
@endforeach
@else 
<p>Belum ada ulasan untuk produk ini.</p>
@endif