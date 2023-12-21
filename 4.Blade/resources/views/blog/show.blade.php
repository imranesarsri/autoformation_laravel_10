@extends('layout.layout')
@section('title', 'show Blog')
@section('content')
    <h1>show Blog</h1>
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
                <td>{{ $Post->title }}</td>
                <td>{{ $Post->slug }}</td>
                <td>{{ $Post->content }}</td>
            </tr>
        </tbody>
    </table>
@endsection
