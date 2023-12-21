<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;


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


// route get
Route::get('/', function () {
    return view('welcome');
});



Route::get('/blog', function () {
    return 'Bonjour';
});

Route::get('/bloge', function () {
    return [
        "article" => "Article 1",
    ];
});

// http://127.0.0.1:8000/blogaa?name=imrane
Route::get('/blogaa', function () {
    return [
        "name" => $_GET['name'],
        "article" => "Article 1"
    ];
});

// http://127.0.0.1:8000/blog?name=imrane&preman=sarsri
Route::get('/blogee', function (Request $request) {
    return [
        "path" => $request->path(),
        "url" => $request->url(),
        "all" => $request->all(),
        'name' => $request->input('name', 'imrane2'),
        "article" => "Article 2"
    ];
});

route::prefix('/blogsgroup')->group(function () {
    Route::get("/", function () {
        return [
            "link" => \route('blog.show', ['slug' => 'article', 'id' => '12']),
        ];
    })->name('blog.index');

    Route::get('/{id}-{slug}', function (string $id, string $slug, Request $request) {
        return [
            "slug" => $slug,
            "id" => $id,
            "name" => "Tanger",
        ];
    })->name('blog.show')->where([
                'id' => '[0-9]+',
                'slug' => '[a-zA-Z0-9]+',
            ]);
});

route::prefix('/blabla')->name('blabla.')->group(function () {
    Route::get("/", function () {
        return [
            "link" => \route('show', ['slug' => 'article', 'id' => '12']),
        ];
    })->name('index');

    Route::get('/{id}-{slug}', function (string $id, string $slug, Request $request) {
        return [
            "slug" => $slug,
            "id" => $id,
            "name" => "Tanger",
        ];
    })->name('show');
});