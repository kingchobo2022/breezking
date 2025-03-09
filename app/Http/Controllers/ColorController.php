<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\PDF;

class ColorController extends Controller
{
    public function ColorList() {
        $colors = Color::getAllData();
        return view('admin.color.list', compact('colors'));
    }

    public function ColorAdd() {
        return view('admin.color.add');
    }

    public function ColorStore(Request $request) {
        $color = new Color;
        $color->name = trim($request->name);
        $color->save();

        return redirect('admin/color')->with('success', 'Color Successfully Add');
    }

    public function ColorEdit($id) {
        $color = Color::find($id);

        return view('admin.color.edit', compact('color'));
    }

    public function ColorUpdate($id, Request $request) {
        $color = Color::find($id);
        $color->name = trim($request->name);
        $color->save();

        return redirect('admin/color')->with('success', 'Color Successfully Update');
    }

    public function ColorDelete($id) {
        $color = Color::find($id);
        $color->delete();
        
        return redirect('admin/color')->with('success', 'Color Successfully Delete');
    }

    public function ColorChangeStatus(Request $request) {
        $color = Color::find($request->id);
        if($color) {
            $color->status = $request->status;
            $color->save();
            return response()->json(['message' => 'Status Succssfull Change']);
        }
        return response()->json(['message' => 'Data Not Found']);
    }

    public function PdfDemo() {
        $title = 'Welcome New PDF';
        $date = date('Y-m-d');

        $pdf = PDF::loadView('pdf.myPDFDemo', compact('title', 'date'));

        return $pdf->download('Kingchobo.pdf');
    }

    public function  PdfColor() {
        $colors = Color::get();
        $title = 'All Color List';
        $date = date('Y년 m월 d일');

        $pdf = PDF::loadView('pdf.PDFColor', compact('colors', 'title', 'date'));
        return $pdf->download('color.pdf');
    }
}



