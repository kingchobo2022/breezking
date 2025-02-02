<?php

namespace App\Http\Controllers;

use App\Models\SMTP;
use Illuminate\Http\Request;

class SMTPController extends Controller
{
    public function SMTPList() {

        $smtp = SMTP::getStringFirst();

        return view('admin.smtp.update', compact('smtp'));
    }

    public function SMTPUdate(Request $request) {
        $smtp = SMTP::getStringFirst();
        $smtp->app_name = trim($request->app_name);
        $smtp->mail_mailer = trim($request->mail_mailer);
        $smtp->mail_host = trim($request->mail_host);
        $smtp->mail_port = trim($request->mail_port);
        $smtp->mail_username = trim($request->mail_username);
        $smtp->mail_password = trim($request->mail_password);
        $smtp->mail_encryption = trim($request->mail_encryption);
        $smtp->mail_from_address = trim($request->mail_from_address);
        $smtp->save();

        return redirect('admin/smtp')->with('success', 'SMTP Successfully update');
    }
}
