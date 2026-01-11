<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use Illuminate\Support\Facades\Auth;

class FavoritePageController extends Controller
{
    public function index()
    {
        $playlist = Playlist::where('user_id', Auth::id())
            ->where('name', 'Favorite')
            ->first();

        $favorites = collect();

        if ($playlist) {
            $favorites = $playlist->songs()
                ->with('album.artist')
                ->get()
                ->map(function ($song) {
                    return (object) [
                        'title'     => $song->title,
                        'artist'    => optional($song->album->artist)->name ?? '-',
                        'audio_url' => asset('storage/' . $song->audio_path),
                        'cover'     => $song->album->cover ?? null,
                    ];
                });
        }

        return view('frontend.favorites', compact('favorites'));
    }
}
