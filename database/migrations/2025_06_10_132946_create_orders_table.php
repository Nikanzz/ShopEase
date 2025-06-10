<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relasi ke user
            $table->decimal('total_amount', 10, 2); // Total harga (contoh: 100000.00)
            $table->string('status')->default('pending'); // Status pesanan (pending/success/failed)
            $table->text('shipping_address'); // Alamat pengiriman
            $table->string('payment_method'); // Metode pembayaran (cod/transfer)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
