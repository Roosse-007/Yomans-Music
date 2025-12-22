<?php

namespace App\Http\Controllers;

use App\Models\Album;
use Illuminate\Http\Request;

class AlbumController extends Controller
{
    public function index()
    {
        return Album::with('artist')->get();
    }

    public function store(Request $request)
    {
        return Album::create(
            $request->validate([
                'title' => 'required',
                'artist_id' => 'required|exists:artists,id',
                'release_date' => 'nullable|date'
            ])
        );
    }

    public function show(Album $album)
    {
        return $album->load('artist', 'songs');
    }

    public function update(Request $request, Album $album)
    {
        $album->update($request->all());
        return $album;
    }

    public function destroy(Album $album)
    {
        $album->delete();
        return response()->json(['message' => 'Album deleted']);
    }
}
