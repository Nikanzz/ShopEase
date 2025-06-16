<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'min_stock',
        'category_id',
        'seller_id',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
