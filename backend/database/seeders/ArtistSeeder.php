<?php

namespace Database\Seeders;

use App\Models\Artist;
use Illuminate\Database\Seeder;

class ArtistSeeder extends Seeder
{
    public function run(): void
    {
        $artists = [
            ['name' => 'Taylor Swift'],
            ['name' => 'LANY'],
            ['name' => 'The Weeknd'],
            ['name' => 'Coldplay'],
            ['name' => 'Bob Marley'],
        ];

        foreach ($artists as $artist) {
            Artist::create($artist);
        }
    }
}
