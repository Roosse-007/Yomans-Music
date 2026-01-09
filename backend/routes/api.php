<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\SongController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\Api\PlaylistSongController;

Route::prefix('v1')->group(function () {

    /* =====================================================
       PUBLIC ENDPOINT
    ===================================================== */

    Route::get('/ping', fn () => response()->json([
        'status' => 'ok',
        'message' => 'YomansMusic API running',
        'timestamp' => now()
    ]));

    // AUTH
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login',    [AuthController::class, 'login']);

    // DATA PUBLIK (UNTUK FRONTEND)
    Route::get('/artists', [ArtistController::class, 'index']);
    Route::get('/albums',  [AlbumController::class, 'index']);
    Route::get('/songs',   [SongController::class, 'index']);
    Route::get('/songs/artist/{artist}', [SongController::class, 'byArtist']);

    /* =====================================================
       AUTHENTICATED (JWT)
    ===================================================== */
    Route::middleware(['auth:api'])->group(function () {

        /* ===== USER ===== */
        Route::get('/me',     [AuthController::class, 'me']);
        Route::post('/logout',[AuthController::class, 'logout']);

        /* ===== ARTIST ===== */
        Route::post('/artists',               [ArtistController::class, 'store']);
        Route::put('/artists/{artist}',       [ArtistController::class, 'update']);
        Route::delete('/artists/{artist}',    [ArtistController::class, 'destroy']);
        Route::post('/artists/{artist}/photo',[ArtistController::class, 'updatePhoto']);

        /* ===== ALBUM ===== */
        Route::post('/albums',             [AlbumController::class, 'store']);
        Route::put('/albums/{album}',      [AlbumController::class, 'update']);
        Route::delete('/albums/{album}',   [AlbumController::class, 'destroy']);

        /* ===== SONG ===== */
        Route::post('/songs',           [SongController::class, 'store']);
        Route::put('/songs/{song}',     [SongController::class, 'update']);
        Route::delete('/songs/{song}',  [SongController::class, 'destroy']);

        /* ===== GENRE ===== */
        Route::get('/genres',        [GenreController::class, 'index']);
        Route::post('/genres',       [GenreController::class, 'store']);
        Route::put('/genres/{genre}',[GenreController::class, 'update']);
        Route::delete('/genres/{genre}', [GenreController::class, 'destroy']);

        /* ===== PLAYLIST ===== */
        Route::apiResource('playlists', PlaylistController::class);

        /* ===== PLAYLIST SONG ===== */
        Route::post('/playlists/{playlist}/songs',
            [PlaylistSongController::class, 'store']);

        Route::get('/playlists/{playlist}/songs',
            [PlaylistSongController::class, 'songs']);

        Route::delete('/playlists/{playlist}/songs/{song}',
            [PlaylistSongController::class, 'destroy']);

        /* ===== FAVORITE ===== */
        Route::post('/favorites/{song}',
            [PlaylistSongController::class, 'toggleFavorite']);

        Route::get('/favorites',
            [PlaylistSongController::class, 'favorites']);

        Route::get('/favorites/{song}/check',
            [PlaylistSongController::class, 'isFavorited']);

        Route::get('/favorites-playlist',
            [PlaylistSongController::class, 'favoritePlaylist']);
    });
});
