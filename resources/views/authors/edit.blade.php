@extends('layout.app')

@section('content')
    <div class="col-12">
        <center class="mt-4">
            <h1>Edit Author</h1>
        </center>
    </div>

    <div class="col-8 mx-auto">

        <x-flash-message> </x-flash-message>

        <form method="post" class="form" action="{{ route('authors.update', $author->id) }}">

            <x-errors-display> </x-errors-display>

            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" name="name" value="{{ $author->name }}">
            </div>
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="text" class="form-control" name="email" value="{{ $author->email }}">
            </div>
            <div class="mb-3">
                <label for="bio">Biography</label>
                <textarea class="form-control" name="bio" rows="7">{{ $author->bio }}</textarea>
            </div>
            <div class="mb-3">
                <input type="submit" class="form-control btn btn-primary" value="Save">
            </div>
        </form>
    </div>
@endsection
