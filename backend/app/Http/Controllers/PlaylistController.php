<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index()
    {
        return Playlist::all();
    }

    public function store(Request $request)
    {
        return Playlist::create(
            $request->validate([
                'name' => 'required',
                'description' => 'nullable'
            ])
        );
    }

    public function show(Playlist $playlist)
    {
        return $playlist;
    }

    public function update(Request $request, Playlist $playlist)
    {
        $playlist->update($request->all());
        return $playlist;
    }

    public function destroy(Playlist $playlist)
    {
        $playlist->delete();
        return response()->json(['message' => 'Playlist deleted']);
    }
}
