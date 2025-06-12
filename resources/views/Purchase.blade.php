<h2> Pembelian produk </h2>

Nama produk : {{ $product->name }}<br>
Harga satuan : Rp{{ number_format($product->price, 0, ',', '.') }}<br>
Nama toko : {{ $product->seller->shopname }}<br>
Stok tersedia: {{ $product->stock }}<br><br>

<!--form-->
    <!--csrf-->

    Jumlah yang ingin dibeli: 
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

    <button type="submit">BELI</button>
<!--</form>-->

<script>
    const price = {{ $product->price }};
    const maxStock = {{ $product->stock }};

    function updateTotal() {
        let quantityInput = document.getElementById('quantity');
        let quantity = parseInt(quantityInput.value);

        // Batasi jumlah jika lebih dari stok
        if (quantity > maxStock) {
            quantity = maxStock;
            quantityInput.value = maxStock;
        }

        const total = price * quantity;
        document.getElementById('total').innerText = 'Rp' + total.toLocaleString('id-ID');
    }
</script>
