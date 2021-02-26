@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        users
    </div>
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="width: 25px">No</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ Gravatar::src($user->email) }}" style="width: 50px; border-radius: 50%" alt="{{ $user->name }}"></td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if(!$user->isAdmin())
                        <form action="{{ route('users.make-admin', $user) }}" method="POST">
                            @csrf

                            <button type="submit" class="btn btn-sm btn-success">Make Admin</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @empty
                <td colspan="3" class="text-center">Users not found!</td>
                @endforelse
            </tbody>
        </table>

    </div>
</div>
@endsection
