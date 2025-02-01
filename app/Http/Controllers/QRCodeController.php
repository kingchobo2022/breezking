<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function List() {
        $qrcodes = Product::get();
        return view('admin.qrcode.list', compact('qrcodes'));
    }

    public function AddQrcode() {
        return view('admin.qrcode.add');
    }

    public function StoreQrcode(Request $request) {
        $product = new Product;
        $product->title = trim($request->title);
        $product->price = trim($request->price);
        $product->description = trim($request->description);
        $product->product_code = mt_rand(10000000000, 99999999999);
        $product->save();

        return redirect('admin/qrcode')->with('success', 'QRCode Successfully Create');
    }

}
