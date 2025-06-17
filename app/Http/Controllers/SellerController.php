<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Seller;
use App\Models\Product;

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

    public function showOrders(Request $request){
        $sid = DB::table('sellers')->where('user_id' , Auth::user()->id)->firstOrFail()->id;
        $hist = DB::table('histories')->whereIn('product_name' , Product::where('seller_id' , $sid)->get())->orderBy('fullfilled' , 'ASC')->orderBy('bought_at' , 'ASC')->get();
        return view('manage-orders')->with('orders' , $hist);
    }
}
