<?php

namespace Database\Seeders;

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
            'username' => 'Admin',
            'email' => 'pinoaj7@gmail.com',
            'password' => 'Skadi_077_XT',
            'is_admin' => true
        ]);

        $this->call(CharacterSeeder::class);
    }
}
