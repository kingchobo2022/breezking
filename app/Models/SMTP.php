<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SMTP extends Model
{
    protected $table = 'smtp';

    static public function getStringFirst() {
        return self::find(1);
    }
}
