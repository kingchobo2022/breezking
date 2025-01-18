<?php

namespace App\Http\Controllers;

use App\Models\ComposeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AgentController extends Controller
{
    public function AgentDashboard(Request $request)
    {
        return view('agent.index');
    }

    public function AgentEmailInbox(Request $request)
    {
        $inboxs = ComposeEmail::getAgentRecord(Auth::user()->id);
        return view('agent.email.inbox', compact('inboxs'));
    }
}
