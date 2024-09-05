@extends('layout.app')

@section('content')

<div class="col-12 mt-5">

    <div class="card">
        <span class="m-2">{{ $post->user->name }}   _ {{$post->created_at->format('y-m-d | h:i:s A')}}</span>
        <hr>
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="card-text">{{ $post->description }}</p>
        </div>
      </div>
</div>
@endsection



