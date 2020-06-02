<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\Category;
use App\Http\Requests\ProductsFilterRequest;
use App\Models\Product;
use App\Models\Subscription;


class MainController extends Controller
{
    public function index(ProductsFilterRequest $request){
//        dd($request
////        ->all());
        $productsQuery = Product::with('category');

        if($request->filled('price_from')){
            $productsQuery->where('price','>=',$request->price_from);
        }

        if($request->filled('price_to')){
            $productsQuery->where('price','<=',$request->price_to);
        }

        foreach (['hit', 'new', 'recommend'] as $field){
            if($request->has($field)){
                $productsQuery->$field();
            }
        }

        $products = $productsQuery->paginate(9)->withPath('?' . $request->getQueryString()); //для того что бы при перещёлкивании страниц передавались параметры фильтров
        return view('main', compact('products'));
    }

    public function categories(){
        $categories = Category::get();
        return view('categories', compact('categories'));
    }
    public function product($category, $productCode){
        $product = Product::withTrashed()->byCode($productCode)->firstOrFail();
        return view('product', compact('product'));
    }
    public function category($category){
        $category = Category::where('code', $category)->first();
        return view('category', compact('category'));
    }

    public function subscribe(SubscriptionRequest $request, Product $product)
    {
        Subscription::create([
            'email' => $request->email,
            'product_id' => $product->id,
        ]);
        return redirect()->back()->with('success', 'Сообщим вам когда появится товар');
    }
}
