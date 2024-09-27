@extends('layout.app')

@section('content')
<div class="col-12">
    <center class="mt-4">
        <h1>Edit Tag</h1>
    </center>
</div>

<div class="col-8 mx-auto">

    <form action="{{ route('tags.update', $tag->id) }}" method="post" class="form">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name">Tag Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ $tag->name }}" required>
        </div>

        <div class="mb-3">
            <input type="submit" class="form-control btn btn-primary" value="Save">
        </div>
    </form>
</div>
@endsection
