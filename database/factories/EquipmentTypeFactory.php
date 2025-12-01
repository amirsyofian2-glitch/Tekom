<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EquipmentType>
 */
class EquipmentTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'category' => fake()->randomElement(['REPEATER', 'ANTENNA', 'POWER', 'ACCESSORY']),
            'brand' => fake()->company(),
            'specifications' => fake()->sentence(),
            'warranty_months' => fake()->numberBetween(12, 36),
            'is_active' => true,
        ];
    }
}
