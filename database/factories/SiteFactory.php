<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Site>
 */
class SiteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id' => \App\Models\Organization::factory(),
            'name' => fake()->city() . ' Site',
            'region' => fake()->state(),
            'location' => fake()->address(),
            'ownership' => fake()->randomElement(['POLRI', 'TELKOM', 'TVRI', 'INDOSAT', 'SWASTA', 'LAINNYA']),
            'tower_height' => fake()->numberBetween(20, 100),
            'latitude' => fake()->latitude(-10, 5),
            'longitude' => fake()->longitude(95, 140),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
