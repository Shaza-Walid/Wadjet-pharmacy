<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->inRandomOrder()->take(8)->get();
        $offers = Product::with('category')->where('has_offer', true)->take(4)->get();
        $categories = Category::all();
        
        return view('pages.home', compact('products', 'offers', 'categories'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function cart()
    {
        return view('pages.checkout.cart');
    }

    public function checkout()
    {
        return view('pages.checkout.index');
    }
}
