<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index(){
        $products = Product::get();
        return view('main', compact('products'));
    }
    public function categories(){
        $categories = Category::get();
        return view('categories', compact('categories'));
    }
    public function product($category ,$product = null){
        return view('product', compact('category', 'product'));
    }
    public function category($category){
        $category = Category::where('code', $category)->first();
        return view('category', compact('category'));
    }

}
