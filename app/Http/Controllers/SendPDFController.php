<?php

namespace App\Http\Controllers;

use App\Mail\SendPDFMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SendPDFController extends Controller
{
    public function sendPdf() {
        return view('admin.send_pdf.list');
    }

    public function sendPdfPost(Request $request) {
        $request->validate([
            'doc_file' => 'required|file|mimes:pdf|max:2048',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        try {
            $file = $request->file('doc_file');
            $filePath = $file->store('documents');
            $fileUrl = asset('storage/app/'. $filePath);

            Mail::to($request->email)->send(new SendPDFMail($request, $filePath, $fileUrl));

        } catch (Exception $e) {

        }

        return redirect()->back()->with('success', 'PDF Succeefully Send');
    }
}
