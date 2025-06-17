<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
