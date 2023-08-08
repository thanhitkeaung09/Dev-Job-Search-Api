<?php

namespace Database\Factories;

use App\Models\Company;
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
            "company_id" => Company::pluck('id')->random(),
            "salary" => fake()->randomNumber(),
            "candidates" => fake()->randomNumber()
        ];
    }
}
