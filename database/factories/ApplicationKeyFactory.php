<?php

namespace Database\Factories;

use App\Models\ApplicationKey;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ApplicationKey>
 */
class ApplicationKeyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=>fake()->unique()->name,
            'app-id'=>ApplicationKey::generateAppId(),
            'app-secret'=>ApplicationKey::generateAppSecret(),
            'obsoletd'=>true
        ];
    }
}
