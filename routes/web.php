<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ComplaintController;
use Illuminate\Support\Facades\Mail;

Route::get('/test-brevo', function () {
    Mail::raw('Hello from Brevo!', function ($message) {
        $message->to('your-personal-email@gmail.com')
                ->subject('Brevo Test');
    });

    return "Check your inbox!";
});

Route::get('/', function () {
    if(auth()->check()){
            return redirect()->route('admin.dash');
        }
        return view('welcome');
})->name('index');

Route::get('/Loginuser', [UserController::class, 'loginpage'])->name('loginform');
Route::post('/login', [UserController::class, 'login' ])->name('login');
// Route::get('/Registeruser', [UserController::class, 'register'])->name('register');

//Route grouping with middleware
Route::middleware(['user_auth'])->group(function(){

Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::post('/save-event', [EventController::class, 'eventfun'])->name('events.store');
Route::get('/register-complaint',[ComplaintController::class, 'complaintform'])->name('complaint.form');
Route::post('/save-complaint',[ComplaintController::class, 'complaintstore'])->name('complaint.store');
Route::get('/userhome/{homeno}', [UserController::class, 'home'])->name('userhome');
Route::get('/showbill/{homeid}', [BillController::class, 'showmybill'])->name('show.my.bill');
Route::get('/paybill/{billid}', [BillController::class, 'paybill'])->name('pay.bill');
Route::get('/addmember', [UserController::class, 'addMember'])->name('add.member');
Route::post('/saveuser', [UserController::class, 'saveuser'])->name('save.user');


Route::middleware(['holder'])->group(function(){
    
Route::get('/delete-holder/{userid}', [UserController::class, 'dltholder'])->name('dlt.holder');
Route::get('/edit-holder/{userid}', [UserController::class, 'editholder'])->name('edit.holder');
Route::put('/update-holder', [UserController::class, 'updateholder'])->name('update.holder');
Route::get('/delete-holder/{userid}', [UserController::class, 'dltholder'])->name('dlt.holder');
Route::get('/admin-dashboard', [UserController::class, 'admin'])->name('admin.dash');
Route::post('/savehome', [HomeController::class, 'create'])->name('add.home'); 
Route::get('/home', [UserController::class, 'adminhome'])->name('home');
Route::get('/change-owner/{homeid}', [UserController::class, 'changeowner'])->name('change.owner');
Route::put('/update-owner',[UserController::class, 'updateowner'])->name('update.owner');
Route::get('/delete-home/{homeid}', [HomeController::class, 'dlthome'])->name('delete.home');
Route::post('/addbill', [BillController::class, 'addbill'])->name('add.bill');
Route::get('/revoke-bill/{billid}', [BillController::class, 'dltbill'])->name('revoke.bill');
Route::get('/showbill', [BillController::class, 'showbill'])->name('show.my.bill');
Route::get('/done-complaint/{complaintid}',[ComplaintController::class, 'complaintDone'])->name('done.complaint');

});
});