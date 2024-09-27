@extends('layout.app')

@section('content')
<div class="col-12">
    <a href="{{ route('users.create') }}" class="btn btn-primary my-3">Add User</a>
    <center class="mt-4"><h1>All Users</h1></center>
</div>


<table class="table table-bordered">

<x-flash-message></x-flash-message>

    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->type }}</td>
                <td>{{ $user->name }}</td>
                <td><a href="{{ route('users.edit',$user->id) }}" class="btn btn-info">Edit</a></td>
                <td>
                    <form action="{{ route('users.destroy',$user->id) }}"
                        method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-danger">
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
