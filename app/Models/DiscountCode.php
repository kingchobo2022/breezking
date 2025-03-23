<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCode extends Model
{
    protected $table = 'discount_code';

    static public function getJoinData() {
        $return = self::select('discount_code.*', 'users.name as user_name')
            ->join('users', 'discount_code.user_id', '=', 'users.id')
            ->orderBy('discount_code.id', 'desc');

        return $return->paginate(3);
    }
}
