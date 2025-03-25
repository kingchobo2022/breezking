<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class DiscountCode extends Model
{
    protected $table = 'discount_code';

    static public function getJoinData() {
        $return = self::select('discount_code.*', 'users.name as user_name')
            ->join('users', 'discount_code.user_id', '=', 'users.id')
            ->orderBy('discount_code.id', 'desc');

        if (!empty(Request::get('id'))) {
            $return = $return->where('discount_code.id', '=', Request::get('id'));
        }
        if (!empty(Request::get('user_name'))) {
            $return = $return->where('users.name', 'like', '%'. Request::get('user_name'). '%');
        }   
        if (!empty(Request::get('discount_code'))) {
            $return = $return->where('discount_code.discount_code', 'like', '%'. Request::get('discount_code'). '%');
        }   
        if (!empty(Request::get('discount_price'))) {
            $return = $return->where('discount_code.discount_price', 'like', '%'. Request::get('discount_price'). '%');
        }
        
        $return = $return->where('discount_code.is_delete', '=', '0');

        //dd($return->toSql(), $return->getBindings());

        return $return->paginate(3);
    }
}
