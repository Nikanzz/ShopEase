<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $validated = $request->validate([
            'name' => "required|string|max:40",
            'description' => "nullable|string",
            'price' => 'required|decimal:0,4',
            'stock' => 'required|integer',
            'categories' => 'required'
        ]);
        Log::info($validated);

        $id = Auth::user()->id;
        $seller = DB::table('sellers')->where('user_id' , $id)->first();
        $sellerId = $seller->id;

        DB::table('products')->insert([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category_id' => $validated['categories'],
            'seller_id' => $sellerId,
        ]);
        $query = DB::table('products')->orderBy('name' , 'asc')->where('seller_id' , $sellerId);
        $products = $query->get();
        return view('product-list')->with('products' , $products);
    }
}
