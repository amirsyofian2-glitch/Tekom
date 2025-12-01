<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tower>
 */
class TowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'site_id' => \App\Models\Site::factory(),
            'repeater_type' => fake()->randomElement(['ANALOG', 'DIGITAL']),
            'system' => fake()->randomElement(['VHF', 'UHF']),
            'frequency_rx' => fake()->randomFloat(4, 140, 170),
            'frequency_tx' => fake()->randomFloat(4, 140, 170),
            'site_status' => fake()->randomElement(['OPERASIONAL', 'MAINTENANCE']),
            'tower_structure' => fake()->randomElement(['SST', 'GUY WIRE']),
            'tower_height' => fake()->numberBetween(20, 100),
            'condition_bb' => fake()->numberBetween(1, 5),
            'condition_rr' => fake()->numberBetween(1, 5),
            'condition_rb' => fake()->numberBetween(1, 5),
            'documentation' => null,
            'user' => fake()->name(),
            'notes' => fake()->sentence(),
        ];
    }
}
