@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">Categories</div>
    <div class="card-body">
        <form action="">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" name="name">
            </div>

            <button class="btn btn-success">Submit</button>
        </form>
    </div>
</div>
@endsection
