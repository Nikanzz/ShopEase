<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function showProducts(Request $request){
        $id = Auth::user()->id;
        $seller = DB::table('sellers')->where('user_id' , $id)->first();
        if($seller){
            $sellerId = $seller->id;
            $query = DB::table('products')->orderBy('name' , 'asc')->where('seller_id' , $sellerId);
            $products = $query->get();
            return view('product-list')->with('products' , $products);
        }
        return redirect('/dashboard');
    }

    public function redirectCreateProduct(Request $request){
        return view('create-product');
    }

    public function createProduct(Request $request){

    }
}
