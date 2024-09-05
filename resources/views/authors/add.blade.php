@extends('layout.app')

@section('content')
    <div class="col-12">

        <center class="m-5">
            <h1>Add Author</h1>
        </center>
    </div>

    <div class="col-8 mx-auto">
        <form action="{{ route('authors.store') }}" method="POST" class="form border p-3">
            @csrf

            <x-errors-display> </x-errors-display>
            <x-flash-message> </x-flash-message>

            <div class="mb-3">
                <label for="name">Full Name</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email">
            </div>

            <div class="mb-3">
                <label for="biography">Biography</label>
                <textarea class="form-control" name="bio" maxlength="4000" rows="7"></textarea>
            </div>


            <div class="mb-3">
                <button type="submit" class="form-control btn btn-primary">
                    Submit
                </button>
            </div>
        </form>
    </div>
@endsection
