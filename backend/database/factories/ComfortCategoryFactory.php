<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ComfortCategory>
 */
class ComfortCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = ['Economy', 'Standard', 'Business', 'Premium', 'Luxury'];
        return [
            'name' => $this->faker->unique()->randomElement($names),
            'level' => $this->faker->numberBetween(1, 5),
        ];
    }
}
