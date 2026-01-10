<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class SongController extends Controller
{
    // =========================
    // PUBLIC
    // =========================

    public function index()
    {
        return response()->json(
            Song::with(['album.artist', 'genre'])->get()
        );
    }

   public function byArtist($artistId)
{
    $songs = Song::whereHas('album', function ($q) use ($artistId) {
            $q->where('artist_id', $artistId);
        })
        ->with(['album.artist', 'genre'])
        ->get()
        ->map(function ($song) {
            return [
                'id' => $song->id,
                'title' => $song->title,
                'duration' => $song->duration,
                'audio_path' => $song->audio_path,

                // ARTIST
                'artist_name' => $song->album->artist->name,
                'artist_photo' => $song->album->artist->photo
                    ? asset('storage/' . $song->album->artist->photo)
                    : null,

                // ALBUM
                'album' => $song->album->title,

                // 🔥 INI KUNCI YANG HILANG
                'album_cover' => $song->album->cover
                    ? $song->album->cover
                    : null,

                // GENRE
                'genre' => $song->genre->name ?? null,
            ];
        });

    return response()->json($songs);
}



    // =========================
    // AUTH CRUD
    // =========================

    public function store(Request $request)
{
    $validated = $request->validate([
        'title'    => 'required|string|max:255',
        'album_id' => 'required|exists:albums,id',
        'genre_id' => 'required|exists:genres,id',
        'duration' => 'required|integer|min:1',
        'audio'    => 'required|file|mimes:mp3,wav'
    ]);

    // simpan file dari mana pun (PC / Postman)
    $path = $request->file('audio')->store('songs', 'public');

    $song = \App\Models\Song::create([
        'title'      => $validated['title'],
        'album_id'   => $validated['album_id'],
        'genre_id'   => $validated['genre_id'],
        'duration'   => $validated['duration'],
        'audio_path' => $path
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Song created successfully',
        'data'    => $song
    ], 201);
}


    public function show(Song $song)
    {
        return response()->json(
            $song->load('album.artist', 'genre')
        );
    }

    public function update(Request $request, \App\Models\Song $song)
{
    $validated = $request->validate([
        'title'    => 'sometimes|required|string|max:255',
        'album_id' => 'sometimes|required|exists:albums,id',
        'genre_id' => 'sometimes|required|exists:genres,id',
        'duration' => 'sometimes|required|integer|min:1',
        'audio'    => 'nullable|file|mimes:mp3,wav'
    ]);

    // kalau ganti file audio
    if ($request->hasFile('audio')) {

        // hapus audio lama
        // hapus audio lama
if ($song->audio_path && Storage::disk('public')->exists($song->audio_path)) {
    Storage::disk('public')->delete($song->audio_path);
}


        // simpan audio baru
        $path = $request->file('audio')->store('songs', 'public');
        $validated['audio_path'] = $path;
    }

    $song->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Song updated successfully',
        'data'    => $song
    ]);
}


    public function destroy(Song $song)
    {
        $song->delete();
        return response()->json(['message' => 'Song deleted']);
    }
}
