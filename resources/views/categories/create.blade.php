@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        {{ isset($category) ? 'Edit Category' : 'Create Category' }}
    </div>
    <div class="card-body">
        <form action="{{ isset($category) ? route('categories.update', $category) : route('categories.store') }}"
            method="POST">
            @csrf

            @if(isset($category))
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
                    value="{{ isset($category) ? $category->name : '' }}">
            </div>

            <button class="btn btn-success">
                {{ isset($category) ? 'Update' : 'Submit' }}
            </button>
        </form>
    </div>
</div>
@endsection
