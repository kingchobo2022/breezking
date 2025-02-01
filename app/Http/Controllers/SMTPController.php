<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SMTPController extends Controller
{
    public function SMTPList() {
        return view('admin.smtp.update');
    }
}
