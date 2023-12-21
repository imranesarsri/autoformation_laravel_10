@extends('layout.layout')
@section('title', 'Mon Blog')
@section('content')
    <h1>Mon Blog</h1>
    @foreach ($Post as $item)
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
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->slug }}</td>
                    <td>{{ $item->content }}</td>
                </tr>
            </tbody>
        </table>
    @endforeach
@endsection
