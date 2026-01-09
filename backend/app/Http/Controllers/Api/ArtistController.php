<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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

        activity_log(
    'CREATE',
    'ARTIST',
    'Menambahkan artist: ' . $artist->name
);


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
    public function update(Request $request, \App\Models\Artist $artist)
{
    $validated = $request->validate([
        'name'  => 'sometimes|required|string|max:255',
        'bio'   => 'nullable|string',
        'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // jika ada foto baru
    if ($request->hasFile('photo')) {

        // hapus foto lama
        if ($artist->photo && \Storage::disk('public')->exists($artist->photo)) {
            \Storage::disk('public')->delete($artist->photo);
        }

        // simpan foto baru
        $path = $request->file('photo')->store('artists', 'public');
        $validated['photo'] = $path;
    }

    $artist->update($validated);

    activity_log(
    'UPDATE',
    'ARTIST',
    'Update artist ID ' . $artist->id
);


    return response()->json([
        'success' => true,
        'message' => 'Artist updated successfully',
        'data'    => [
            'id'        => $artist->id,
            'name'      => $artist->name,
            'bio'       => $artist->bio,
            'photo'     => $artist->photo,
            'photo_url' => $artist->photo
                ? asset('storage/' . $artist->photo)
                : null
        ]
    ]);
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

        activity_log(
    'DELETE',
    'ARTIST',
    'Hapus artist: ' . $artist->name
);


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

    /* =====================================================
       🔥 TAMBAHAN: UPDATE FOTO ARTIST (ADMIN)
       TIDAK MENGUBAH METHOD LAMA
    ===================================================== */
    public function updatePhoto(Request $request, Artist $artist)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // hapus foto lama jika ada
        if ($artist->photo && Storage::disk('public')->exists($artist->photo)) {
            Storage::disk('public')->delete($artist->photo);
        }

        // simpan foto baru
        $path = $request->file('photo')->store('artists', 'public');

        $artist->update([
            'photo' => $path
        ]);

        Log::info('Artist photo updated', [
            'user_id'   => auth()->id(),
            'artist_id' => $artist->id,
            'photo'     => $path
        ]);

        activity_log(
    'UPDATE_PHOTO',
    'ARTIST',
    'Update foto artist ID ' . $artist->id
);


        return response()->json([
            'success' => true,
            'message' => 'Artist photo updated successfully',
            'data'    => $artist
        ], 200);
    }
}
