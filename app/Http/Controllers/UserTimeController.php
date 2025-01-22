<?php

namespace App\Http\Controllers;

use App\Models\UserTime;
use App\Models\Week;
use App\Models\WeekTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function WeekTimeList()
    {
        $weektimes = WeekTime::get();

        return view('admin.week_time.list', compact('weektimes'));
    }

    public function WeekTimeAdd()
    {
        return view('admin.week_time.add');
    }

    public function WeekTimeStore(Request $request)
    {
        $weektime = new WeekTime;
        $weektime->name = trim($request->name);
        $weektime->save();

        return redirect('admin/week_time')->with('success', 'Week Time Add Successfully.');
    }

    public function WeekTimeEdit($id)
    {
        $weektime = WeekTime::find($id);
        return view('admin.week_time.edit', compact('weektime'));
    }

    public function WeekTimeUpdate($id, Request $request)
    {
        $weektime = WeekTime::find($id);
        $weektime->name = trim($request->name);
        $weektime->save();

        return redirect('admin/week_time')->with('success', 'Week Time Update Successfully.');
    }

    public function WeekTimeDelete($id)
    {
        $weektime = WeekTime::find($id);
        $weektime->delete();

        return redirect('admin/week_time')->with('success', 'Week Time Delete Successfully.');        
    }

    public function AdminSchedule()
    {
        $weeks = Week::get();
        $weektimes = WeekTime::get();
        $usertimes = UserTime::get();

        return view('admin.schedule.list', compact('weeks', 'weektimes', 'usertimes'));
    }

    public function AdminScheduleUPdate(Request $request)
    {
        //dd($request->all());
        UserTime::where('user_id', '=', Auth::user()->id)->delete();

        if (!empty($request->week)) {
            foreach ($request->week as $value) {
                if (!empty($value['status'])) {
                    $record = new UserTime;
                    $record->week_id = $value['week_id'];
                    $record->user_id = Auth::user()->id;
                    $record->status = 1;
                    $record->start_time = $value['start_time'];
                    $record->end_time = $value['end_time'];
                    $record->save();
                }
            }
        }

        return redirect('admin/schedule')->with('success', 'Schedule Update Successfully.');
    }
}
