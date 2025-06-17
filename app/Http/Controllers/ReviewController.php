<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'history_id' => 'required|exists:histories,id|unique:reviews,history_id',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id'    => Auth::id(), 
            'product_id' => $request->product_id,
            'history_id' => $request->history_id, 
            'rating'     => $request->rating,
            'comment'    => $request->comment,
            ]);

        return back()->with('success', 'Ulasan Anda berhasil ditambahkan!');
    }
}