<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class FullCalendarController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $calendars = Event::whereDate('start', '>=', $request->start)
                        ->whereDate('end', '<=', $request->end)
                        ->get(['id', 'title', 'start', 'end']);

            return response()->json($calendars);
        }
        
        return view('admin.fullcalendar.index');
    }

    public function action(Request $request) {

        if(!$request->ajax()) {
            return false;
        }

        if ($request->type == 'add') {
            $event = Event::create([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
            ]);

            return response()->json($event);
        }

        if ($request->type == 'update') {
            $event = Event::findOrFail($request->id)->update([
                'title' => $request->title,
                'start' => $request->start,
                'end' => $request->end,
            ]);

            return response()->json($event);
        }

        if ($request->type == 'delete') {
            $event = Event::findOrFail($request->id)->delete();

            return response()->json($event);
        }

    }
}
