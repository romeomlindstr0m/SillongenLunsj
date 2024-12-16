<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ItemsController;

Route::get('/', function() {
    return redirect()->route('home');
});

Route::get('/home', function() {
    return view('home');
})->name('home');

Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.process');

Route::get('/register', [AuthenticationController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/items', [ItemsController::class, 'index'])->name('items.index');