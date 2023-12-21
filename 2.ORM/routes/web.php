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
    $post = \App\Models\Post::all();
    // $post = \App\Models\Post::all(['title', 'slug', 'content']);
    // $post = \App\Models\Post::paginate(2);
    // $post = \App\Models\Post::where('id', '>', 0)->limit(2)->get();
    // dd($post);
    return $post;
});

// ---------------------------------------------------------------
// ---------------------------- CREATE ---------------------------
// ---------------------------------------------------------------
// ----------------------- CREATION BASIC ------------------------

Route::get('createn', function () {
    $post = new \App\Models\Post();
    $post->title = "mon premier article 3";
    $post->slug = "mon-premier-article 3 slug";
    $post->content = "Mon contenu";
    $post->save();
    return $post;
});

// ---------------------------------------------------------------
// ---------------------- CREATION Mormale -----------------------

Route::get('createm', function () {
    $post = \App\Models\Post::create([
        'title' => 'title article 4',
        'slug' => 'slug article 43',
        'content' => 'content article 4',
    ]);

    return $post;
});


// ---------------------------------------------------------------
// -------------------------- MODIFIER ---------------------------
// ---------------------------------------------------------------

Route::get('modifier', function () {
    $post = \App\Models\Post::find(3);
    $post->title = "article 31";
    $post->save();
    return $post;
});



// ---------------------------------------------------------------
// -------------------------- SUPPRIMER --------------------------
// ---------------------------------------------------------------

Route::get('Supprimer', function () {
    $post = \App\Models\Post::find(3);
    $post->delete();
    dd($post);
});
