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
    
    public function Purchase(Product $product){
    $saldo = Auth::user()->balance;
    Log::info('Saldo user: ' . $saldo);
    Log::info('Harga produk: ' . $product->price);

    if($saldo < $product->price){
        return redirect()->route('product.detail', $product->id)
                         ->with('error', 'Saldo tidak cukup');
    }    
                           
        return view('Purchase')->with('product', $product);
    }

    

}

