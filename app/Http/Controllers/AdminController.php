<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function AdminDashboard(Request $request) 
    {
        $user = User::selectRaw("count(id) as count, DATE_FORMAT(created_at, '%Y-%m') as month ")
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get(); // Eloquent 컬렉션 형태로 가져옴
        ;

        $months = $user->pluck('month'); // [ '2024-11', '2024-12' ]
        $counts = $user->pluck('count'); // [ 3, 2, 2, 1 ]
        

        return view('admin.index', compact('months', 'counts')); // 
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
        $adminRow = User::find(Auth::user()->id); 

        return view('admin.admin_profile', compact('adminRow'));
    }

    public function AdminProfileUpdate(Request $request)
    {
        $user = request()->validate([
            'email' => 'required|unique:users,email,'. Auth::user()->id
        ]);


        $user = User::find(Auth::user()->id); 
        $user->name = trim($request->name);
        $user->username = trim($request->username);
        $user->email = trim($request->email);
        $user->phone = trim($request->phone);
        
        if(!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }
        if(!empty($request->file('photo'))) {
            $file = $request->file('photo');
            $randomStr = Str::random(30);
            $filename = $randomStr .'.'. $file->getClientOriginalExtension(); 
            $file->move('upload/', $filename);
            $user->photo = $filename;
        }

        $user->address = trim($request->address);
        $user->about = trim($request->about);
        $user->website = trim($request->website);
        $user->save();

        return redirect('admin/profile')->with('success', '프로필을 성공적으로 업데이트 했습니다.');
    }

    public function AdminUsers(Request $request)
    {
        $usersRs = User::getRecord($request);
        return view('admin.users.list', compact('usersRs'));
    }

    public function AdminUsersView($id)
    {
        $userRow = User::find($id);
        return view('admin.users.view', compact('userRow'));
    }
}



