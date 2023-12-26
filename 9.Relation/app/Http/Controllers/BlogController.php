<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Categorie;
use App\Models\Tag;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $Tags = Tag::all();
        // dd($pot->tags);
        $Posts = Post::paginate(4);
        return view('blog.index', compact('Posts', 'Tags'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $Categories = Categorie::all();
        // dd($Categories);
        return view('blog.create', compact('Categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        // dd($validated);
        Post::create($validated);
        return redirect('/')->with('success', "L'article a bien été sauvegardé");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $blog): view
    {
        // dd($blog);
        // $id = $request->id;
        // $Post = Post::find($id);
        // $Post = Post::findOrFail($blog);
        // dd($Post->title);
        // dd($blog);
        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $blog)
    {
        // dd($blog);
        return view('blog.edit', compact('blog'));

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $blog)
    {
        Post::create($request->validated());
        return redirect('/')->with('success', "L'article a bien été modifier");
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}