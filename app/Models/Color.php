<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Color extends Model
{
    protected $table = 'color';

    static function getAllData() {
        $return = self::select('*')
            ->orderBy('id', 'desc');
        if(!empty(Request::get('id'))) {
            $return = $return->where('id', '=', Request::get('id'));
        }
        if(!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%'. Request::get('name'). '%');
        }
        if(!empty(Request::get('created_at'))) {
            $return = $return->where('created_at', 'like', Request::get('created_at'). '%');
        }

        return $return->get();
    }
}
