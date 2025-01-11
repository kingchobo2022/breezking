<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ProfileController;
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

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('admin/profile/update',[AdminController::class, 'AdminProfileUpdate'])->name('admin.profile.update');
    Route::get('admin/users', [AdminController::class, 'AdminUsers'])->name('admin.users');
    Route::get('admin/users/view/{id}', [AdminController::class, 'AdminUsersView'])->name('admin.users.view');
    Route::get('admin/users/add', [AdminController::class, 'AdminAddUser'])->name('admin.users.adduser');
    Route::post('admin/users/add', [AdminController::class, 'AdminAddUserStore'])->name('admin.users.adduser.store');

    Route::get('admin/email/compose', [EmailController::class, 'EmailCompose'])->name('admin.email.compose');
    Route::post('admin/email/compose_post', [EmailController::class, 'EmailComposePost'])->name('admin.email.compose.post');
    Route::get('admin/email/sent', [EmailController::class, 'EmailSent'])->name('admin.email.sent');
    Route::get('admin/email/delete', [EmailController::class, 'AdminEmailSentDelete'])->name('admin.email.sent.delete');
    Route::get('admin/email/read/{id}', [EmailController::class, 'AdminEmailRead'])->name('admin.email.read');
    Route::get('admin/email/read_delete/{id}', [EmailController::class, 'AdminEmailReadDelete'])->name('admin.email.read.delete');
});

Route::middleware(['auth', 'role:agent'])->group(function(){
    Route::get('agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
});

Route::get('set_new_password/{token}', [AdminController::class, 'SetNewPassword']);
Route::post('set_new_password/{token}', [AdminController::class, 'SetNewPasswordPost']);
Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

