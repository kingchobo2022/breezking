<?php

namespace App\Http\Controllers;

use App\Models\Support;
use App\Models\SupportReply;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SupportController extends Controller
{
    public function Support()
    {
        $supports = Support::getSupportList();

        $users = User::all();

        return view('admin.support.list', compact('supports', 'users'));
        
    }

    public function Reply($id)
    {
        $support = Support::where('id', '=', $id)->first();
        
        return view('admin.support.reply', compact('support'));
    }

    public function ReplyStore($id, Request $request)
    {
        $supportReply = new SupportReply();
        $supportReply->user_id = Auth::user()->id;
        $supportReply->support_id = $id;
        $supportReply->description = $request->description;
        $supportReply->save();

        return redirect('admin/support/reply/'. $id)->with('success', 'Reply Successfully Store');
    }

    public function ChangeStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:support,id',
            'status' => 'required|in:0,1',
        ]);
        try {
            $support = Support::findOrFail($request->id);
            $support->status = $request->status;
            $support->save();

            return response()->json(['result' => 'success'], 200);
            
        } catch(Exception $e) {
            return response()->json([
                'result' => 'error',
                'message' => 'Failed to change support status.'
            ], 500);
        }
    }

    public function SupportOnOff($id)
    {
        $support = DB::table('support')->select('status')->where('id', '=', $id)->first(); // select status from support where id=?
        $status = 1 - $support->status;

        $values = ['status' => $status];
        DB::table('support')->where('id', '=', $id)->update($values); // update support set status=? where id=?

        return redirect('admin/support')->with('success', 'Status Successfully Change');
    }

    public function SupportDeleteItemMulti(Request $request)
    {
        if (empty($request->id)) {
            return redirect('admin/support')->with('error', 'Data Not Found');
        }

        $ids = explode(',', $request->id); 
        foreach ($ids as $id) {
            if (empty($id)) {
                continue;
            }
            $support = Support::findOrFail($id);
            $support->delete();
        }

        return redirect('admin/support')->with('success', 'Support Successfully Delete');
    }
}
