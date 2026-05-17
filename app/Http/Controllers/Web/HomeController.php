<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::where('is_active', true)
            ->withCount('products')
            ->get();

        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with('category')
            ->limit(8)
            ->get();

        $latestProducts = Product::where('is_active', true)
            ->with('category')
            ->latest()
            ->limit(8)
            ->get();

        return view('home', compact('categories', 'featuredProducts', 'latestProducts'));
    }
}
