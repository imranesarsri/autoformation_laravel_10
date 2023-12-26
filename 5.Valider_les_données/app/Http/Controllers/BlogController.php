<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\View\View;
use App\Http\Requests\CreatePostRequest;

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
    public function store(CreatePostRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        // dd($validated);
        $Post = Post::create($validated);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request): view
    {
        $Post = Post::find($request);
        // dd($Post);
        return view('blog.show', compact('Post'));
    }

}
