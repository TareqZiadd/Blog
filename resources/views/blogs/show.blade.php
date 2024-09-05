@extends('layout.app')

@section('content')
    <div class="container mt-5">


        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <div class="card mb-4 shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-danger text-white rounded-top">
                        <h5 class="mb-0" style="font-size: 2.25rem;">{{ $blog->title }}</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text" style="font-size: 1.6rem; line-height: 2.1;">{{ $blog->content }}</p>
                        <div class="mt-3">
                            <p class="card-text" style="font-size: 1.0 rem;">
                                <strong>Category:</strong>
                                <span class="badge bg-secondary">{{ $blog->category->name }}</span><br>
                                <strong>Author:</strong>
                                <span class="text-muted">{{ $blog->author->name }}</span>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-end">
                        <small style="font-size: 1rem;">{{ $blog->created_at->format('F d, Y \a\t h:i A') }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
