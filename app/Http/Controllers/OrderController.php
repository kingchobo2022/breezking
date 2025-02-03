<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function OrderList() {
        return view('admin.order.list');
    }

    public function OrderAdd() {
        $products = Product::get();
        $colors = Color::get();
        return view('admin.order.add', compact('products', 'colors'));
    }
}
