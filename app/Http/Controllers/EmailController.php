<?php

namespace App\Http\Controllers;

use App\Models\ComposeEmail;
use App\Models\User;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function EmailCompose()
    {
        $rsEmail = User::whereIn('role', ['agent', 'user'])->get();  
        return view('admin.email.compose', compact('rsEmail')); 
    }

    public function EmailComposePost(Request $request)
    {
        // dd($request->all());
        $compose = new ComposeEmail;
        $compose->user_id = $request->user_id;
        $compose->cc_email = trim($request->cc_email);
        $compose->subject = trim($request->subject);
        $compose->descriptions = trim($request->descriptions);
        $compose->save();

        return redirect('admin/email/compose')->with('success', '이메일을 발송했습니다.');
    }
}
