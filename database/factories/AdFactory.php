<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //
            'name' => fake()->name(),
            'user_id' => 1,
            'category_id' => Category::inRandomOrder()->first()->id,
            'title' => fake()->name(),
            'price' => fake()->numberBetween(100, 10000),
            'status' => $this->faker->randomElement(['pending', 'sold', 'deactive']),
            'start_date' => fake()->dateTimeBetween('now', '+1 week'),
            'end_date'   => fake()->dateTimeBetween('+1 week', '+2 week'),
            'description' => fake()->name(),
            'city_id' => 1,
            'location' => fake()->name(),
        ];
    }
}