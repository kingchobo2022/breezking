<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserTimeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function(){
    Route::get('dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('profile/update',[AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    Route::get('users', [AdminController::class, 'AdminUsers'])->name('admin.users');
    Route::get('users/view/{id}', [AdminController::class, 'AdminUsersView'])->name('admin.users.view');
    Route::get('users/add', [AdminController::class, 'AdminAddUser'])->name('admin.users.adduser');
    Route::get('users/edit/{id}', [AdminController::class, 'AdminEditUser'])->name('admin.users.edit');
    Route::post('users/edit/{id}', [AdminController::class, 'AdminUpdateUser'])->name('admin.users.update');
    Route::get('users/delete/{id}', [AdminController::class, 'AdminDeleteSoft'])->name('admin.users.delete.soft');
    Route::post('users/update_name', [AdminController::class, 'AdminUpdateNameUser']);
    Route::get('users/change_status', [AdminController::class, 'AdminChangeStatus']);

    Route::post('users/add', [AdminController::class, 'AdminAddUserStore'])->name('admin.users.adduser.store');

    Route::get('email/compose', [EmailController::class, 'EmailCompose'])->name('admin.email.compose');
    Route::post('email/compose_post', [EmailController::class, 'EmailComposePost'])->name('admin.email.compose.post');
    Route::get('email/sent', [EmailController::class, 'EmailSent'])->name('admin.email.sent');
    Route::get('email/delete', [EmailController::class, 'AdminEmailSentDelete'])->name('admin.email.sent.delete');
    Route::get('email/read/{id}', [EmailController::class, 'AdminEmailRead'])->name('admin.email.read');
    Route::get('email/read_delete/{id}', [EmailController::class, 'AdminEmailReadDelete'])->name('admin.email.read.delete');
    Route::get('my_profile', [AdminController::class, 'AdminMyProfile']);
    Route::post('my_profile/update', [AdminController::class, 'AdminMyProfileUpdate']);

    Route::get('week', [UserTimeController::class, 'WeekList']);
    Route::get('week/add', [UserTimeController::class, 'WeekAdd']);
    Route::post('week/add', [UserTimeController::class, 'WeekStore']);
    Route::get('week/edit/{id}', [UserTimeController::class, 'WeekEdit']);
    Route::post('week/edit/{id}', [UserTimeController::class, 'WeekUpdate']);
    Route::get('week/delete/{id}', [UserTimeController::class, 'WeekDelete']);

    Route::get('week_time', [UserTimeController::class, 'WeekTimeList']);
    Route::get('week_time/add', [UserTimeController::class, 'WeekTimeAdd']);    
    Route::post('week_time/add', [UserTimeController::class, 'WeekTimeStore']);    
    Route::get('week_time/edit/{id}', [UserTimeController::class, 'WeekTimeEdit']);
    Route::post('week_time/edit/{id}', [UserTimeController::class, 'WeekTimeUpdate']);
    Route::get('week_time/delete/{id}', [UserTimeController::class, 'WeekTimeDelete']);

    Route::get('schedule',[UserTimeController::class, 'AdminSchedule']);
    Route::post('schedule',[UserTimeController::class, 'AdminScheduleUPdate']);
});

Route::middleware(['auth', 'role:agent'])->group(function(){
    Route::get('agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
    Route::get('agent/logout', [AdminController::class, 'AdminLogout'])->name('agent.logout');
    Route::get('agent/email/inbox', [AgentController::class, 'AgentEmailInbox']);
});

Route::get('set_new_password/{token}', [AdminController::class, 'SetNewPassword']);
Route::post('set_new_password/{token}', [AdminController::class, 'SetNewPasswordPost']);
Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

