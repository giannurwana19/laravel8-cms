@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header">
        Categories
        <a href="{{ route('categories.create') }}" class="btn btn-sm btn-primary float-right">+ Categories</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 25px">No</th>
                    <th>Name</th>
                    <th>Posts</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->posts->count() }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category) }}"
                            class="btn btn-sm btn-outline-success">Edit</a>
                        <button class="btn btn-sm btn-outline-danger"
                            onclick="handleDelete({{ $category->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="POST" id="deleteCategoryForm">
                    @csrf
                    @method('DELETE')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete Category</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p class="text-center text-bold">are you sure want to delete it?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">No, go
                                back</button>
                            <button type="submit" class="btn btn-sm btn-danger">Yes, Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function handleDelete(id){
        const form = document.getElementById('deleteCategoryForm');
        form.action = `/categories/${id}`;
        $('#deleteModal').modal('show');
    }
</script>
@endpush
