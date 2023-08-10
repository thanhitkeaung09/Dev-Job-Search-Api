<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => "Dev Job Search Admin",
            "image" => fake()->imageUrl(),
            "email" => 'dev-job-search-admin@gmail.com',
            "password" => Hash::make("admin1234")
        ];
    }
}
