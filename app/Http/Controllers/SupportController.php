<?php

namespace App\Http\Controllers;

use App\Models\Support;
use App\Models\User;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function Support()
    {
        $supports = Support::getSupportList();

        $users = User::all();

        return view('admin.support.list', compact('supports', 'users'));
        
    }

    public function Reply($id)
    {
        $support = Support::where('id', '=', $id)->first();
        
        return view('admin.support.reply', compact('support'));
    }
}
