<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    protected $table = 'support';

    static public function getSupportList() {
        // $return = self::select('support.*')
        //     ->orderBy('id', 'desc')
        //     ->paginate(20);
        $return = self::select('support.*')
            ->with('user') // Eager Loading 추가
            ->orderBy('id', 'desc')
            ->paginate(20);

        return $return;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
 