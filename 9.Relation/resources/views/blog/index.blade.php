@extends('layout.layout')
@section('title', 'Mon Blog')
@section('content')
    <h1>Mon Blog</h1>

    <div class="d-flex row">
        <div class="d-flex">
            <div class="card col-6 my-2">
                <label for="content">Tags :</label>
                <select name="categorie_id" class="form-select" aria-label="Default select example">
                    @foreach ($Tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="card col-6 my-2">
                <label for="content">Posts :</label>
                <select name="categorie_id" class="form-select" aria-label="Default select example">
                    @foreach ($Posts as $Post)
                        <option value="{{ $Post->id }}">{{ $Post->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @foreach ($Posts as $Post)
            <div class="card col-6 my-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $Post->name }}</h5>
                    <h2 class="card-title"> Categorie : {{ $Post->categorie->name }}</h2>
                    {{-- <h2 class="card-title">{{ $Post->tags->name }}</h2> --}}
                    @foreach ($Post->tags as $tag)
                        <h2 class="card-title">Tag :{{ $tag->name }}</h2>
                    @endforeach
                    <h6
                        class="card-subtitle mb-2 text-body-secondary >{{ $Post->slug }}</h6>
                    <p class="card-text">
                        {{ $Post->content }}</p>
                        <a href="{{ route('show', ['blog' => $Post->id]) }}" class="card-link ">show-></a>
                        <a href="{{ route('edit', ['blog' => $Post->id]) }}" class="card-link text-info ">edit-></a>
                </div>
            </div>
        @endforeach

        {{ $Posts->links() }}
    </div>
@endsection
