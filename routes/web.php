<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\SendPDFController;
use App\Http\Controllers\SMTPController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TransactionsController;
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

    Route::get('product_cart', [ProductCartController::class, 'AdminProductList']);
    Route::get('product_cart/add', [ProductCartController::class, 'AdminProductCartAdd']);
    Route::post('product_cart/add', [ProductCartController::class, 'AdminProductCartStore']);
    Route::get('product_cart/edit/{id}', [ProductCartController::class, 'AdminProductCartEdit']);
    Route::post('product_cart/edit/{id}', [ProductCartController::class, 'AdminProductCartUpdate']);
    Route::delete('product_cart/delete', [ProductCartController::class, 'AdminProductCartDelete']);
    

    Route::get('support', [SupportController::class, 'Support']);
    Route::get('support/reply/{id}', [SupportController::class, 'Reply']);
    Route::post('support/reply/{id}', [SupportController::class, 'ReplyStore']);
    Route::post('support/change_status', [SupportController::class, 'ChangeStatus']);
    Route::get('support/onoff/{id}', [SupportController::class, 'SupportOnOff']);
    Route::get('support/delete_item_multi', [SupportController::class, 'SupportDeleteItemMulti']);
    
    

    Route::get('discount_code', [DiscountController::class, 'DiscountCode']);
    Route::get('discount_code/add', [DiscountController::class, 'DiscountCodeAdd']);
    Route::post('discount_code/add', [DiscountController::class, 'DiscountCodeStore']);
    Route::get('discount_code/edit/{id}', [DiscountController::class, 'DiscountCodeEdit']);
    Route::put('discount_code/edit', [DiscountController::class, 'DiscountCodeUpdate']);
    Route::delete('discount_code/delete', [DiscountController::class, 'DiscountCodeDelete']);

    Route::get('change_password', [AdminController::class, 'AdminChangePassword']);
    Route::post('change_password/update', [AdminController::class, 'AdminUpdatePassword']);

    Route::get('users/typeahead_autocomple', [AdminController::class, 'AdminUserTypeaheadAutocomplete']);

    Route::get('full_calendar', [FullCalendarController::class, 'index']);
    Route::post('full_calendar/action', [FullCalendarController::class, 'action']);

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
    Route::post('checkemail', [AdminController::class, 'CheckEmail']);

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

    Route::get('notification', [NotificationController::class, 'NotificationIndex']);
    Route::post('notification_send', [NotificationController::class, 'NotificationSend']);

    Route::get('qrcode', [QRCodeController::class, 'List']);
    Route::get('qrcode/add', [QRCodeController::class, 'AddQrcode']);
    Route::post('qrcode/add', [QRCodeController::class, 'StoreQrcode']);
    Route::get('qrcode/edit/{id}', [QRCodeController::class, 'EditQrcode']);
    Route::post('qrcode/edit/{id}', [QRCodeController::class, 'UpdateQrcode']);
    Route::get('qrcode/delete/{id}', [QRCodeController::class, 'DeleteQrcode']);

    Route::get('smtp', [SMTPController::class, 'SMTPList']);
    Route::post('smtp_update', [SMTPController::class, 'SMTPUdate']);

    Route::get('color',[ColorController::class, 'ColorList'])->name('admin.color');
    Route::get('color/add', [ColorController::class, 'ColorAdd'])->name('admin.color.add');
    Route::post('color/add', [ColorController::class, 'ColorStore']);
    Route::get('color/edit/{id}', [ColorController::class, 'ColorEdit']);
    Route::post('color/edit/{id}', [ColorController::class, 'ColorUpdate']);
    Route::get('color/delete/{id}', [ColorController::class, 'ColorDelete']);
    Route::post('color/change_status', [ColorController::class, 'ColorChangeStatus']);

    Route::get('order', [OrderController::class, 'OrderList']);
    Route::get('order/add', [OrderController::class, 'OrderAdd']);
    Route::post('order/add', [OrderController::class, 'OrderStore']);
    Route::get('order/edit/{id}', [OrderController::class, 'OrderEdit']);
    Route::post('order/edit/{id}', [OrderController::class, 'OrderUpdate']);
    Route::get('order/delete/{id}', [OrderController::class, 'OrderDelete']);

    Route::get('blog', [BlogController::class, 'BlogList']);
    Route::get('blog/add', [BlogController::class, 'BlogAdd'])->name('admin.blog.add');
    Route::post('blog/add', [BlogController::class, 'BlogStore']);
    Route::get('blog/view/{id}', [BlogController::class, 'BlogView']);
    Route::get('blog/delete/{id}', [BlogController::class, 'BlogDelete']);
    Route::get('blog/edit/{id}', [BlogController::class, 'BlogEdit']);
    Route::post('blog/edit/{id}', [BlogController::class, 'BlogUpdate']);

    Route::get('pdf_demo', [ColorController::class, 'PdfDemo'])->name('admin.pdf_demo');
    Route::get('pdf_color', [ColorController::class, 'PdfColor'])->name('admin.pdf_color');

    Route::get('countries', [LocationController::class, 'CountriesIndex']);
    Route::get('countries/add', [LocationController::class, 'CountriesAdd']);
    Route::post('countries/add', [LocationController::class, 'CountriesStore']);
    Route::get('countries/edit/{id}', [LocationController::class, 'CountriesEdit']);
    Route::post('countries/edit/{id}', [LocationController::class, 'CountriesUpdate']);
    Route::get('countries/delete/{id}', [LocationController::class, 'CountriesDelete']);

    Route::get('state', [LocationController::class, 'StateList']);
    Route::get('state/add', [LocationController::class, 'StateAdd']);
    Route::post('state/add', [LocationController::class, 'StateStore']);
    Route::get('state/edit/{id}', [LocationController::class, 'StateEdit']);
    Route::post('state/edit/{id}', [LocationController::class, 'StateUpdate']);
    Route::get('state/delete/{id}', [LocationController::class, 'StateDelete']);

    Route::get('city', [LocationController::class, 'CityList']);
    Route::get('city/add', [LocationController::class, 'CityAdd']);
    Route::get('get-states-name/{countryId}', [LocationController::class, 'GetStatesName']);
    Route::post('city/add', [LocationController::class, 'CityStore']);
    Route::get('city/edit/{id}', [LocationController::class, 'CityEdit']);
    Route::post('city/edit/{id}', [LocationController::class, 'CityUpdate']);
    Route::get('city/delete/{id}', [LocationController::class, 'CityDelete']);

    Route::get('address', [LocationController::class, 'AddressList']);
    Route::get('address/add', [LocationController::class, 'AddressAdd']);
    Route::get('get-cities-name/{stateId}', [LocationController::class, 'GetCitiesName']);
    Route::post('address/add', [LocationController::class, 'AddressStore']);
    Route::get('address/edit/{id}', [LocationController::class, 'AddressEdit']);
    Route::post('address/edit/{id}', [LocationController::class, 'AddressUpdate']);
    Route::get('address/delete/{id}', [LocationController::class, 'AddressDelete']);

    Route::get('send_pdf', [SendPDFController::class, 'sendPdf']);
    Route::post('send_pdf', [SendPDFController::class, 'sendPdfPost']);

    Route::delete('blog/truncate', [BlogController::class, 'BlogTruncate']);

    Route::get('transactions', [TransactionsController::class, 'TransactionsList']);
    Route::get('transactions/delete/{id}', [TransactionsController::class, 'TransactionsDelete']);
    Route::get('transactions/edit/{id}', [TransactionsController::class, 'TransactionsEdit']);
    Route::post('transactions/edit/{id}', [TransactionsController::class, 'TransactionsUpdate'])->name('admin.transactions.update');
});

Route::middleware(['auth', 'role:agent'])->group(function(){
    Route::get('agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');
    Route::get('agent/logout', [AdminController::class, 'AdminLogout'])->name('agent.logout');
    Route::get('agent/email/inbox', [AgentController::class, 'AgentEmailInbox']);

    Route::get('agent/transactions', [TransactionsController::class, 'AgentTransactionsList']);
    Route::get('agent/transactions/add', [TransactionsController::class, 'AgentTransactionsAdd']);
    Route::post('agent/transactions/add', [TransactionsController::class, 'AgentTransactionsStore']);
    Route::delete('agent/transactions/destroy', [TransactionsController::class, 'AgentTransactionsDestroy']);

});

Route::get('set_new_password/{token}', [AdminController::class, 'SetNewPassword']);
Route::post('set_new_password/{token}', [AdminController::class, 'SetNewPasswordPost']);
Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');

Route::get('generate/UUID',[AdminController::class, 'GenerateUUID']);
Route::get('notification_list', [NotificationController::class, 'NotificationList']);
Route::get('notification_list/{type}', [NotificationController::class, 'Notification'])->name('notification_list');

Route::get('item/create', [ItemController::class, 'Create']);
Route::get('item/search', [ItemController::class, 'Search']);

Route::get('product_cart', [ProductCartController::class, 'Index']);
Route::get('cart', [ProductCartController::class, 'Cart'])->name('cart');
Route::get('add_cart/{id}', [ProductCartController::class, 'AddCart'])->name('add.cart');
Route::patch('update_cart', [ProductCartController::class, 'UpdateCart'])->name('update.cart');