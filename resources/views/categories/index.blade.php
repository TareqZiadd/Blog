@extends('layout.app')

@section('content')
    <div class="col-12 m-4">


        <a href="{{ route('categories.create') }}" class="btn btn-primary mt-5">Add New Category</a>
        <center class="m-3">
            <h1>All Categories</h1>
        </center>
    </div>


    <table class="table table-bordered">
        <x-flash-message></x-flash-message>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ Str::limit($category->slug, 50, '...') }}</td>
                    <td><a href="{{ route('categories.edit', $category->slug) }}" class="btn btn-info">Edit</a></td>
                    <td>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $categories->links() }}
@endsection
