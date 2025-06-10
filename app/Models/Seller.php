<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    /** @use HasFactory<\Database\Factories\SellerFactory> */
    use HasFactory;

    protected $fillable = [
        'shopname',
        'user_id',
        'profile_picture'
    ];

    public function product(){
        return $this->hasMany(Product::class);
    }
}
