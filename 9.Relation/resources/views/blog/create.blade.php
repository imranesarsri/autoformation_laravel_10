@extends('layout.layout')
@section('title', 'Mon Blog')
@section('content')
    <h1>Create Blog</h1>

    <div class=" form-group">
        <form action="{{ route('store') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="name" value="{{ old('title') }}" class="form-control mb-4 mt-2" id="title"
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
                <textarea class="form-control mb-4 mt-2" name="content" id="content" cols="30" rows="10"
                    placeholder="Enter content">{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="form-group">
                <label for="categorie_id">Categorie</label>
                <select name="categorie_id" class="form-select" aria-label="Default select example">
                    @foreach ($Categories as $Categorie)
                        {{-- @dd($Categorie) --}}
                        <option value="{{ $Categorie->id }}">{{ $Categorie->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary form-control mb-4 mt-2">
                Create
            </button>
        </form>

    </div>
@endsection
