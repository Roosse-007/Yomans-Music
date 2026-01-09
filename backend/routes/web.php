<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\ArtistController;
use App\Http\Controllers\Admin\ArtistController as AdminArtistController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\Admin\AlbumController;

use App\Models\Artist;
use App\Models\Song;
use App\Models\Album;
use App\Models\Genre;



Log::info('LOG TEST: web.php loaded');
/* =========================
   HALAMAN PUBLIK
========================= */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', fn () => view('frontend.login'))->name('login');
Route::get('/register', fn () => view('frontend.register'))->name('register');

/* =========================
   REGISTER
========================= */
Route::post('/register', function (Request $request) {

    $request->validate([
        'username' => 'required',
        'email'    => 'required|email|unique:users',
        'password' => 'required|min:4',
    ]);

    User::create([
        'name'     => $request->username,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect('/login')->with('success', 'Akun berhasil dibuat');
});

/* =========================
   LOGIN (SESSION)
========================= */
Route::post('/login', function (Request $request) {

    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::guard('web')->attempt($credentials)) {

        $request->session()->regenerate();
        $user = Auth::guard('web')->user();

        // 🔥 INI KUNCINYA
        if ($user->role === 'admin') {
            return redirect('/admin')
                ->with('success', 'Selamat datang Admin 👑');
        }

        return redirect('/')
            ->with('success', 'Login berhasil. Selamat datang, ' . $user->name . ' 👋');
    }

    return back()->with('error', 'Email atau password salah');
});


Route::middleware(['auth:web', 'admin'])
    ->prefix('admin')
    ->group(function () {

     Route::get('/artists/create', function () {
        return view('admin.create-artist');
    })->name('admin.artists.create');

    // SIMPAN ARTIS
    Route::post('/artists', [AdminArtistController::class, 'store'])
        ->name('admin.artists.store');

    // FORM EDIT ARTIS
    Route::get('/artists/{artist}/edit', [AdminArtistController::class, 'edit'])
        ->name('admin.artists.edit');

    // UPDATE ARTIS
    Route::put('/artists/{artist}', [AdminArtistController::class, 'update'])
        ->name('admin.artists.update');

    // HAPUS ARTIS + LAGU + FILE
    Route::delete('/artists/{artist}', function (\App\Models\Artist $artist) {

    // pastikan relasi di-load sebagai collection
    $artist->load('albums.songs');

    foreach ($artist->albums ?? [] as $album) {

        foreach ($album->songs ?? [] as $song) {

            if ($song->audio_path && Storage::disk('public')->exists($song->audio_path)) {
                Storage::disk('public')->delete($song->audio_path);
            }

            $song->delete();
        }

        $album->delete();
    }

    // hapus foto artis
    if ($artist->photo && Storage::disk('public')->exists($artist->photo)) {
        Storage::disk('public')->delete($artist->photo);
    }

    $artist->delete();

    return redirect('/admin')
        ->with('success', 'Artis dan seluruh lagunya berhasil dihapus');
})->name('admin.artists.destroy');

    /* =========================
       DASHBOARD ADMIN
    ========================= */
    Route::get('/', function () {
        return view('admin.dashboard', [
            'artists' => Artist::all(),
             'albums'  => Album::with('artist')->get()
        ]);
    })->name('admin.dashboard');

    // FORM TAMBAH ALBUM
    Route::get('/artists/{artist}/albums/create',
        [\App\Http\Controllers\Admin\AlbumController::class, 'create'])
        ->name('admin.albums.create');

    Route::post('/artists/{artist}/albums',
        [\App\Http\Controllers\Admin\AlbumController::class, 'store'])
        ->name('admin.albums.store');

        // DETAIL ARTIST + ALBUM
Route::get('/artists/{artist}', function (Artist $artist) {
    $artist->load('albums');

    return view('admin.artist-show', compact('artist'));
})->name('admin.artists.show');

// FORM EDIT ALBUM
Route::get('/albums/{album}/edit',
    [\App\Http\Controllers\Admin\AlbumController::class, 'edit'])
    ->name('admin.albums.edit');

// UPDATE ALBUM
Route::put('/albums/{album}',
    [\App\Http\Controllers\Admin\AlbumController::class, 'update'])
    ->name('admin.albums.update');


// HAPUS ALBUM
Route::delete('/albums/{album}', function (\App\Models\Album $album) {

    // load relasi lagu
    $album->load('songs');

    // hapus lagu + file audio
    foreach ($album->songs as $song) {
        if ($song->audio_path && Storage::disk('public')->exists($song->audio_path)) {
            Storage::disk('public')->delete($song->audio_path);
        }
        $song->delete();
    }

    // hapus cover album
    if ($album->cover && Storage::disk('public')->exists($album->cover)) {
        Storage::disk('public')->delete($album->cover);
    }

    $album->delete();

    return back()->with('success', 'Album berhasil dihapus');
})->name('admin.albums.destroy');


    /* =========================
       SONG MANAGEMENT
    ========================= */

    // LIST LAGU
    Route::get('/songs', function () {
        return view('admin.songs-index', [
            'songs' => Song::with(['album.artist', 'genre'])->get()
        ]);
    })->name('admin.songs.index');

    // FORM TAMBAH LAGU
    Route::get('/songs/create', function () {
        return view('admin.create-song', [
            'artists' => Artist::all(),
            'albums'  => \App\Models\Album::with('artist')->get(),
            'genres'  => Genre::all()
        ]);
    })->name('admin.songs.create');

    // SIMPAN LAGU
    Route::post('/songs', function (Request $request) {

    $request->validate([
        'title'     => 'required',
        'album_id'  => 'required|exists:albums,id',
        'genre_id'  => 'required|exists:genres,id',
        'audio'     => 'required|mimes:mp3,wav',
    ]);

    $path = $request->file('audio')->store('songs', 'public');

    \App\Models\Song::create([
        'title'      => $request->title,
        'album_id'   => $request->album_id,
        'genre_id'   => $request->genre_id,
        'duration'   => 0, // aman
        'audio_path' => $path,
    ]);

    return redirect()
        ->route('admin.songs.index')
        ->with('success', 'Lagu berhasil ditambahkan');
})->name('admin.songs.store');


    // HAPUS LAGU
    Route::delete('/songs/{song}', function (Song $song) {

        if ($song->audio_path && Storage::disk('public')->exists($song->audio_path)) {
            Storage::disk('public')->delete($song->audio_path);
        }

        $song->delete();

        return redirect()
            ->route('admin.songs.index')
            ->with('success', 'Lagu berhasil dihapus');

    })->name('admin.songs.destroy');

    /* =========================
       ARTIST MANAGEMENT
    ========================= */

    // FORM TAMBAH ARTIS
   

});

/* =========================
   PROTECTED AREA
========================= */
Route::middleware('auth:web')->group(function () {

    Route::get('/favorites', fn () => view('frontend.favorites'))
        ->name('favorites');

    Route::get('/account', fn () => view('frontend.account'))
        ->name('account');

    Route::post('/logout', function (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    });

    /* =========================
       UPDATE PHOTO PROFILE
    ========================= */
    Route::post('/account/update-photo', function (Request $request) {

        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = auth()->user();

        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }

        $path = $request->file('photo')->store('profile', 'public');

        $user->update([
            'photo' => $path
        ]);

        return back()->with('success', 'Foto profil berhasil diperbarui');
    });
});

/* ======================================================
   FAVORITE SYSTEM (SESSION AUTH)
====================================================== */
Route::middleware('auth:web')->prefix('web')->group(function () {

    Route::get('/favorites/list', function () {

        $playlist = auth()->user()
            ->playlists()
            ->where('name', 'Favorite')
            ->with(['songs.album.artist'])
            ->first();

        if (!$playlist) {
            return response()->json([]);
        }

        return response()->json(
            $playlist->songs->map(fn ($song) => [
                'id' => $song->id,
                'title' => $song->title,
                'audio_path' => $song->audio_path,
                'artist_name' => optional($song->album->artist)->name,
            ])
        );
    });

    Route::post('/favorites/toggle/{song}', function ($songId) {

        $playlist = auth()->user()
            ->playlists()
            ->firstOrCreate(['name' => 'Favorite']);

        if ($playlist->songs()->where('song_id', $songId)->exists()) {
            $playlist->songs()->detach($songId);
            return response()->json(['favorited' => false]);
        }

        $playlist->songs()->attach($songId);
        return response()->json(['favorited' => true]);
    });

    Route::post('/favorites/remove/{song}', function ($songId) {

        $playlist = auth()->user()
            ->playlists()
            ->where('name', 'Favorite')
            ->firstOrFail();

        $playlist->songs()->detach($songId);

        return response()->json(['success' => true]);
    });
});


use Illuminate\Support\Facades\DB;

Route::get('/test-activity', function () {
    DB::table('activity_logs')->insert([
        'user_id' => auth()->id(),
        'action' => 'TEST',
        'model' => 'System',
        'model_id' => null,
        'description' => 'Test insert activity log',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return 'OK';
});