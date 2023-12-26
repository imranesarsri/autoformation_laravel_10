<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Route::middleware(['auth'])->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog');
    Route::get('/show/{blog}', [BlogController::class, 'show'])->where('id', '\d+')->name('show');
    // Route::get('/show/{blog:slug}', [BlogController::class, 'show'])->where('id', '\d+')->name('show');
    Route::get('/create', [BlogController::class, 'create'])->name('create');
    Route::put('/store', [BlogController::class, 'store'])->name('store');
    Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('edit');
    Route::put('/{blog}/edit', [BlogController::class, 'update'])->name('update');
});

// login
Route::get('login', [LoginController::class, 'index'])->name('login.index')->middleware('guest');
Route::put('login', [LoginController::class, 'authenticate'])->name('login')->middleware('guest');
Route::get('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');