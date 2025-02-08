<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Orders extends Model
{
    protected $table = 'orders';

    static public function getData($request) {

        $orders = self::select('orders.*', 'product.title')
            ->join('product', 'product.id', '=', 'orders.product_id');
        if (!empty($request->id)) {
            // 일반 방식
            //$orders = $orders->where('orders.id', '=', $request->id);
            // Helper 사용
            //$orders = $orders->where('orders.id', '=', request()->get('id'));
            // Facade 사용
            $orders = $orders->where('orders.id', '=', Request::get('id'));
        }
        if (!empty($request->title)) {
            $orders = $orders->where('product.title', 'like', '%'. $request->title .'%');
        }
        if (!empty($request->created_at)) {
            $orders = $orders->where('orders.created_at', 'like', $request->created_at .'%');
        }
        if (!empty($request->updated_at)) {
            $orders = $orders->where('orders.updated_at', 'like', $request->updated_at .'%');
        }

        $orders = $orders->get();
        return $orders;
    }

    public function getColor() {
        return $this->hasMany(OrdersDetails::class, 'orders_id')
            ->select('orders_details.*', 'color.name')
            ->join('color', 'color.id', '=', 'orders_details.color_id');
        ;
    }
}
