<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BillController;



Route::get('/', function () {
    if(auth()->check()){
            return redirect()->route('admin.dash');
        }
        return view('welcome');
})->name('index');

Route::get('/Loginuser', [UserController::class, 'loginpage'])->name('loginform');
Route::post('/login', [UserController::class, 'login' ])->name('login');
Route::get('/Registeruser', [UserController::class, 'register'])->name('register');
Route::post('/saveuser', [UserController::class, 'saveuser'])->name('save.user');
Route::get('/edit-holder/{userid}', [UserController::class, 'editholder'])->name('edit.holder');
Route::put('/update-holder', [UserController::class, 'updateholder'])->name('update.holder');
Route::get('/delete-holder/{userid}', [UserController::class, 'dltholder'])->name('dlt.holder');
Route::get('/admin-dashboard', [UserController::class, 'admin'])->name('admin.dash');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
Route::post('/savehome', [HomeController::class, 'create'])->name('add.home');
Route::get('/home', [UserController::class, 'adminhome'])->name('home');
Route::get('/userhome/{homeno}', [UserController::class, 'home'])->name('userhome');
Route::get('/change-owner/{homeid}', [UserController::class, 'changeowner'])->name('change.owner');

Route::put('/update-owner',[UserController::class, 'updateowner'])->name('update.owner');
Route::get('/delete-home/{homeid}', [HomeController::class, 'dlthome'])->name('delete.home');

Route::post('/save-event', [EventController::class, 'eventfun'])->name('events.store');
Route::post('/addbill', [BillController::class, 'addbill'])->name('add.bill');
Route::get('/revoke-bill/{billid}', [BillController::class, 'dltbill'])->name('revoke.bill');
Route::get('/showbill', [BillController::class, 'showbill'])->name('show.my.bill');


