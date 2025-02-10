<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';

    protected $fillable = ['title','slug', 'description'];
    //protected $guarded = ['id', 'created_at', 'updateed_at'];
}
