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
                    <th>Category</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                <tr>
                    <td><img src="{{ asset("storage/$post->image") }}" width="100" alt="{{ $post->title }}"></td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name  ?? 'Uncategorized'}}</td>
                    <td>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @if($post->trashed())
                            <a href="{{ route('posts.restore', $post) }}" onclick="return confirm('Restore this post?')" class="btn btn-sm btn-outline-success">Restore</a>
                            @else
                            <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-outline-success">Edit</a>
                            @endif


                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this post?')">
                                {{ $post->trashed() ? 'Destroy' : 'Delete' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">The posts is not found!</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
