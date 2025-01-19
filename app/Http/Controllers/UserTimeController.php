<?php

namespace App\Http\Controllers;

use App\Models\Week;
use Illuminate\Http\Request;

class UserTimeController extends Controller
{
    public function WeekList(Request $request)
    {
        $weeks = Week::get();

        return view('admin.week.list', compact('weeks'));
    }

    public function WeekAdd(Request $request)
    {
        return view('admin.week.add');
    }

    public function WeekStore(Request $request)
    {
        $week = new Week;
        $week->name = trim($request->name);
        $week->save();

        return redirect('admin/week')->with('success', 'Week Add Successfully.');
    }

    public function WeekEdit($id) 
    {
        $week = Week::find($id);
        return view('admin.week.edit', compact('week'));
    }

    public function WeekUpdate(Request $request, $id)
    {
        $week = Week::find($id);
        $week->name = trim($request->name);
        $week->save();

        return redirect('admin/week')->with('success', 'Week Update Successfully.');
    }

    public function WeekDelete(Request $request, $id)
    {
        $week = Week::find($id);
        $week->delete();

        return redirect('admin/week')->with('success', 'Week Delete Successfully.');
    }
}
