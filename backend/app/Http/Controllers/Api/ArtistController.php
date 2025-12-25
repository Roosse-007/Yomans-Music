<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ArtistController extends Controller
{
    /**
     * Display a listing of artists.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Artist::all()
        ], 200);
    }

    /**
     * Store a newly created artist.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio'  => 'nullable|string'
        ]);

        $artist = Artist::create($validated);

        Log::info('Artist created', [
            'user_id'   => auth()->id(),
            'artist_id' => $artist->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Artist created successfully',
            'data'    => $artist
        ], 201);
    }

    /**
     * Display the specified artist.
     */
    public function show(Artist $artist)
    {
        return response()->json([
            'success' => true,
            'data'    => $artist
        ], 200);
    }

    /**
     * Update the specified artist.
     */
    public function update(Request $request, Artist $artist)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'bio'  => 'nullable|string'
        ]);

        $artist->update($validated);

        Log::info('Artist updated', [
            'user_id'   => auth()->id(),
            'artist_id' => $artist->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Artist updated successfully',
            'data'    => $artist
        ], 200);
    }

    /**
     * Remove the specified artist.
     */
    public function destroy(Artist $artist)
    {
        $artist->delete();

        Log::info('Artist deleted', [
            'user_id'   => auth()->id(),
            'artist_id' => $artist->id
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Artist deleted successfully'
        ], 200);
    }

    /**
     * Get albums by artist.
     */
    public function albums(Artist $artist)
    {
        return response()->json([
            'success' => true,
            'data'    => $artist->albums()->with('songs')->get()
        ], 200);
    }
}
