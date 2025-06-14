<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Seller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    private function getProducts(Request $request){
        $id = Auth::user()->id;
        $seller = DB::table('sellers')->where('user_id' , $id)->first();
        $sellerId = $seller->id;
        $query = DB::table('products')->orderBy('id' , 'asc')->where('seller_id' , $sellerId);
        $products = $query->get();
        return $products;
    }

    public function showProducts(Request $request){
        $id = Auth::user()->id;
        $seller = DB::table('sellers')->where('user_id' , $id)->first();
        if($seller){
            return view('product-list')->with('products' , ProductController::getProducts($request));
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

        Product::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'stock' => $validated['stock'],
            'category_id' => $validated['categories'],
            'seller_id' => $sellerId,
        ]);

        return redirect('/products')->with('products' , ProductController::getProducts($request));
    }

    public function manageProductRedirect(Request $request , int $i){
        $p = DB::table('products')->where('id' ,$i)->first();
        return view('manage-product')->with('product' , $p);
    }

    public function changeProduct(Request $request){
        $validated = $request->validate([
            'id' => 'required',
            'name' => "required|string|max:40",
            'description' => "nullable|string",
            'price' => 'required|decimal:0,4',
            'stock' => 'required|integer',
            'category_id' => 'required'
        ]);
        $product = DB::table('products')->where('id' , $request['id'])->update($validated);
        return view('product-list')->with('products' , ProductController::getProducts($request));
    }

    public function deleteProduct(Request $request , int $product_id){
        $sellerId = DB::table('sellers')->where('user_id' , Auth::user()->id)->firstorfail()->id;
        $product = DB::table('products')->where('id' , $product_id);
        if($sellerId == $product->firstorfail()->seller_id){
            $product->delete();
            return redirect('/products')->with('products' , ProductController::getProducts($request));
        } else {
            return redirect('/');
        }
    }
    
}
