<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ItemsController;

Route::get('/', function() {
    return view('index');
});

Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.process');

Route::get('/register', [AuthenticationController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register.process');

Route::get('/items', [ItemsController::class, 'index'])->name('items.index');