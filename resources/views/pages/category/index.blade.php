@extends('layouts.index')

@section('content')
<div class="jumbotron jumbotron-fluid mt-n4">
    <div class="container text-center py-4">
        <h1 class="display-4">Category {{ $category->name }}</h1>
        <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{ route('blogs.index') }}">
                    <div class="input-group mb-3">
                        <input type="text" name="q" value="{{ request()->query('q') }}" class="form-control"
                            placeholder="Search blog here...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-outline-secondary" type="button"
                                id="button-addon2">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row my-3">
        <div class="col">
            <h4 class="text-center">Post for category : {{ $category->name }}</h4>
            <hr>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-9">
            <div class="row">
                @forelse ($posts as $post)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <img src="{{ $post->photo }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <span class="badge badge-success">Category : {{ $post->category->name }}</span>
                            <p class="card-text">{{ $post->description }}</p>
                            <a href="{{ route('blogs.show', $post) }}" class="btn btn-sm btn-primary">Detail...</a>
                        </div>
                    </div>
                </div>
                @empty
                <h4>No Posts for category {{ $category->name }}!</h4>
                @endforelse
            </div>
        </div>

        @include('partials.sidebar')
        <div class="row mt-4">
            <div class="col-md">{{ $posts->links() }}</div>
        </div>
    </div>

</div>
@endsection
