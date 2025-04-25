<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function readOrder($order_id)
    {
        $orders = Order::findOrFail($order_id); // Lấy đơn hàng hoặc báo lỗi nếu không tìm thấy
        $products=Product::whereHas('orders', function ($query) use ($order_id) {
            $query->where('orders.id', $order_id);
        })->with('orders')->get(); // Lấy sản phẩm có đơn hàng này
        // $users = User::where('id', $order->user_id)->first(); // Lấy người dùng có đơn hàng này

        return view('crud_user.order', compact('orders', 'products'));
    }
}
