<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    static public function getData() {

        return self::select('orders.*', 'product.title')
            ->join('product', 'product.id', '=', 'orders.product_id')
            ->get();
    }

    public function getColor() {
        return $this->hasMany(OrdersDetails::class, 'orders_id')
            ->select('orders_details.*', 'color.name')
            ->join('color', 'color.id', '=', 'orders_details.color_id');
        ;
    }
}
