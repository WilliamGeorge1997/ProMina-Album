@extends('layout.layout')
@section('title','Edit')
@section('content')

    <h2>Edit Album</h2>



    <form action="{{ route('albums.update', $album->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Album Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $album->name }}">
            @if ($errors->any())
    <div class="alert-danger">

            @foreach ($errors->all() as $error)
             <span>   {{ $error }}</span>
            @endforeach

    </div>
@endif
        </div>
        <div>
            <button class="btn btn-primary" type="submit">Update Album</button>
        </div>
    </form>
    @if(session('success'))
    <div class="text-success alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


@endsection
