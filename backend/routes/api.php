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

    // PUBLIC
    Route::get('/ping', fn() => response()->json([
        'status'=>'ok', 'message'=>'YomansMusic API running', 'timestamp'=>now()
    ]));

    Route::post('/register', [AuthController::class,'register']);
    Route::post('/login', [AuthController::class,'login']);

    // Public data for frontend
    Route::get('/artists', [ArtistController::class,'index']);
    Route::get('/albums', [AlbumController::class,'index']);
    Route::get('/songs', [SongController::class,'index']);
    Route::get('/songs/artist/{artistId}', [SongController::class,'byArtist']);

    // Authenticated routes
     Route::middleware('auth:api')->group(function () {
        Route::get('/me', [AuthController::class, 'me']);
        Route::post('/logout', [AuthController::class, 'logout']);

        Route::apiResource('artists', ArtistController::class)->except(['index','show']);
        Route::apiResource('albums', AlbumController::class)->except(['index','show']);
        Route::apiResource('songs', SongController::class)->except(['index','show']);
        Route::apiResource('genres', GenreController::class);
        Route::apiResource('playlists', PlaylistController::class);

        Route::post('/playlists/{playlist}/songs', [PlaylistSongController::class,'store']);
        Route::delete('/playlists/{playlist}/songs/{song}', [PlaylistSongController::class,'destroy']);
    });
});