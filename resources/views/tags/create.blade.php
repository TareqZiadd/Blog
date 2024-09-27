@extends('layout.app')

@section('content')
<div class="col-12">
    <center class="mt-4">
        <h1>Add Tag</h1>
    </center>
</div>

<div class="col-8 mx-auto">
    <form action="{{ route('tags.store') }}" method="POST" class="form border p-3">
        @csrf

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="mb-3">
            <label for="name">Tag Name</label>
            <input type="text" class="form-control" name="name" id="name"
            value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <button type="submit" class="form-control btn btn-primary">
                Submit
            </button>
        </div>
    </form>
</div>
@endsection
