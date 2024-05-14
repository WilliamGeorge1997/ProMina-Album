@extends('layout.layout')
@section('title','Create Album')
@section('content')
<div class="mt-5">
    <form action="{{ route('albums.store') }}" method="post">
        @csrf
    <div class="mb-3"><label for="name">Album Name </label>
        <input type="text" id="name" name="name"></div>
   <div> <button class="btn" type="submit">Create album</button> <a class="btn " href="{{route('albums.index')}}">Back to your albums &rarr;	</a></div>
    </form>

    @if(session('success'))
        <div class=" text-success alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
</div>
@endsection
