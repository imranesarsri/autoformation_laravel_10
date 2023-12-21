@extends('layout.layout')
@section('title', 'Mon Blog')
@section('content')
    <h1>Create Blog</h1>

    <div class=" form-group">
        <form action="{{ route('store') }}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" value="{{ old('title') }}" class="form-control mb-4 mt-2" id="title"
                    placeholder="Enter Title">
                @error('title')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" value="{{ old('slug') }}" class="form-control mb-4 mt-2"
                    id="slug" placeholder="Enter slug">
                @error('slug')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Content</label>
                <input type="text" name="content" value="{{ old('content') }}" class="form-control mb-4 mt-2"
                    id="content" placeholder="Enter content">
                @error('content')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mb-4 mt-2">Create</button>
        </form>
    </div>
@endsection
