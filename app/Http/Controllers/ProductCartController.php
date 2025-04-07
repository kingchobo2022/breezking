<?php

namespace App\Http\Controllers;

use App\Models\ProductCart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCartController extends Controller
{
    public function AdminProductList()
    {
        return view('admin.product_cart.list');
    }

    public function AdminProductCartAdd()
    {
        return view('admin.product_cart.add');
    }

    public function AdminProductCartStore(Request $request)
    {
        $product_cart = new ProductCart();
        $product_cart->name = trim($request->name);
        $product_cart->description = trim($request->description);
        $product_cart->price = trim($request->price);

        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            $filenameBody = Str::random(30);
            $filename = $filenameBody .'.'. $file->getClientOriginalExtension();
            $file->move('product/', $filename);
            $product_cart->image = $filename;
        }

        $product_cart->save();

        return redirect('admin/product_cart')->with('success', 'Product Cart Successfully Add');
    }
}
