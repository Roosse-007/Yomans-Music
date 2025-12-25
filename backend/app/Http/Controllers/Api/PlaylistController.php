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
        return Auth::user()->playlists()->with('songs')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);

        return Auth::user()->playlists()->create($data);
    }

    public function show(Playlist $playlist)
    {
        $this->authorize('view', $playlist);
        return $playlist->load('songs');
    }

    public function update(Request $request, Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        $playlist->update($request->only('name', 'description'));
        return $playlist;
    }

    public function destroy(Playlist $playlist)
    {
        $this->authorize('delete', $playlist);
        $playlist->delete();

        return response()->json(['message' => 'Playlist deleted']);
    }
}
