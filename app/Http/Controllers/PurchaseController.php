<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\ValidationException;
use App\Models\Seller;
class PurchaseController extends Controller
{
    
    public function purchase(Product $product){
        $saldo = Auth::user()->balance;
        Log::info('Saldo user: ' . $saldo);
        Log::info('Harga produk: ' . $product->price);
                            
        return view('Purchase')->with('product', $product);
    }

    public function addToCart(Request $request){
        $productId = (int)($request->pid);
        $amount = $request->quantity;

        $request->session()->push('cart' , ['productId'=>$productId , 'amount'=>$amount]);
        $categoryid = $request->session()->get('categoryid');
        return redirect("/category/$categoryid");
    }

    public function showCart(Request $request){
        $cart = $request->session()->get('cart');
        Log::info($cart);
        if($cart == null) $cart = [];
        return view('cart')->with('items' , $cart);
    }

    public function removeFromCart(Request $request , int $id){
        $cart = $request->session()->get('cart');
        define('w' , $id);
        $request->session()->put('cart' , array_filter($cart,function($item){return $item['productId']!==w;}));
        return redirect('/cart');
    }
}

