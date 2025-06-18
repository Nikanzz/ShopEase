<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {   
        $products = Product::latest()->take(11)->get()->slice(0,10);
        $categories = Category::all()->slice(1);


        return view('dashboard', compact('products', 'categories'));
    }
}
