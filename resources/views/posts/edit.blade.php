@extends('layout.app')

@section('content')
<div class="col-12">
    <center class="mt-4">
        <h1>Edit Post</h1>
    </center>
</div>

<div class="col-8 mx-auto">

    <form action="{{ route('posts.update', ['id' => $post->id]) }}" method="post" class="form">
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
            <label for="title">Post Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $post->title }}">
        </div>
        <div class="mb-3">
            <label for="description">Post Description</label>
            <textarea class="form-control" name="description" id="description" rows="7">{{ $post->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="user_id">Writer</label>
            <select name="user_id" class="form-control" id="user_id">
                <option value="1" {{ $post->user_id == 1 ? 'selected' : '' }}>Mostafa</option>
                <option value="2" {{ $post->user_id == 2 ? 'selected' : '' }}>Ali</option>
            </select>
        </div>
        <div class="mb-3">
            <input type="submit" class="form-control btn btn-primary" value="Save">
        </div>
    </form>
</div>
@endsection
