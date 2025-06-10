<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Menyimpan ulasan baru
    public function store(Request $request, $productId)
    {
        // Validasi input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Cek apakah produk ada
        $product = Product::findOrFail($productId);

        // Simpan ulasan
        Review::create([
            'user_id' => Auth::id(), // ID user yang login
            'product_id' => $productId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Ulasan berhasil ditambahkan!');
    }

    // Hapus ulasan (opsional)
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        
        // Pastikan hanya pemilik ulasan yang bisa hapus
        if ($review->user_id == Auth::id()) {
            $review->delete();
            return back()->with('success', 'Ulasan dihapus!');
        }

        return back()->with('error', 'Akses ditolak!');
    }
}