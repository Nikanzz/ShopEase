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
class ProductDetailController extends Controller
{
    public function showProductDetail(Product $product){
        
        $id = $product->seller_id;
        $seller = Seller::find($id); 


        return view('showProductDetail')
        ->with('product', $product)
        ->with('seller', $seller);

    }

    
}

