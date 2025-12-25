<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        $genres = [
            ['name' => 'Pop'],
            ['name' => 'Rock'],
            ['name' => 'Jazz'],
            ['name' => 'Reggae'],
            ['name' => 'EDM'],
            ['name' => 'R&B'],
            ['name' => 'Classical'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
