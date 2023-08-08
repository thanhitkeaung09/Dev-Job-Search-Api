<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name"=>fake()->name(),
            "email"=>fake()->email(),
            "hotline"=>fake()->phoneNumber(),
            "location" => fake()->address(),
            "image"=>fake()->imageUrl(),
            "website"=>fake()->url(),
            "description" => fake()->paragraph()
        ];
    }
}
