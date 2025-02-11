<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blog';

    protected $fillable = ['title','slug', 'description'];
    //protected $guarded = ['id', 'created_at', 'updateed_at'];

    static public function getAll() {
        //return self::select('blog.*')->get();
        return self::select('blog.*')->orderBy('id', 'desc')->paginate(3);
    }
}
