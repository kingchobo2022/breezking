<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Mail\RegisteredMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function AdminChangePassword(Request $request)
    {
        return view('admin.change_password.update');
    }

    public function AdminUpdatePassword(Request $request)
    {
        $user = User::findOrFail(Auth::user()->id);

        if (!Hash::check($request->old_password, $user->password)) {
            return redirect('admin/change_password')->with('error', 'The current password doest not match.');
        }

        if (trim($request->new_password) != trim($request->confirm_password)) {
            return redirect('admin/change_password')->with('error', 'The passwords do not match.');
        }

        $user->password = Hash::make(trim($request->new_password));
        $user->save();

        return redirect('admin/change_password')->with('success', 'The password has been changed.');
    }


    public function AdminUserTypeaheadAutocomplete(Request $request) {
        $data = $request->all();

        $query = $data['query'];
        $filter_data = User::select('name')
                ->where('name', 'LIKE', '%'.$query .'%')->get();
        return response()->json($filter_data);                
    }
    

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
        $data['usersRs'] = User::getRecord($request);
        $data['totalAdmin'] = User::where('role', '=', 'admin')->where('is_delete', '=', 0)->count();
        $data['totalAgent'] = User::where('role', '=', 'agent')->where('is_delete', '=', 0)->count();
        $data['totalUser'] = User::where('role', '=', 'user')->where('is_delete', '=', 0)->count();
        $data['totalActive'] = User::where('status', '=', 'active')->where('is_delete', '=', 0)->count();
        $data['totalInActive'] = User::where('status', '=', 'inactive')->where('is_delete', '=', 0)->count();
        $data['total'] = User::where('is_delete', '=', 0)->count();
        return view('admin.users.list', $data);
    }

    public function AdminUsersView($id)
    {
        $userRow = User::find($id);
        return view('admin.users.view', compact('userRow'));
    }

    public function AdminAddUser(Request $request)
    {
        return view('admin.users.add');
    }

    public function AdminAddUserStore(Request $request)
    {
        // 검증
        $user = request()->validate([
            'name' => 'required',
            'email'=> 'required|unique:users',
            'role' => 'required',
            'status'=> 'required'
        ]);

        // 저장
        $user = new User;
        $user->name = trim($request->name);
        $user->username = trim($request->username);
        $user->email = trim($request->email);
        $user->phone = trim($request->phone);
        $user->role = $request->role;
        $user->status = $request->status;
        $user->remember_token = Str::random(50);

        if (!empty($request->file('photo'))) {
            $file = $request->file('photo');
            $randomStr = Str::random(30);
            $filename = $randomStr .'.'. $file->getClientOriginalExtension();
            $file->move('upload/', $filename);
            $user->photo = $filename;
        }

        $user->save();

        // 인증 메일 발송
        Mail::to($user->email)->send(new RegisteredMail($user));


        // 페이지 전환,  플래시 메시지 생성
        return redirect('admin/users')->with('success', '유저가 정상적으로 등록되었습니다');
    }

    public function SetNewPassword($token)
    {
        return view('auth.my_reset_password', compact('token'));
    }

    public function SetNewPasswordPost($token, ResetPasswordRequest $request)
    {
        $users = User::where('remember_token', '=', $token);
        if ($users->count() == 0) {
            abort(403);
        }

        $user = $users->first();
        $user->password = Hash::make($request->password);
        $user->remember_token = Str::random(50);
        $user->status = 'active';
        $user->save();

        return redirect('admin/login')->with('success', 'New Passowrd has been set.');
    }

    public function AdminEditUser($id)
    {
        $row = User::find($id);
        return view('admin.users.edit', compact('row'));
    }

    public function AdminUpdateUser($id, Request $request)
    {
        $user = User::find($id);
        $user->name = trim($request->name);
        $user->username = trim($request->username);
        $user->phone = trim($request->phone);
        $user->role = $request->role;
        $user->status = $request->status;

        if (!empty($request->file('photo'))) {

            if (!empty($user->photo) && file_exists('upload/'. $user->photo)) {
                unlink('upload/'. $user->photo);
            }

            $file = $request->file('photo');
            $randomStr = Str::random(30);
            $filename = $randomStr .'.'. $file->getClientOriginalExtension();
            $file->move('upload/', $filename);
            $user->photo = $filename;
        }

        $user->save();

        return redirect('admin/users')->with('success', '유저 정보가 정상적으로 수정되었습니다.');
    }

    public function AdminDeleteSoft($id)
    {
        // Soft Delete
        $softDelete = User::find($id);
        $softDelete->is_delete = 1;
        $softDelete->save();

        return redirect('admin/users')->with('success', '유저 정보가 임시 삭제되었습니다.');
    }

    public function AdminUpdateNameUser(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->name = $request->input('name');
        $user->save();
        $json = ['success' => 'Data Update Successfully!'];
        echo json_encode($json);  
    }

    public function AdminChangeStatus(Request $request)
    {
        $user = User::find($request->input('id'));
        $user->status = $request->input('status');
        $user->save(); 
        $arr = ['success' => 'Data Update Successfully!'];
        echo json_encode($arr);  // {"success" => "Data Update Successfully!"}
    }

    public function AdminMyProfile(Request $request)
    {
        $row = User::find(Auth::user()->id);
        return view('admin.profile', compact('row'));
    }

    public function AdminMyProfileUpdate(Request $request)
    {
        $user = request()->validate([
            'email' => 'required|unique:users,email,'.Auth::user()->id
        ]);
        $user = User::find(Auth::user()->id);
        $user->name = trim($request->name);
        $user->email= trim($request->email);
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        if ( $request->hasFile('photo') && $request->file('photo')->isValid() ) {
            $file = $request->file('photo');
            $randomStr = Str::random(30);
            $filename = $randomStr .'.'. $file->getClientOriginalExtension();
            $file->move('upload/', $filename);  
            $user->photo = $filename; 
        }

        $user->save();
        return redirect('admin/my_profile')->with('success', '나의 계정정보가 변경되었습니다.');
    }

    public function CheckEmail(Request $request) {
        $email = $request->input('email');

        $isExists = User::where('email', '=', $email)->first();
        if ($isExists) {
            return response()->json(['exists' => true]);
        } else {
            return response()->json(['exists' => false]);
        }
    }
}
