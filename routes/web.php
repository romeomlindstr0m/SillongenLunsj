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

Route::middleware(['auth', 'can:access-dashboard'])->group(function() {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');

    Route::get('items/table', [ItemsController::class, 'table'])->name('items.table');
    Route::get('items/create', [ItemsController::class, 'create'])->name('items.create');
    Route::post('items/store', [ItemsController::class, 'store'])->name('items.store');
    Route::get('items/{id}/edit', [ItemsController::class, 'edit'])->name('items.edit');
    Route::post('items/{id}/update', [ItemsController::class, 'update'])->name('items.update');
    Route::post('items/{id}/destroy', [ItemsController::class, 'destroy'])->name('items.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::post('/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}/show', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/destroy', [OrderController::class, 'destroy'])->name('orders.destroy');
});

Route::get('/login', [AuthenticationController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login.process');

Route::get('/register', [AuthenticationController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthenticationController::class, 'register'])->name('register.process');

Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/items', [ItemsController::class, 'index'])->name('items.index');

Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store')->middleware('auth');