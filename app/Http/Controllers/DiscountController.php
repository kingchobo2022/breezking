<?php

namespace App\Http\Controllers;

use App\Models\DiscountCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    public function DiscountCode() {
        $discount_codes = DiscountCode::getJoinData();
        return view('admin.discount_code.list', compact('discount_codes'));
    }

    public function DiscountCodeAdd() {
        return view('admin.discount_code.add');
    }

    public function DiscountCodeStore(Request $request) {
        $discount_code = new DiscountCode;
        $discount_code->user_id = Auth::user()->id;
        $discount_code->discount_code = trim($request->discount_code);
        $discount_code->discount_price = trim($request->discount_price);
        $discount_code->expiry_date = trim($request->expiry_date);
        $discount_code->type = $request->type;
        $discount_code->usages = $request->usages;
        $discount_code->save();
        
        return redirect('admin/discount_code')->with('success', 'Recode Successfully Store');
    }

    public function DiscountCodeEdit($id) {
        $discount_code = DiscountCode::findOrFail($id);
        $users = User::select('id', 'name')->get();
        return view('admin.discount_code.edit', compact('discount_code', 'users'));
    }

    public function DiscountCodeUpdate(Request $request) {
        $discount_code = DiscountCode::findOrFail($request->id);
        $discount_code->user_id = $request->user_id;
        $discount_code->discount_code = trim($request->discount_code);
        $discount_code->discount_price = trim($request->discount_price);
        $discount_code->expiry_date = trim($request->expiry_date);
        $discount_code->type = $request->type;
        $discount_code->usages = $request->usages;
        $discount_code->save();
        
        return redirect('admin/discount_code')->with('success', 'Recode Successfully Update');
    }

    public function DiscountCodeDelete(Request $request) {
        $discount_code = DiscountCode::findOrFail($request->id);
        // $discount_code->delete();
        $discount_code->is_delete = 1;
        $discount_code->save();
        
        return redirect('admin/discount_code')->with('success', 'Recode Successfully Delete');
    }

}
