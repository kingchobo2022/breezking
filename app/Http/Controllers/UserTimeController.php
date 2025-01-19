<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserTimeController extends Controller
{
    public function WeekList(Request $request)
    {
        return view('admin.week.list');
    }
}
