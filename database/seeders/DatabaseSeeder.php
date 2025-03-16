<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Sector;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'user_name' => 'Test User',
            'email' => 'volunteer@example.com',
            'role' => 'volunteer',
        ]);

        User::factory()->create([
            'user_name' => 'Test User',
            'email' => 'organization@example.com',
            'role' => 'organization',
        ]);

        User::factory()->create([
            'user_name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'admin',
        ]);

        City::factory(10)->create();
        Sector::factory(10)->create();
    }
}
