@extends('layout.layout')
@section('title', 'Mon Blog')
@section('content')
    <h1>Mon Blog</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">content</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $blog->title }}</td>
                <td>{{ $blog->slug }}</td>
                <td>{{ $blog->content }}</td>
            </tr>
        </tbody>
    </table>
@endsection
