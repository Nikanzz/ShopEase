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
        $amount = (int)($request->quantity);

        $request->session()->push('cart' , ['productId'=>$productId , 'amount'=>$amount]);
        $categoryid = $request->session()->get('categoryid');
        return redirect('/cart')->with('success', 'Product added to cart successfully!');
    }

    public function showCart(Request $request){
        $cart = $request->session()->get('cart');
        Log::info($cart);
        if($cart == null) $cart = [];
        $totalCost = 0;
        foreach ($cart as $item) {
            $product = Product::findOrFail($item['productId']);
            $totalCost += $product->price * $item['amount'];
        }
        return view('cart')->with([
            'items' => $cart,
            'totalCost' => $totalCost
        ]);
    }

    public function removeFromCart(Request $request , int $id){
        $cart = $request->session()->get('cart');
        define('w' , $id);
        $request->session()->put('cart' , array_filter($cart,function($item){return $item['productId']!==w;}));
        return redirect('/cart');
    }

    public function buy(Request $request){
        $cart = $request->session()->get('cart');

        if ($cart == null || count($cart) == 0){
            return redirect('/cart')->with('error', 'Your cart is empty.!');
        }

        $user = Auth::user();

        $totalCost = 0;
        foreach ($cart as $item) {
            $product = Product::findOrFail($item['productId']);
            $totalCost += $product->price * $item['amount'];
        }

        foreach ($cart as $item) {
            $product = Product::findOrFail($item['productId']);

            $product->stock -= $item['amount'];
            $product->save();

            DB::table('histories')->insert([
                'bought_at' => now(),
                'user_id' => $user->id,
                'product_name' => $product->name,
                'amount' => $item['amount'],
                'fullfilled' => false,
                'price' => $product->price,
                'product_id' => $product->id,
            ]);
        }

        $user->balance -= $totalCost;
        $user->save();
        $request->session()->put('cart' , []);

        return redirect('/cart')->with('success', 'Purchase successful!');
    }

    public function showChangeAmount(Request $request , int $id){
        $p = Product::where('id' , $id)->firstOrFail();
        return view('change-amount')->with("product" , $p);
    }

    public function processChangeAmount(Request $request){
        $cart = $request->session()->get('cart');
        $newCart = array();
        foreach($cart as $item){
            if($item['productId']==$request->pid){
                $item['amount'] = $request->quantity;
            }
            array_push($newCart , $item);
        }
        $request->session()->put('cart' , $newCart);
        return redirect('/cart');
    }
}

