<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified product.
     */
    public function show($id)
    {
        $Order = orderItem::all();// Lấy sản phẩm theo ID, trả về 404 nếu không tìm thấy

        return view('crud_user.productshow', compact('product')); // Truyền dữ liệu sản phẩm đến view
    }
}
