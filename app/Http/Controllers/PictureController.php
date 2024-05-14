<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $album_id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ], [
        'name.required' => 'The picture name is required.',
        'name.string' => 'The picture name must be a string.',
        'name.max' => 'The picture name may not be greater than 255 characters.',
        'picture.required' => 'The picture file is required.',
        'picture.image' => 'The picture must be an image file.',
        'picture.mimes' => 'The picture must be a file of type: jpeg, png, jpg, gif.',
        'picture.max' => 'The picture may not be greater than 2048 kilobytes in size.',
    ]);

    try {
        $album = Album::findOrFail($album_id);
        $picture = $request->file('picture');
        $path = $picture->store('pictures', 'public');

        $album->pictures()->create([
            'name' => $request->name,
            'path' => $path,
            'album_id' => $album_id
        ]);

        return redirect()->route('albums.show', $album_id)->with('success', 'Picture uploaded successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Failed to upload picture. Please try again.')->withInput();
    }
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

    }
}
