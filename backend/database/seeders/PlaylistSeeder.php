<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Playlist; // ✅ INI YANG KURANG

class PlaylistSeeder extends Seeder
{
    public function run(): void
    {
        Playlist::create([
            'user_id' => 1,
            'name' => 'My Favorite Songs',
            'description' => 'Seeder playlist example'
        ]);
    }
}
