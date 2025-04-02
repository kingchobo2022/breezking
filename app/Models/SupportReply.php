<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportReply extends Model
{
    protected $table = 'support_reply';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
