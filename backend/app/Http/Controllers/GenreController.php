<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        return response()->json(Genre::all(), 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $genre = Genre::create($validated);

        return response()->json($genre, 201);
    }

    public function show(Genre $genre)
    {
        return response()->json($genre, 200);
    }

    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $genre->update($validated);

        return response()->json($genre, 200);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        return response()->json([
            'message' => 'Genre deleted successfully'
        ], 200);
    }
}
