<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Book;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //\App\Models\User::factory(2)->create();

        Book::factory(10)->create();

        \App\Models\User::factory()->create([
            'username' => fake()->userName(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'sss123',
            'remember_token' => fake()->text(10),
        ]);

        \App\Models\User::factory()->create([
            'username' => fake()->userName(),
            'email' => fake()->safeEmail(),
            'email_verified_at' => now(),
            'password' => 'abc123',
            'remember_token' => fake()->text(10),
        ]);
    }
}
