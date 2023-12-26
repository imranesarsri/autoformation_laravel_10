@extends('layout.layout')
@section('title', 'Mon Blog')
@section('content')
    <h1>Mon Blog</h1>

    <div class="d-flex row">
        {{-- <div class="d-flex">
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
        </div> --}}

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Post Name</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Tag</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Posts as $Post)
                    <tr>
                        <td>
                            {{ $Post->name }}
                        </td>
                        <td>
                            {{ $Post->slug }}
                        </td>
                        <td>
                            {{ $Post->categorie->name }}
                        </td>
                        @foreach ($Post->tags as $tag)
                            <td>
                                @if (empty($tag->name))
                                    null
                                @else
                                    {{ $tag->name }}
                                @endif

                            </td>
                        @endforeach
                        <td>
                            <a class="btn btn-success" href="{{ route('edit', ['blog' => $Post->id]) }}"
                                class="card-link text-info ">edit</a>
                            <a class="btn btn-light" href="{{ route('show', ['blog' => $Post->id]) }}"
                                class="card-link ">show</a>

                        </td>
                @endforeach
                </tr>
            </tbody>
        </table>

        {{ $Posts->links() }}
    </div>
@endsection
