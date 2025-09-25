<?php

namespace Database\Factories;

use App\Models\ComfortCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarModel>
 */
class CarModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $brands = ['Toyota', 'BMW', 'Mercedes', 'Audi', 'Volkswagen', 'Ford'];
        $models = ['Sedan', 'Hatchback', 'SUV', 'Coupe', 'Wagon'];

        return [
            'brand' => $this->faker->randomElement($brands),
            'model' => $this->faker->randomElement($models),
            'comfort_category_id' => ComfortCategory::factory(),
        ];
    }
}
