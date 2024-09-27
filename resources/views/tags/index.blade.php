@extends('layout.app')

@section('content')
<div class="col-12">
    <a href="{{ route('tags.create') }}" class="btn btn-primary my-3">Add New Tag</a>
    <center class="mt-4"><h1>All Tags</h1></center>
</div>

@if (session()->has('success'))
    <center><h3 class='text-success'>{{ session('success') }}</h3></center>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Tag ID</th>
            <th>Tag Name</th>
            <th>blogs</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tags as $tag)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $tag->id }}</td>
                <td>{{ $tag->name }}</td>
             <td>

                    @foreach ($tag->blogs as $blog )
                        <span class='badge my-1 bg-warning ' >
                        {{ $blog->title}}
                  </span>
                  <br>
                  @endforeach


                 </td>
                <td><a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-info">Edit</a></td>
                <td>
                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tag?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
