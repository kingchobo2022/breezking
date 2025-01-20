<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class UserTime extends Model
{
    protected $table = 'user_times';

    static public function getDetail($weekid)
    {
        return self::where('week_id', '=', $weekid)
            ->where('user_id', '=', Auth::user()->id )->first();
    }
}
