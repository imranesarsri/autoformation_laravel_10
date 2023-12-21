@extends('layout.layout')
@section('title', 'Mon Blog')
@section('content')
    <h1>Mon Blog</h1>

    <div class="d-flex row">
        @foreach ($Posts as $Post)
            <div class="card col-6 my-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $Post->title }}</h5>
                    <h6
                        class="card-subtitle mb-2 text-body-secondary >{{ $Post->slug }}</h6>
                    <p class="card-text">
                        {{ $Post->content }}</p>
                        <a href="{{ route('show', ['blog' => $Post->id]) }}" class="card-link ">show-></a>
                        <a href="{{ route('edit', ['blog' => $Post->id]) }}" class="card-link text-info ">edit-></a>
                        {{-- <a href="#" class="card-link">Another link</a> --}}
                </div>
            </div>
        @endforeach

        {{ $Posts->links() }}
    </div>
@endsection
