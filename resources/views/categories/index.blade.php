@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header">
        Categories
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary float-right">+ Categories</a>
    </div>
    <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td><a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-success">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>
@endsection
