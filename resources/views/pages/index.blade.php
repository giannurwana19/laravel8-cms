@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid mt-n4">
    <div class="container text-center py-4">
        <h1 class="display-4">Posts</h1>
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

<div class="container">
    <div class="row my-5">
        <div class="col">
            <h4 class="text-center">Blog Posts</h4>
        </div>
    </div>
    <div class="row ">
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk
                                of the
                                card's
                                content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="row mb-4">
                <div class="col-md">
                    <ul class="list-group">
                        <li class="list-group-item active">Categories</li>
                        <li class="list-group-item">Cek</li>
                        <li class="list-group-item">Cek</li>
                        <li class="list-group-item">Cek</li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <ul class="list-group">
                        <li class="list-group-item active">Tags</li>
                        <li class="list-group-item">Cek</li>
                        <li class="list-group-item">Cek</li>
                        <li class="list-group-item">Cek</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
