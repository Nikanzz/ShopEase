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
use App\Models\Seller;

use Illuminate\Support\Facades\ValidationException;

class ProductByCategoryController extends Controller
{
    public function showProductByCategory(Request $request, Category $category){
        Log::info($category);
        $ids = $category->id;

        
        $id = Auth::user()->id;
        $seller = DB::table('sellers')->where('user_id' , $id)->first();
        
        if($seller){
            $products = Product::where('category_id', $ids)
                           ->where('seller_id', '!=', $seller->id)
                           ->with('seller')
                           ->get();
        }
        else{
            $products = Product::where('category_id', $ids)->with('seller')->get();
        }
        
        $request->session()->put('categoryid',$ids);
        return view('showProductByCategory')
        ->with('products', $products)
        ->with('category', $category);

    }


}

