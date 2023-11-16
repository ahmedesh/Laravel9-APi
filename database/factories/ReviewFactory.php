<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
   public function UserId(){
       User::all()->get('id');
   }
    public function ProductId(){
        Product::all()->get('id');
    }
    public function definition()
    {
        return [
            "user_id" => fake()->numberBetween(1,10),
            "product_id" => fake()->numberBetween(1,10), // function(){Product::all()->random();},
            "review" => fake()->paragraph,
            "star" => fake()->numberBetween(0,5),
        ];
    }
}
