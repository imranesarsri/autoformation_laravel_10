@extends('layout.layout')
@section('title', 'modifier Mon Blog')
@section('content')
    <h1>Create Blog</h1>

    <div class=" form-group">
        <form action="{{ route('update', ['blog' => $blog->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">name</label>
                <input type="text" name="name" value="{{ old('name', $blog->name) }}" class="form-control mb-4 mt-2"
                    id="name" placeholder="Enter name">
                @error('name')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" value="{{ old('slug', $blog->slug) }}" class="form-control mb-4 mt-2"
                    id="slug" placeholder="Enter slug">
                @error('slug')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="form-group">
                {{-- Categories --}}
                <select name="categorie_id" class="form-select" aria-label="Default select example">
                    @foreach ($Categories as $Categorie)
                        <option @selected($blog->categorie->id == $Categorie->id) value="{{ $Categorie->id }}">{{ $Categorie->name }}</option>
                    @endforeach
                </select>
            </div>
    </div>
    <div class="form-group">
        <label for="content">Content</label>
        <textarea class="form-control mb-4 mt-2" name="content" id="content" cols="30" rows="10"
            placeholder="Enter content">{{ old('content', $blog->content) }}</textarea>
        @error('content')
            <p class="text-danger">
                {{ $message }}
            </p>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary form-control mb-4 mt-2">
        Update
    </button>
    </form>
    </div>
@endsection
