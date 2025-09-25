<?php

namespace Database\Factories;

use App\Models\CarModel;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'registration_number' => strtoupper($this->faker->unique()->bothify('?? ### ??')),
            'model_id' => CarModel::factory(),
            'driver_id' => User::factory(),
        ];
    }
}
