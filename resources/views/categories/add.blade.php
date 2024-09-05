@extends('layout.app')

@section('content')
    <div class="col-12">
        <center class="m-5">
            <h1 class="mt-3">Add Category</h1>
        </center>
    </div>

    <div class="col-8 mx-auto">
        <form action="{{ route('categories.store') }}" method="POST" class="form border p-3">
            @csrf

            <x-errors-display> </x-errors-display>
            <x-flash-message> </x-flash-message>

            <div class="mb-3">
                <label for="name">Category Name</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="mb-3">
                <button type="submit" class="form-control btn btn-primary">
                    Submit
                </button>
            </div>
        </form>

        <strong>
            <p>Note: When you enter a category name, a unique slug for the category will be automatically generated based on
                the name. For example, the category name <strong>Traveling</strong> <strong>Across</strong>
                <strong>by</strong> <strong>Train</strong> will be converted to the slug
                <code>traveling-across-by-train</code>.
            </p>
        </strong>
    </div>
@endsection
