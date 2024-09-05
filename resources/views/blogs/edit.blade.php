@extends('layout.app')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center">Edit Blog </h1>

        <x-flash-message></x-flash-message>

        <div class="col-8 mx-auto">
            <form action="{{ route('blogs.update', ['id' => $blog->id]) }}" method="post" class="form">
                @csrf
                @method('PUT')

                <!-- Display validation errors -->
                <errors-display></errors-display>

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $blog->title }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" name="content" id="content" rows="7" required>{{ $blog->content }}</textarea>
                </div>


                <div class="mb-3">
                    <label for="excerpt" class="form-label">Excerpt</label>
                    <input type="text" class="form-control" name="excerpt" id="excerpt" value="{{ $blog->excerpt }}"
                        required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="draft" {{ $blog->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $blog->status == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $blog->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="author_id" class="form-label">Author</label>
                    <select name="author_id" id="author_id" class="form-control" required>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ $blog->author_id == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection
