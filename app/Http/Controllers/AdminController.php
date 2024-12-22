<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function AdminDashboard(Request $request) 
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout(); // 사용자를 로그아웃시킴
        $request->session()->invalidate(); // 현재 세션 무효화
        $request->session()->regenerateToken(); // CSRF 토큰 새로 생성

        return redirect('/admin/login'); // 해당 경로로 보냄
    }

    public function AdminLogin(Request $request)
    {
        return view('admin.admin_login');
    }

    public function AdminProfile(Request $request)
    {
        return view('admin.admin_profile');
    }

    public function AdminProfileUpdate(Request $request)
    {
        dd($request->all());
    }
}



