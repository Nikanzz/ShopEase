<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Seller;

class SellerController extends Controller
{
    public function becomeSeller(Request $request){
        return view('seller-register');
    }

    public function createNewSeller(Request $request){
        $val = $request->validate([
            'name' => 'required|string|max:40'
        ]);
        $user = Auth::user();
        $id = $user->id;

        Seller::create([
            'user_id' => $id,
            'shopname' => $val['name']
        ]);

        $request->session()->regenerate();
        return redirect('/dashboard');
    }
}
