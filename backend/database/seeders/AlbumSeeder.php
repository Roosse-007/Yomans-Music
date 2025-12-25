<?php

namespace Database\Seeders;

use App\Models\Album;
use Illuminate\Database\Seeder;

class AlbumSeeder extends Seeder
{
    public function run(): void
    {
        $albums = [
            ['artist_id' => 1, 'title' => '1989', 'release_year' => 2014],
            ['artist_id' => 2, 'title' => 'A Beautiful Blur', 'release_year' => 2023],
            ['artist_id' => 3, 'title' => 'After Hours', 'release_year' => 2020],
            ['artist_id' => 4, 'title' => 'Parachutes', 'release_year' => 2000],
            ['artist_id' => 5, 'title' => 'Exodus', 'release_year' => 1997],
        ];

        foreach ($albums as $album) {
            Album::create($album);
        }
    }
}
