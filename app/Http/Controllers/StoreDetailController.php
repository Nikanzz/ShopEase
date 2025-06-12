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
class StoreDetailController extends Controller
{
    

    public function showStoreDetail(Seller $seller){

        $id = $seller->id;
        
        $products = Product::where('seller_id', $id)
                           ->get();
                           
        return view('StoreDetail')->with('seller', $seller)
        ->with('product', $products);

    }
}

