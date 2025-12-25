<?php

namespace Database\Seeders;

use App\Models\Song;
use Illuminate\Database\Seeder;

class SongSeeder extends Seeder
{
    public function run(): void
    {
        $songs = [
            [
                'album_id' => 1,
                'genre_id' => 1,
                'title' => 'Blank Space',
                'duration' => 231,
                'audio_path' => 'songs/blank.mp3',
            ],
            [
                'album_id' => 2,
                'genre_id' => 1,
                'title' => 'XXL',
                'duration' => 233,
                'audio_path' => 'songs/xxl.mp3',
            ],
            [
                'album_id' => 3,
                'genre_id' => 5,
                'title' => 'Blinding Lights',
                'duration' => 200,
                'audio_path' => 'songs/blinding.mp3',
            ],
            [
                'album_id' => 4,
                'genre_id' => 2,
                'title' => 'Yellow',
                'duration' => 269,
                'audio_path' => 'songs/yellow.mp3',
            ],
            [
                'album_id' => 5,
                'genre_id' => 6,
                'title' => 'One Love',
                'duration' => 227,
                'audio_path' => 'songs/onelove.mp3',
            ],
        ];

        foreach ($songs as $song) {
            Song::create($song);
        }
    }
}
