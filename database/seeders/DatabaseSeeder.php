<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Super Admin
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'), // Ganti password sesuai kebutuhan
        ]);
        
        // Seed ALKOM data from HTML file - comprehensive data
        $this->call([
            OrganizationSeeder::class,
            SiteTowerSeeder::class,
            EquipmentTypeSeeder::class,
            InventorySeeder::class,
        ]);
    }
}
