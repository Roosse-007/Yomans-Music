<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Api\AlbumController;
use App\Http\Controllers\Api\SongController;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\PlaylistController;
use App\Http\Controllers\Api\PlaylistSongController;

Route::prefix('v1')->group(function () {

    // Auth
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {

        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::apiResource('artists', ArtistController::class);
        Route::apiResource('albums', AlbumController::class);
        Route::apiResource('songs', SongController::class);
        Route::apiResource('genres', GenreController::class);
        Route::apiResource('playlists', PlaylistController::class);

        // Playlist Songs
        Route::post('/playlists/{playlist}/songs', [PlaylistSongController::class, 'store']);
        Route::delete('/playlists/{playlist}/songs/{song}', [PlaylistSongController::class, 'destroy']);
    });
});
