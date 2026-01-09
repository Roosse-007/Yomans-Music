<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function index()
    {
        activity_log(
            'VIEW',
            'PLAYLIST',
            'Melihat daftar playlist'
        );

        return response()->json([
            'success' => true,
            'data' => Auth::user()->playlists()->with('songs')->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);

        $playlist = Auth::user()->playlists()->create($data);

        activity_log(
            'CREATE',
            'PLAYLIST',
            'Membuat playlist: ' . $playlist->name
        );

        return response()->json([
            'success' => true,
            'message' => 'Playlist created',
            'data' => $playlist
        ], 201);
    }

    public function show(Playlist $playlist)
{
    activity_log(
        'VIEW',
        'PLAYLIST',
        'Melihat playlist ID ' . $playlist->id
    );

    return response()->json([
        'success' => true,
        'data' => $playlist->load('songs')
    ], 200);
}

public function update(Request $request, Playlist $playlist)
{
    $playlist->update($request->only('name', 'description'));

    activity_log(
        'UPDATE',
        'PLAYLIST',
        'Update playlist ID ' . $playlist->id
    );

    return response()->json([
        'success' => true,
        'message' => 'Playlist updated',
        'data' => $playlist
    ], 200);
}

public function destroy(Playlist $playlist)
{
    $playlist->delete();

    activity_log(
        'DELETE',
        'PLAYLIST',
        'Hapus playlist: ' . $playlist->name
    );

    return response()->json([
        'success' => true,
        'message' => 'Playlist deleted'
    ], 200);
}

}
