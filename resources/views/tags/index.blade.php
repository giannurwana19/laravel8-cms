@extends('layouts.app')

@section('content')


<div class="card">
    <div class="card-header">
        tags
        <a href="{{ route('tags.create') }}" class="btn btn-sm btn-primary float-right">+ tags</a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 25px">No</th>
                    <th>Name</th>
                    <th>Posts</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tags as $tag)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <a href="{{ route('tags.edit', $tag) }}" class="btn btn-sm btn-outline-success">Edit</a>
                        <button class="btn btn-sm btn-outline-danger"
                            onclick="handleDelete({{ $tag->id }})">Delete</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">Tags not found!</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="" method="POST" id="deletetagForm">
                    @csrf
                    @method('DELETE')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Delete tag</h5>
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
        const form = document.getElementById('deletetagForm');
        form.action = `/tags/${id}`;
        $('#deleteModal').modal('show');
    }
</script>
@endpush
