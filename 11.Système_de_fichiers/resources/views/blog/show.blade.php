@extends('layout.layout')
@section('title', 'Mon Blog')
@section('content')
    <h1>Mon Blog</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Slug</th>
                <th scope="col">Content</th>
                <th scope="col">Categorie</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $blog->name }}</td>
                <td>{{ $blog->slug }}</td>
                <td>{{ $blog->content }}</td>
                <td>{{ $blog->categorie->name }}</td>
            </tr>
        </tbody>
    </table>
@endsection
