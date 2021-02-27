@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        {{ isset($tag) ? 'Edit Tag' : 'Create Tag' }}
    </div>
    <div class="card-body">
        <form action="{{ isset($tag) ? route('tags.update', $tag) : route('tags.store') }}"
            method="POST">
            @csrf

            @if(isset($tag))
            @method('PUT')
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <div class="list-group">
                    @foreach ($errors->all() as $error)
                    <li class="list-group-item text-danger">{{ $error }}</li>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" name="name"
                    value="{{ isset($tag) ? $tag->name : old('name') }}" autofocus>
            </div>

            <button class="btn btn-success">
                {{ isset($tag) ? 'Update' : 'Submit' }}
            </button>
        </form>
    </div>
</div>
@endsection
