<?php

namespace App\Http\Controllers;

use App\Models\ProductCart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductCartController extends Controller
{
    public function AdminProductList(Request $request)
    {
        $product_carts = ProductCart::orderBy('id', 'asc');

        if(!empty($request->id)) {
            $product_carts = $product_carts->where('id', '=', $request->id);
        }

        if(!empty($request->name)) {
            $product_carts = $product_carts->where('name', 'like', '%'. $request->name .'%');
        }

        if(!empty($request->price)) {
            $product_carts = $product_carts->where('price', 'like', '%'. $request->price .'%');
        }

        if(!empty($request->created_at)) {
            $product_carts = $product_carts->where('created_at', 'like', $request->created_at .'%');
        }
        if(!empty($request->updated_at)) {
            $product_carts = $product_carts->where('updated_at', 'like', $request->updated_at .'%');
        }
        

        $product_carts = $product_carts->paginate(2);

        return view('admin.product_cart.list', compact('product_carts'));
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

    public function AdminProductCartEdit($id)
    {
        $product_cart = ProductCart::findOrFail($id);
        return view('admin.product_cart.edit', compact('product_cart'));
    }

    public function AdminProductCartUpdate(Request $request, $id)
    {
        $product_cart = ProductCart::findOrFail($request->id);
        $product_cart->name = trim($request->name);
        $product_cart->description = $request->description;
        $product_cart->price = $request->price;

        if (!empty($request->file('image'))) {
            $file = $request->file('image');
            $filenameBody = Str::random(30);
            $filename = $filenameBody .'.'. $file->getClientOriginalExtension();
            $file->move('product/', $filename);
            $product_cart->image = $filename;
        }

        $product_cart->save();
        return redirect('admin/product_cart')->with('success', 'Product Cart Successfully Update');
    } 
    
    public function AdminProductCartDelete(Request $request)
    {
        $product_cart = ProductCart::findOrFail($request->id);
        $product_cart->delete();

        return redirect('admin/product_cart')->with('success', 'Product Cart Successfully Delete');
    }

    public function Index()
    {
        $product_carts = ProductCart::orderBy('id', 'desc')->get();

        return view('product_cart.products', compact('product_carts'));
    }

    public function Cart()
    {
        return view('product_cart.cart');
    }

    public function AddCart($id)
    {
        try {
            $product_cart = ProductCart::findOrFail($id);
            $cart = session()->get('cart', []); // 세션 변수 cart의 값을 가져오는데 없으면 빈 배열을 기본값으로 리턴함.
    
            if(isset($cart[$id])) {
                $cart[$id]['quantity'] += 1;   
            } else {
                $cart[$id] = [
                    'name' => $product_cart->name,
                    'price' => $product_cart->price,
                    'quantity' => 1,
                    'image' => $product_cart->image
                ];
            }
    
            session()->put('cart', $cart);
    
            return redirect()->back()->with('success', 'Product Added to cart successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Product not found');
        }    
    }
}
