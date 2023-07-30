<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "position" => fake()->title,
            "shift" => fake()->randomElement([1,0]),
            "country" => fake()->title,
            "job_description" => fake()->paragraph(),
            "requirement" => fake()->paragraph(),
            "responsibilities" => fake()->paragraph(),
            "company" => fake()->title,
            "company_image"=> fake()->imageUrl(),
            "company_website" => fake()->url()
        ];
    }
}
