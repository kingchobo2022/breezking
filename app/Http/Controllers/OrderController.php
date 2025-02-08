<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Orders;
use App\Models\OrdersDetails;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function OrderList(Request $request) {
        $orders = Orders::getData($request);

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

    public function OrderEdit($id) {
        $order = Orders::find($id);
        $orderDetails = OrdersDetails::where('orders_id', '=', $id)->get();
        $products = Product::get();
        $colors = Color::get();
        return view('admin.order.edit', compact('products', 'colors', 'order', 'orderDetails'));
    }

    public function OrderUpdate($id, Request $request) {
        $order = Orders::find($id);
        $order->product_id = $request->product_id;
        $order->qtys = $request->qtys;
        $order->save();

        OrdersDetails::where('orders_id', '=', $order->id)->delete();

        if (!empty($request->color_id)) {
            foreach( $request->color_id  as $color_id ) {
                $orderDetail = new OrdersDetails;
                $orderDetail->orders_id =  $order->id;
                $orderDetail->color_id = $color_id;
                $orderDetail->save();
            }
        }

        return redirect('admin/order')->with('success', 'Order Successfully Update');
    }

    public function OrderDelete($id) {

        $orders = Orders::find($id);
        if(!$orders) {
            return redirect('admin/order')->with('success', '주문정보가 존재하지 않거나 이미 삭제되었습니다.');
        }
        $orders->delete();

        $orderDetails = OrdersDetails::where('orders_id', '=', $id);
        if($orderDetails) {
            $orderDetails->delete();
        }

        return redirect()->back()->with('success', '주문정보가 성공적으로 삭제되었습니다.');
    }
}
