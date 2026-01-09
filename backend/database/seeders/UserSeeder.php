<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // ADMIN
        User::updateOrCreate(
            ['email' => 'adminym@gmail.com'],
            [
                'name' => 'Admin Yomans',
                'password' => Hash::make('adminym123'),
                'role' => 'admin',
            ]
        );

        // USER BIASA
        User::updateOrCreate(
            ['email' => 'bigboss@gmail.com'],
            [
                'name' => 'Big Boss',
                'password' => Hash::make('bigboss123'),
                'role' => 'user',
            ]
        );
    }
}
