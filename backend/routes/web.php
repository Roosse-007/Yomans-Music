<?php

use App\Http\Controllers\Api\SongController;

Route::prefix('v1')->group(function () {
    // Endpoint untuk ambil lagu per artist
    Route::get('/songs/artist/{artistId}', [SongController::class, 'byArtist']);
});