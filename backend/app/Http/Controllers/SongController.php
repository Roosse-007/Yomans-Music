<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function index()
    {
        return Song::with(['album', 'genre'])->get();
    }

    public function store(Request $request)
    {
        return Song::create(
            $request->validate([
                'title' => 'required',
                'album_id' => 'required|exists:albums,id',
                'genre_id' => 'required|exists:genres,id',
                'duration' => 'required|integer'
            ])
        );
    }

    public function show(Song $song)
    {
        return $song->load('album', 'genre');
    }

    public function update(Request $request, Song $song)
    {
        $song->update($request->all());
        return $song;
    }

    public function destroy(Song $song)
    {
        $song->delete();
        return response()->json(['message' => 'Song deleted']);
    }
}
