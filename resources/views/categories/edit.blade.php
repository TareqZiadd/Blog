@extends('layout.app')

@section('content')
    <div class="col-12">
        <center class="m-5">
            <h1 class="mt-3">Edit Category</h1>
        </center>
    </div>

    <x-flash-message></x-flash-message>

    <div class="col-8 mx-auto">
        <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="post" class="form">
            <x-errors-display> </x-errors-display>

            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title">Category Name</label>
                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
            </div>
            <div class="mb-4">
                <label for="slug">Category Slug</label>
                <input class="form-control" type='text' name="slug" value='{{ $category->slug }}'>

                <div class="mt-3">


                    <div class="mt-5">
                        <center><span class="bg-warning p-1 rounded">Note: The slug cannot be edited unless it adheres to
                                the required slug rules.</span></center>
                    </div>

                    <strong>Examples:</strong>
                    <ul>
                        <li><strong>Valid Slugs:</strong> <code>product-name</code>, <code>2024-event</code>,
                            <code>about</code>
                        </li>
                        <li><strong>Invalid Slugs:</strong> <code>Product Name</code> (contains spaces and uppercase
                            letters), <code>@new_product</code> (contains special character `@`),
                            <code>---invalid-start</code> (starts with a dash)
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" class="form-control btn btn-primary" value="Save">
            </div>
        </form>
    </div>
@endsection
