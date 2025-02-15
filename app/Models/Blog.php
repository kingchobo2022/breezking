<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Blog extends Model
{
    protected $table = 'blog';

    protected $fillable = ['title','slug', 'description'];
    //protected $guarded = ['id', 'created_at', 'updateed_at'];

    static public function getAll() {
        
        $return = self::select('blog.*')->orderBy('id', 'desc');

        if (!empty(Request::get('id'))) {
            $return = $return->where('blog.id', '=', Request::get('id'));
        }
        
        if (!empty(Request::get('title'))) {
            $return = $return->where('blog.title', 'like', '%'. Request::get('title') .'%');
        }

        if (!empty(Request::get('slug'))) {
            $return = $return->where('blog.slug', 'like', '%'. Request::get('slug') .'%');
        }

        return $return->paginate(3);
    }
}