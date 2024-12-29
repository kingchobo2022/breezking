<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function EmailCompose()
    {
        return view('admin.email.compose');
    }

    public function EmailComposePost(Request $request)
    {
        dd($request->all());
    }
}
