<?php
namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            view()->share('cart_count', Cart::where('user_id', Auth::id())->count());
            return $next($request);
        });
    }
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', compact('categories'));
    }

    public function show($categoryName)
    {
        $category = Category::where('category_name', $categoryName)->firstOrFail();
        $categories = Category::all();
        $products = Product::where('category', $categoryName)->get();

        return view('categories.show', compact('category', 'products', 'categories'));
    }
}

