<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function readOrder($order_id){
        $orders = Order::findOrFail($order_id); // Lấy vai trò hoặc báo lỗi nếu không tìm thấy
        $product =OrderItem::whereHas('order', function ($query) use ($order_id) {
            $query->where('order_id', $order_id);
        })->with('orders')->get(); // Lấy người dùng có vai trò này

        return view('crud_user.productshow', compact('orders', 'product'));
}

}
