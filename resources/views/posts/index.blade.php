@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Posts
        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary float-right">+ Post</a>
    </div>
    <div class="card-body">
        <table class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                <tr>
                    <td><img src="{{ asset("storage/$post->image") }}" width="100" alt="{{ $post->title }}"></td>
                    <td>{{ $post->title }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-success">Edit</a>
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2">The posts is not found!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
