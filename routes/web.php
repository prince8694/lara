<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/Loginuser', [UserController::class, 'loginpage'])->name('loginform');
Route::post('/login', [UserController::class, 'login' ])->name('login');
Route::get('/Registeruser', [UserController::class, 'register'])->name('register');
Route::post('/saveuser', [UserController::class, 'saveuser'])->name('save.user');
Route::get('/comm', [UserController::class, 'showcommitte'])->name('commite');
Route::get('/admin-dashboard', [UserController::class, 'admin'])->name('admin.dash');
Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');