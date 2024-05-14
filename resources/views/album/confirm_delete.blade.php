@extends('layout.layout')
@section('title','Confirm Delete')
@section('content')
    <h2>Confirm Delete Album</h2>
    <form action="{{ route('albums.delete', $album->id) }}" method="post">
        @csrf
        @method('DELETE')
        <span>Delete album with pictures:</span>
        <button class="btn-danger" type="submit" name="delete_option" value="delete_album">Delete</button>
    </form>
    <form  action="{{ route('albums.delete', $album->id) }}" method="post">
        @csrf
        @method('DELETE')
        <label for="destination_album">Delete album and move pictures to:</label>
        <select name="destination_album" id="destination_album">
            @foreach($albums as $other_album)
                @if($other_album->id != $album->id)
                    <option value="{{ $other_album->id }}">{{ $other_album->name }}</option>
                @endif
            @endforeach
        </select>
        <span>album</span>
        <button class="btn-danger" type="submit" name="delete_option" value="move_pictures">Move & Delete</button>
    </form>
   <div class="mt-5"> <a class="btn " href="{{route('albums.index')}}">Back to your albums &rarr;	</a></div>
@endsection
