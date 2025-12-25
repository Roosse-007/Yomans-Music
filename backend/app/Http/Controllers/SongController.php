<?php

namespace App\Http\Controllers\Api;

use App\Models\Song;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SongController extends Controller
{
    public function index()
    {
        return Song::with(['album.artist', 'genre'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => 'required|string',
            'album_id'   => 'required|exists:albums,id',
            'genre_id'   => 'required|exists:genres,id',
            'duration'   => 'required|integer',
            'audio_path' => 'required|string'
        ]);

        return Song::create($data);
    }

    public function show(Song $song)
    {
        return $song->load('album.artist', 'genre');
    }

    public function update(Request $request, Song $song)
    {
        $song->update($request->all());
        return $song;
    }

    public function destroy(Song $song)
    {
        $song->delete();

        return response()->json([
            'message' => 'Song deleted successfully'
        ]);
    }
}
