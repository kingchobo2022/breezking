<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SendPDFController extends Controller
{
    public function sendPdf() {
        return view('admin.send_pdf.list');
    }

    public function sendPdfPost(Request $request) {
        dd($request->all());
    }
}
