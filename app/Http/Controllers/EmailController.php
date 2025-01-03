<?php

namespace App\Http\Controllers;

use App\Models\ComposeEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComposeEmailMail;

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

        // 메일 발송 (시작)
        $getUserEmail = User::where('id', '=', $request->user_id)->first();
        Mail::to($getUserEmail->email)
            ->cc($request->cc_email)
            ->send(new ComposeEmailMail($compose));
        // 메일 발송 (끝)


        return redirect('admin/email/compose')->with('success', '이메일을 발송했습니다.');
    }

    public function EmailSent(Request $request)
    {
        $rs = ComposeEmail::get();
        return view('admin.email.sent', compact('rs'));
    }

    public function AdminEmailSentDelete(Request $request) 
    {
        if (!empty($request->id)) {
          $option = explode(',', $request->id);
          foreach($option as $id)      
          {
            if (!empty($id)) {
                $getRecord = ComposeEmail::find($id);
                $getRecord->delete();
            }
          }
        }
        return redirect()->back()->with('success', '발송 메일이 정상적으로 삭제되었습니다.');
    }

    public function AdminEmailRead($id, Request $request)
    {
        $row = ComposeEmail::find($id);
        return view('admin.email.read', compact('row')); 
    }

    public function AdminEmailReadDelete($id, Request $request)
    {
        $row = ComposeEmail::find($id);
        $row->delete();
        return redirect('admin/email/sent')->with('success', '발송 메일이 정상적으로 삭제되었습니다.');
    }
}
