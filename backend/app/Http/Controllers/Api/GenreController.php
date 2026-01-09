<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        activity_log(
            'VIEW',
            'GENRE',
            'Melihat daftar genre'
        );

        return response()->json([
            'success' => true,
            'data' => Genre::all()
        ], 200);
    }

    public function store(Request $request)
    {
        $genre = Genre::create(
            $request->validate(['name' => 'required|string'])
        );

        activity_log(
            'CREATE',
            'GENRE',
            'Menambahkan genre: ' . $genre->name
        );

        return response()->json([
            'success' => true,
            'message' => 'Genre created',
            'data' => $genre
        ], 201);
    }

    public function show(Genre $genre)
    {
        activity_log(
            'VIEW',
            'GENRE',
            'Melihat genre ID ' . $genre->id
        );

        return response()->json([
            'success' => true,
            'data' => $genre
        ], 200);
    }

    public function update(Request $request, Genre $genre)
    {
        $genre->update($request->only('name'));

        activity_log(
            'UPDATE',
            'GENRE',
            'Update genre ID ' . $genre->id
        );

        return response()->json([
            'success' => true,
            'message' => 'Genre updated',
            'data' => $genre
        ], 200);
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        activity_log(
            'DELETE',
            'GENRE',
            'Hapus genre: ' . $genre->name
        );

        return response()->json([
            'success' => true,
            'message' => 'Genre deleted'
        ], 200);
    }
}
