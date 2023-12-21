<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\BlogController;

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


Route::get('/', [BlogController::class, 'index'])->name('blog');
Route::get('/show/{blog}', [BlogController::class, 'show'])->where('id', '\d+')->name('show');
// Route::get('/show/{blog:slug}', [BlogController::class, 'show'])->where('id', '\d+')->name('show');
Route::get('/create', [BlogController::class, 'create'])->name('create');
Route::put('/store', [BlogController::class, 'store'])->name('store');