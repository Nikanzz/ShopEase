<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product; // Jika perlu validasi product_id
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate(['product_id' => 'required|exists:products,id','rating' => 'required|integer|min:1|max:5','comment' => 'nullable|string|max:1000',
        ]);

        // Pastikan user belum pernah mengulas produk ini (opsional, tapi disarankan)
        $existingReview = Review::where('user_id', Auth::id())->where('product_id', $request->product_id)->first();

        if ($existingReview) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk produk ini.');
        }

        // Buat ulasan baru
        Review::create([
            'user_id' => Auth::id(), // ID user yang sedang login
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Ulasan Anda berhasil ditambahkan!');
    }
}