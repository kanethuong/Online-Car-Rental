<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function orderDetail($orderId)
    {
        $order = Order::find($orderId);
        if ($order == null) {
            abort(404);
        }
        $orderItems = OrderItem::where('order_id', $orderId)->get();
        return view('home.order_detail')
            ->with('order', $order)
            ->with('orderItems', $orderItems);
    }
}
