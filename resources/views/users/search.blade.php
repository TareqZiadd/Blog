@extends('layout.app')

@section('content')

<div class="col-12 mt-5">
    @foreach ($posts as $post)
    <div class="card">
        <span class="m-2">{{$post->user->name}} -{{ $post->created_at->format('y-m-d | h:i:s A') }}</span>
        <hr>
        <div class="card-body">
            <h5 class="card-title">{{ $post->title }}</h5>
            <p class="card-text">{{ Str::limit($post->description, 100, ' ...') }}</p>
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">Show Post</a>
        </div>
    </div>
    @endforeach
</div>

@endsection
