<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PlaylistSongController extends Controller
{
    // Tambah lagu ke playlist
    public function store(Request $request, Playlist $playlist)
    {
        if ($playlist->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'song_id' => 'required|exists:songs,id'
        ]);

        $playlist->songs()->syncWithoutDetaching($data['song_id']);

        Log::info('Song added to playlist', [
            'user_id' => Auth::id(),
            'playlist_id' => $playlist->id,
            'song_id' => $data['song_id']
        ]);

        return response()->json([
            'message' => 'Song added to playlist'
        ], 200);
    }

    // Hapus lagu dari playlist
    public function destroy(Playlist $playlist, Song $song)
    {
        if ($playlist->user_id !== Auth::id()) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $playlist->songs()->detach($song->id);

        Log::info('Song removed from playlist', [
            'user_id' => Auth::id(),
            'playlist_id' => $playlist->id,
            'song_id' => $song->id
        ]);

        return response()->json([
            'message' => 'Song removed from playlist'
        ], 200);
    }
}
