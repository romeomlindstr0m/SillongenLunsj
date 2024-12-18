<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ItemsController;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\OrderController;

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
Route::get('items/table', [ItemsController::class, 'table'])->name('items.table')->middleware('auth');
Route::get('items/create', [ItemsController::class, 'create'])->name('items.create')->middleware('auth');
Route::post('items/store', [ItemsController::class, 'store'])->name('items.store')->middleware('auth');

Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('auth');
Route::post('/users/store', [UserController::class, 'store'])->name('users.store')->middleware('auth');
Route::post('/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy')->middleware('auth');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->middleware('auth');
Route::get('/orders/{id}/show', [OrderController::class, 'show'])->name('orders.show')->middleware('auth');
Route::post('/orders/{id}/destroy', [OrderController::class, 'destroy'])->name('orders.destroy')->middleware('auth');