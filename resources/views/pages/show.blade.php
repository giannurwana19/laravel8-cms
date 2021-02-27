@extends('layouts.index')

@section('content')
<div class="jumbotron jumbotron-fluid mt-n4">
    <div class="container text-center py-4">
        <h1 class="display-4">Detail Posts</h1>
        <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Recipient's username"
                        aria-label="Recipient's username" aria-describedby="button-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
