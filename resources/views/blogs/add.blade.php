@extends('layout.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Add New Blog</h1>

        <x-flash-message></x-flash-message>
        <x-errors-display></x-errors-display>
        <div class="col-lg-8 mx-auto">
            <form action="{{ route('blogs.store') }}" method="post" class="form" enctype="multipart/form-data">
                @csrf

                <!-- Display validation errors -->

                <div class="mb-4">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}"
                        required>
                </div>

                <div class="mb-4">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" name="content" id="content" rows="7" required>{{ old('content') }}</textarea>
                </div>

                <div class="mb-4">
                    <label  class="form-label">Tag</label>
                    <select name="tags[]" multiple class="form-select" required>
                        @foreach ($tags as $tag)
                            <option value="{{$tag->id}}">
                               {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="excerpt" class="form-label">Excerpt</label>
                    <input type="text" class="form-control" name="excerpt" id="excerpt" value="{{ old('excerpt') }}"
                        required>
                </div>

                <div class="mb-4">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-select" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label for="author_id" class="form-label">Author</label>
                    <select name="author_id" id="author_id" class="form-select" required>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                {{ $author->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="mb-4">
                    <label for="user_id" class="form-label">User</label>
                    <select name="user_id" class="form-select" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>

                <label for="image" class="form-label">Image</label>
                    <input type="file" name="image">
                <div class="mb-4 text-center">
                    <input type="submit" class="btn btn-primary" value="Add Blog">
                </div>



            </form>
        </div>
    </div>
@endsection
