<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'admin',
            'password' => Hash::make('admin123'), // login: admin / admin123
            'role' => 'admin',
        ]);

        // User biasa
        User::create([
            'name' => 'user',
            'password' => Hash::make('user123'), // login: user / user123
            'role' => 'user',
        ]);
    }
}
