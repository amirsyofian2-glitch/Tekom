<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Inventory>
 */
class InventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'asset_code' => 'ALK-' . now()->year . '-' . fake()->unique()->numberBetween(1000, 9999),
            'organization_id' => \App\Models\Organization::factory(),
            'site_id' => \App\Models\Site::factory(),
            'equipment_type_id' => \App\Models\EquipmentType::factory(),
            'serial_number' => fake()->bothify('SN-####-????'),
            'installation_year' => fake()->numberBetween(2015, 2025),
            'condition' => fake()->randomElement(['BB', 'RR', 'RB']),
            'quantity' => fake()->numberBetween(1, 50),
            'purchase_price' => fake()->randomFloat(2, 1000000, 50000000),
            'last_maintenance' => fake()->dateTimeBetween('-1 year', 'now'),
            'next_maintenance' => fake()->dateTimeBetween('now', '+6 months'),
            'notes' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
