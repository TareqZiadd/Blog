@extends('layout.app')

@section('content')
    <div class="col-12 m-4">
        <a href="{{ route('blogs.create') }}" class="btn btn-primary mt-5">Add New Blog</a>
        <center class="m-3">
            <h1>All Blogs</h1>
        </center>
    </div>


    <table class="table table-bordered mt-">
        <x-flash-message></x-flash-message>
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Content</th>
                <th>Excerpt</th>
                <th>Slug</th>
                <th>Status</th>
                <th>Category</th>
                <th>Author</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ Str::limit($blog->title, 15, '...') }}</td>
                    <td>{{ Str::limit($blog->content, 30, '...') }}</td>
                    <td>{{ Str::limit($blog->excerpt, 20, '...') }}</td>
                    <td>{{ $blog->slug }}</td>
                    {!! $blog->statusLabel() !!}
                    <td>{{ $blog->category->name }}</td>
                    <td>{{ $blog->author->name }}</td>

                    <td><a href="{{ route('blogs.edit', $blog->slug) }}" class="btn btn-info">Edit</a></td>
                    <td>
                        <form action="{{ route('blogs.destroy', $blog->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-danger">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $blogs->links() }}
@endsection
