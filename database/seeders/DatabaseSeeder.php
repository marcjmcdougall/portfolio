<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Article;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 50 random users.
        User::factory(50)->create();
        $users = User::all()->shuffle();

        // Create 100 articles, and randomly assign them to a users.
        Article::factory(100)->create([
            'user_id' => $users->random()->id
        ]);

        // for($i = 0; $i < 100; $i++){
        //     Article::factory()->create([
        //         'user_id' => $users->random()->id
        //     ]);
        // }

        // Create five more jobs job, and assign it to the default test user.
        Article::factory(5)->create([
            'user_id' => 1,
        ]);
    }
}
