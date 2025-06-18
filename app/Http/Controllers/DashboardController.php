<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {   
        $categories = Category::all();
        $categories = array_slice($categories ,1 );

        $products = Product::latest()->take(10)->get();
        $products = array_slice($products , 1);

        return view('dashboard', compact('products', 'categories'));
    }
}
