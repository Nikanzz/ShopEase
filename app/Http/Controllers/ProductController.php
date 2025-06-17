<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Product; // import
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function show(Product $product) // Menggunakan Route Model Binding
    {
        // Ambil ulasan untuk produk ini, bersama dengan informasi user yang memberikan ulasan
        $reviews = $product->reviews()->with('user')->latest()->get();

        return view('poduct.show', compact('product', 'reviews'));
        // Pastikan Anda meneruskan variabel $reviews ke view
    }

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
        $query =DB::table('products')->where('id' , $request['id']);
        DB::table('histories')->where('product_name' , $query->firstorFail()->name)->update(['product_name' => $validated['name']]);
        $product = $query->update($validated);
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

    public function searchProduct(Request $request){
        $validated = $request->validate([
            'query' => 'required|string|max:255',
        ]);
        $query = $validated['query'];

        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(12);

        return view('search-results', compact('products', 'query'));
    }
    
    public function sendProduct(Request $request , int $hid){
        $history = DB::table('histories')->where('id' , $hid)->firstOrFail();
        $history->fullfilled = true;
        $history->save();
        return redirect('/orders');
    }
}
