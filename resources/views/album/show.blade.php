@extends('layout.layout')
@section('title', 'Show Album')
@section('content')
    <h2>Album name is: {{ $album->name }}</h2>
    <h3>Add new picture to album</h3>

    <form action="{{ route('pictures.store', ['album' => $album->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Picture name</label>
            <input type="text" id="name" name="name" class="form-control">
            @error('name')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="picture" class="form-label">Upload Picture</label>
            <input type="file" id="picture" name="picture" class="form-control">
            @error('picture')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <button class="btn btn-primary" type="submit">Add picture</button>
            <a class="btn " href="{{route('albums.index')}}">Back to your albums &rarr;	</a>
        </div>
    </form>

    @if(session('success'))
        <div class="text-success alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex mt-5">
        @foreach ($album->pictures as $picture)
            <div class="me-2 ms-2">
                <img src="{{ Storage::url($picture->path) }}" alt="{{ $picture->name }}" width="300" height="300">
                <h4 class="text-center">{{ $picture->name }}</h4>
            </div>
        @endforeach
    </div>
@endsection
