<h2> Add to Cart </h2>

Nama produk : {{ $product->name }}<br>
Harga satuan : Rp{{ number_format($product->price, 0, ',', '.') }}<br>
Nama toko : {{ $product->seller->shopname }}<br>
Stok tersedia: {{ $product->stock }}<br><br>

<form method="POST" action="{{route('add.to.cart')}}">
    @csrf
    <label for="quantity">Jumlah yang ingin dibeli: </label>
    <input type="hidden" name="pid" value="{{$product->id}}">
    <input 
        type="number" 
        id="quantity" 
        name="quantity" 
        value="0" 
        min="0" 
        max="{{ $product->stock }}" 
        oninput="updateTotal()" 
        required
    ><br><br>

    Total harga: 
    <span id="total">Rp0</span><br><br>
    <button type="submit">Masukkan</button>
</form>

<button type="button" onclick="history.back();">Kembali</button>

<script>
    const price = {{ $product->price }};
    const maxStock = {{ $product->stock }};

    function updateTotal() {
        let quantityInput = document.getElementById('quantity');
        let quantity = parseInt(quantityInput.value);

        const total = price * quantity;
        document.getElementById('total').innerText = 'Rp' + total.toLocaleString('id-ID');
    }
</script>
