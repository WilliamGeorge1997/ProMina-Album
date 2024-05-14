<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Album;
use App\Models\User;


class AlbumController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $userId = $user->id;

        $albums = Album::where('user_id', $userId)->get();

        return view('album.album', compact('albums'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('album.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        try {
            Album::create([
                'name' => $request->name,
                'user_id' => $user->id,
            ]);

            return redirect()->route('albums.index')->with('success', 'Album created successfully!');;
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Failed to create album. Please try again.')->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $album = Album::findOrFail($id);
        $pictures = $album->pictures()->get();
        return view('album.show', compact('album', 'pictures'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $album = Album::findOrFail($id);


        return view('album.edit', compact('album'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ], [
            'name.required' => 'The album name is required.',
            'name.string' => 'The album name must be a string.',
            'name.max' => 'The album name may not be greater than :max characters.',
        ]);

        try {
            $album = Album::findOrFail($id);
            $album->update([
                'name' => $request->name,
            ]);

            return redirect()->route('albums.index', $album->id)->with('success', 'Album updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update album. Please try again.')->withInput();
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {

            $album = Album::findOrFail($id);


            if ($album->pictures()->exists()) {

                return view('album.confirm_delete', compact('album'));
            }


            $album->delete();


            return redirect()->route('albums.index')->with('success', 'Album deleted successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->with('error', 'Failed to delete album. Please try again.');
        }
    }


    public function confirmDelete($id)
    {
        $album = Album::findOrFail($id);
        $albums = Album::where('id', '!=', $id)->get();
        return view('album.confirm_delete', ['album' => $album, 'albums' => $albums]);
    }

    public function delete(Request $request, $id)
    {
        $album = Album::findOrFail($id);
        $deleteOption = $request->input('delete_option');

        switch ($deleteOption) {
            case 'delete_album':
                $album->pictures()->delete();
                $album->delete();
                return redirect()->route('albums.index')->with('success', 'Album and its pictures deleted successfully!');
                break;
            case 'move_pictures':
                $destinationAlbumId = $request->input('destination_album');

                if (!$destinationAlbumId || $destinationAlbumId == $id) {
                    return redirect()->back()->with('error', 'Invalid destination album selected!');
                }

                $destinationAlbum = Album::findOrFail($destinationAlbumId);


                $album->pictures()->update(['album_id' => $destinationAlbum->id]);


                $album->delete();

                return redirect()->route('albums.index')->with('success', 'Pictures moved to another album successfully!');
                break;
            default:
                return redirect()->route('albums.index')->with('error', 'Invalid delete option selected!');
        }
    }
}
