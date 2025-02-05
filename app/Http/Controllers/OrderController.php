<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Orders;
use App\Models\OrdersDetails;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function OrderList() {
        $orders = Orders::getData();

        return view('admin.order.list', compact('orders'));
    }

    public function OrderAdd() {
        $products = Product::get();
        $colors = Color::get();
        return view('admin.order.add', compact('products', 'colors'));
    }

    public function OrderStore(Request $request) {
        $orders = new Orders;
        $orders->product_id = $request->product_id;
        $orders->qtys = $request->qtys;
        $orders->save();

        if ( !empty($request->color_id) ) {
            foreach ($request->color_id as $color_id ) {
                $order_detail = new OrdersDetails;
                $order_detail->orders_id = $orders->id;
                $order_detail->color_id = $color_id;
                $order_detail->save();
            }
        }
        return redirect('admin/order')->with('success', 'Order Successfully Create');
    }
}
