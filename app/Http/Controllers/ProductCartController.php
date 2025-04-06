<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductCartController extends Controller
{
    public function AdminProductList()
    {
        return view('admin.product_cart.list');
    }
}
