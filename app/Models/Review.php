<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
    ];

    // Relasi ke User (siapa yang memberikan ulasan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Product (produk yang diulas)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}