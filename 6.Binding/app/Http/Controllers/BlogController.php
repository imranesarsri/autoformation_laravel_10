<?php

namespace App\Http\Controllers;

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
        $Posts = Post::paginate(2);
        // dd($Posts);
        return view('blog.index', compact('Posts'));
        // return Post::paginate(2);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|min:8',
            'slug' => 'required|string|min:8',
            'content' => 'required|string|min:8|max:100',
        ]);
        // dd($validated);
        $Post = Post::create($validated);
        return redirect('/');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}