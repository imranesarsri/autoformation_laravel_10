<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $Posts = Post::paginate(6);
        // dd($Posts);
        return view('blog.index', compact('Posts'));
        // return Post::paginate(2);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $blog = new Post();
        return view('blog.create', compact('blog'));
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
        $blog->update($request->validated());
        return redirect('/')->with('success', "L'article a bien été modifier");
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $blog)
    {
        $blog->delete();
        return redirect('/')->with('success', "L'article a bien été supprimer");

    }
}
