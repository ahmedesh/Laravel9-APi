<?php

namespace Database\Seeders;


use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run()
    {
//        Post::factory(10)->create([
//            'title'      => fake()->unique()->title(),
//            'body'     => $this->fake->unique()->address(),
//            'user_id'  => rand(1,10),
//        ]);
//        =======
        Post::factory(10)->create([
            'title' => fake()->unique()->sentence(),
            'body' => fake()->unique()->paragraph(),
            'user_id' => fake()->unique()->numberBetween(1, 10),
        ]);
    }
}
