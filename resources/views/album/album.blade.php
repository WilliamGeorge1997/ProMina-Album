@extends('layout.layout')
@section('title','Albums')
@section('content')
<div class="d-flex justify-content-center  align-items-center mt-5"><a class="text-blue btn" href="{{route('albums.create')}}">Create new album</a></div>
<div>
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
   </div>
<div class="d-flex  align-items-center mt-5">
@foreach ($albums as $album)
    <div class="text-center me-3 ms-3 album">
        <a class="mb-2" href={{ route('albums.show', $album->id) }}>
                <div>
                    @if ($album->pictures->isNotEmpty())
                        <img width="150" height="150" src="{{ Storage::url($album->pictures->first()->path) }}" alt="Album-Thumbnail">
                    @else

                        <img width="150" height="150" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQa1GBweBzsvhwznaZVMO1L3mSRg9lsW0VvhLXTSBWLtRY0LFr3tSZj0oiy8OufL9ZDnvw&usqp=CAU" alt="Album-Thumbnail">
                    @endif
                </div>
        <h3>{{ $album->name }}</h3>
        </a>
       <div class="d-flex justify-content-between align-content-center">
        <form action="{{ route('albums.edit', $album->id) }}" method="get">
            <button class="btn" type="submit">Edit</button>
        </form>
        @if ($album->pictures->isNotEmpty())
            <form action="{{ route('albums.confirm_delete', $album->id) }}" method="get">
                <button class="btn-danger" type="submit">Delete</button>
            </form>
        @else
            <form action="{{ route('albums.destroy', $album->id) }}" method="post">
                @csrf
                @method('delete')
                <button class="btn-danger" type="submit">Delete</button>
            </form>
        @endif
       </div>
    </div>
@endforeach
</div>
@endsection

