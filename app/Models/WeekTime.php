<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class WeekTime extends Model
{
    protected $table = 'week_times';

    // Method Overriding
    static public function get() {
        $return = self::select('*');

        if(!empty(Request::get('id'))){
            $return = $return->where('id', '=', Request::get('id'));
        }
        if(!empty(Request::get('name'))){
            $return = $return->where('name', 'like', '%'. Request::get('name'). '%');
        }

        $return = $return->get();

        return $return;
    }
}
