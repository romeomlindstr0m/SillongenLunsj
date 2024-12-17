<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ItemsController;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Gate;

Route::get('/', function() {
    return redirect()->route('home');
});

Route::get('/home', function() {
    return view('home');
})->name('home');

Route::get('/dashboard', function() {
    if (!Gate::allows('access-dashboard')) {
        abort(403);
    }

    return view('dashboard');
})->name('dashboard')->middleware('auth');

Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.process');

Route::get('/register', [AuthenticationController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/items', [ItemsController::class, 'index'])->name('items.index');

Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('auth');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store')->middleware('auth');
Route::post('/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');