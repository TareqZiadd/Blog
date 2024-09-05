@extends('layout.app')

@section('content')
    <div class="container mt-5">
        @foreach ($blogs as $blog)
            <div class="card mb-4 shadow-sm border-0 rounded-lg">
                <div class="card-header bg-primary text-white rounded-top">
                    <h5 class="mb-0">{{ $blog->title }}</h5>
                    <small class="text-light">{{ $blog->created_at->format('y-m-d | h:i:s A') }}</small>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-primary">{{ $blog->title }}</h5>
                    <p class="card-text">{{ Str::limit($blog->content, 100, ' ...') }}</p>
                    <p class="card-text">
                        <strong>Category:</strong> <span class="badge bg-secondary">{{ $blog->category->name }}</span><br>
                        <strong>Author:</strong> <span class="text-muted">{{ $blog->author->name }}</span>
                    </p>
                    <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-outline-primary">Read More</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
