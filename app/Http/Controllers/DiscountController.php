<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function DiscountCode() {
        return view('admin.discount_code.list');
    }

    public function DiscountCodeAdd() {
        return view('admin.discount_code.add');
    }

}
