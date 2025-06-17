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

    public function buy(Request $request){
        $cart = $request->session()->get('cart');
        $user = Auth::user();
        $bal = $user->balance;

        foreach($cart as $item){
            $p = Product::where('id',$item['productId'])->firstOrFail();
            $p->stock = $p->stock - $item['amount'];
            $bal = $bal - $p->price * $item['amount'];

            DB::table('histories')->insert([
                'bought_at' => now(),
                'user_id' => $user->id,
                'product_name' => $p->name,
                'amount' => $item['amount'],
                'fullfilled' => false,
                'price' => $p->price,
            ]);
        }

        $user->balance = $bal;
        $user->save();

        $request->session()->put('cart' , []);

        return redirect('/cart');
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

