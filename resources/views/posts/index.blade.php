@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        Posts
        <a href="{{ route('posts.create') }}" class="btn btn-sm btn-primary float-right">+ Post</a>
    </div>
    <div class="card-body"></div>
</div>
@endsection
