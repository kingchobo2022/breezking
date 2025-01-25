<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function NotificationIndex() {
        $users = User::whereIn('role', ['user', 'agent'])->get();
        return view('admin.notification.update', compact('users'));
    }
}
