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
Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('edit');
Route::put('/{blog}/edit', [BlogController::class, 'update'])->name('update');




/*

Route::get('/', [BlogController::class, 'index'])->name('index');

Route::prefix('/blog')->name('.blog')->controller(BlogController::class)->group(function () {
    Route::get('/', 'index')->name('blog');
    Route::get('/show/{blog}', 'show')->where('id', '\d+')->name('show');
    // Route::get('/show/{blog:slug}', 'show')->where('id', '\d+')->name('show');
    Route::get('/create', 'create')->name('create');
    Route::put('/store', 'store')->name('store');
});

*/
