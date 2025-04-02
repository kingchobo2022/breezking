<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Support extends Model
{
    protected $table = 'support';

    static public function getSupportList() {
        // $return = self::select('support.*')
        //     ->orderBy('id', 'desc')
        //     ->paginate(20);
        // $return = self::select('support.*')
        //     ->with('user') // Eager Loading 추가
        //     ->orderBy('id', 'desc')
        //     ->paginate(20);

        $return = self::select('support.*')
            ->with('user') // Eager Loading 추가
            ->orderBy('id', 'desc');
        if(!empty(Request::get('id'))) {
            $return = $return->where('id', '=', Request::get('id'));
        }
        if(!empty(Request::get('user_id'))) {
            $return = $return->where('user_id', '=', Request::get('user_id'));
        }
        if(!empty(Request::get('title'))) {
            $return = $return->where('title', 'like', '%'. Request::get('title'). '%');
        }
        if(Request::get('status') == '1' || Request::get('status') == '0') {
            $return = $return->where('status', '=', Request::get('status'));
        }

        $return = $return->paginate(20);

        return $return;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getSupportReply()
    {
        return $this->hasMany(SupportReply::class, 'support_id');
    }
    
}
 