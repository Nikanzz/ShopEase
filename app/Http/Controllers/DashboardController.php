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

        $products = Product::latest()->take(10)->get();

        return view('dashboard', compact('products', 'categories'));
    }
}
