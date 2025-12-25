<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\SongController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\PlaylistController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Semua endpoint API project Yomans Music
| Prefix otomatis: /api
*/

Route::get('/ping', function () {
    return response()->json([
        'status' => 'OK',
        'message' => 'Yomans Music API is running'
    ]);
});

/* ===== RESOURCE ROUTES ===== */

Route::apiResource('artists', ArtistController::class);
Route::apiResource('albums', AlbumController::class);
Route::apiResource('songs', SongController::class);
Route::apiResource('genres', GenreController::class);
Route::apiResource('playlists', PlaylistController::class);
