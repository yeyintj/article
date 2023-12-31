<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\Article::factory(30)->create();
        \App\Models\Category::factory(5)->create();
        \App\Models\Comment::factory(10)->create();
        \App\Models\Like::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Alice',
            'email' => 'alice@gmail.com',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Bob',
            'email' => 'bob@gmail.com',
        ]);
    }
}
