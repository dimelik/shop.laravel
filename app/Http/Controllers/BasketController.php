<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function basket(){
        $orderId = session('orderId');
                if(!is_null($orderId)){
            $order = Order::findOrFail($orderId);
        }
        return view('basket', compact('order'));
    }

    public function basketPlace(){
        $order = new Order();
        $orderId = session('orderId');

        if(is_null($orderId)){
        return redirect()->route('index');
        }
        $order = Order::find($orderId);
        return view('order', compact('order'));
    }

    public function basketConfirm(Request $request){
        $orderId = session('orderId');

        if(is_null($orderId)){
            return redirect()->route('index');
        }
        $order = Order::find($orderId);
        $success = $order->saveOrder($request->name, $request->phone);
        if($success){
            session()->flash('success','Ваш заказ принят в обработку');
        }else{
            session()->flash('warning','Ошибка при подтверждении заказа');
        }

        Order::eraseOrderSum();

        return redirect()->route('index');
    }

    public function basketAdd($productId){

        $orderId = session('orderId');
        if(is_null($orderId)){
            $order = Order::create();
            session(['orderId' => $order->id]);
        }else{
            $order = Order::find($orderId);
        }

        if($order->products->contains($productId)){//Проверяет содержится ли в order_product запись
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            $pivotRow->count++;
            $pivotRow->update();
        }else{
            $order->products()->attach($productId);
        }

        if(Auth::check()){
            $order->user_id = Auth::id();
            $order->save();
        }

        $product = Product::find($productId);

        Order::changeFullSum($product->price);

        session()->flash('success','Добавлен товар '. $product->name);

        return redirect()->route('basket');;
    }

    public function basketRemove($productId){
        $orderId = session('orderId');
        if(is_null($productId)){
            return view('basket');
        }
        $order = Order::find($orderId);
        if($order->products->contains($productId)){//Проверяет содержится ли в order_product запись
            $pivotRow = $order->products()->where('product_id', $productId)->first()->pivot;
            if($pivotRow->count < 2){
                $order->products()->detach($productId);
            }else{
                $pivotRow->count--;
                $pivotRow->update();
            }

        }else{
            $order->products()->detach($productId);
        }
        $product = Product::find($productId);
        Order::changeFullSum(-$product->price);
        session()->flash('warning','Удалён товар '. $product->name);
        return redirect()->route('basket');
    }


}
