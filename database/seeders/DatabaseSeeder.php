<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         \App\Models\User::factory(10)->create();

        $this->call(UserSeeder::class); // لازم استدعي ال seeder دا هنا عشان تتبعت للداتابيز من غيره مش هتتبعت للداتابيز

        $this->call(PostSeeder::class); // لازم استدعي ال seeder دا هنا عشان تتبعت للداتابيز من غيره مش هتتبعت للداتابيز

        $this->call(ProductSeeder::class); // لازم استدعي ال seeder دا هنا عشان تتبعت للداتابيز من غيره مش هتتبعت للداتابيز

        $this->call(ReviewSeeder::class); // لازم استدعي ال seeder دا هنا عشان تتبعت للداتابيز من غيره مش هتتبعت للداتابيز


//         \App\Models\User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);
    }
}
