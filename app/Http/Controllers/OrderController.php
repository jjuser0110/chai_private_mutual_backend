<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Spatie\Browsershot\Browsershot;
use Illuminate\Http\Request;
use App\Models\Order;
use Bouncer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $order = Order::all();

        return view('order.index')->with('order',$order);
    }

    public function edit(Order $order)
    {
        return view('order.create')->with('order',$order);
    }

    public function update(Request $request, Order $order)
    {
        $order->update($request->all());
        return redirect()->route('order.index')->withSuccess('Data updated');
    }

}
