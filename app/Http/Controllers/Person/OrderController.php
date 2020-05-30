<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Auth;

class OrderController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Auth::user()->orders()->active()->paginate(10);
        return view('auth.orders.main', compact('orders'));
    }
    public function show(Order $order)
    {
        if(!Auth::user()->orders->contains($order)){
            return back();
        }
        return view('auth.orders.show', compact('order'));
    }
}
