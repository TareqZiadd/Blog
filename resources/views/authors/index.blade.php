@extends('layout.app')

@section('content')
    <div class="col-12 m-4">
        <a href="{{ route('authors.create') }}" class="btn btn-primary mt-5">Add New Author</a>
        <center class="mt-4">
            <h1>All Authors</h1>
        </center>
    </div>


    <table class="table table-bordered">

        <x-flash-message></x-flash-message>

        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Bio</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($authors as $author)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->email }}</td>
                    <td>{{ Str::limit($author->bio, 50, '...') }}</td>
                    <td><a href="{{ route('authors.edit', $author->id) }}" class="btn btn-info">Edit</a></td>
                    <td>

                        <form action="{{ route('authors.destroy', $author->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $authors->links() }}
@endsection
