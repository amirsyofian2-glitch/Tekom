<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Organization>
 */
class OrganizationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => 'ORG' . fake()->unique()->numberBetween(1000, 9999),
            'name' => fake()->company(),
            'type' => fake()->randomElement(['POLDA', 'POLRESTA', 'POLRES', 'POLSEK', 'SATUAN', 'BIDANG']),
            'parent_id' => null,
            'address' => fake()->address(),
            'is_active' => true,
        ];
    }
}
