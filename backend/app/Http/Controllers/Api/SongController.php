<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    // List semua lagu (public)
    public function index()
    {
        $songs = Song::with(['album.artist', 'genre'])->get();
        $songs->map(fn($song) => $song->audio_url = asset('storage/' . $song->audio_path));
        return response()->json($songs);
    }

    // Ambil lagu berdasarkan artist
    public function byArtist($artistId)
    {
        $songs = Song::whereHas('album', fn($q) => $q->where('artist_id', $artistId))
                     ->with('album.artist', 'genre')
                     ->get();

        $songs->map(fn($song) => $song->audio_url = asset('storage/' . $song->audio_path));

        return response()->json($songs);
    }

    // CRUD hanya untuk user auth
    public function store(Request $request)
    {
        $data = $request->validate([
            'album_id' => 'required|exists:albums,id',
            'genre_id' => 'required|exists:genres,id',
            'title' => 'required|string',
            'duration' => 'required|integer',
            'audio_path' => 'required|string'
        ]);

        $song = Song::create($data);
        $song->audio_url = asset('storage/' . $song->audio_path);
        return response()->json($song, 201);
    }

    public function show(Song $song)
    {
        $song->load('album.artist', 'genre');
        $song->audio_url = asset('storage/' . $song->audio_path);
        return response()->json($song);
    }

    public function update(Request $request, Song $song)
    {
        $song->update($request->all());
        $song->audio_url = asset('storage/' . $song->audio_path);
        return response()->json($song);
    }

    public function destroy(Song $song)
    {
        $song->delete();
        return response()->json(['message' => 'Song deleted']);
    }
}