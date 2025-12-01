<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Seed untuk membuat user testing
     */
    public function run(): void
    {
        // Buat role admin jika belum ada
        $adminRole = Role::firstOrCreate(
            ['slug' => 'admin'],
            ['name' => 'Administrator', 'description' => 'Full access']
        );

        // Buat user admin untuk testing
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin Test',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Assign role admin
        if (!$adminUser->hasRole($adminRole)) {
            $adminUser->assignRole($adminRole);
        }

        // Buat dan assign semua permissions ke admin
        $permissions = [
            ['slug' => 'view-users', 'name' => 'View Users', 'description' => 'Can view users'],
            ['slug' => 'create-users', 'name' => 'Create Users', 'description' => 'Can create users'],
            ['slug' => 'edit-users', 'name' => 'Edit Users', 'description' => 'Can edit users'],
            ['slug' => 'delete-users', 'name' => 'Delete Users', 'description' => 'Can delete users'],
            ['slug' => 'view-organizations', 'name' => 'View Organizations', 'description' => 'Can view organizations'],
            ['slug' => 'create-organizations', 'name' => 'Create Organizations', 'description' => 'Can create organizations'],
            ['slug' => 'edit-organizations', 'name' => 'Edit Organizations', 'description' => 'Can edit organizations'],
            ['slug' => 'delete-organizations', 'name' => 'Delete Organizations', 'description' => 'Can delete organizations'],
            ['slug' => 'view-sites', 'name' => 'View Sites', 'description' => 'Can view sites'],
            ['slug' => 'create-sites', 'name' => 'Create Sites', 'description' => 'Can create sites'],
            ['slug' => 'edit-sites', 'name' => 'Edit Sites', 'description' => 'Can edit sites'],
            ['slug' => 'delete-sites', 'name' => 'Delete Sites', 'description' => 'Can delete sites'],
            ['slug' => 'view-towers', 'name' => 'View Towers', 'description' => 'Can view towers'],
            ['slug' => 'create-towers', 'name' => 'Create Towers', 'description' => 'Can create towers'],
            ['slug' => 'edit-towers', 'name' => 'Edit Towers', 'description' => 'Can edit towers'],
            ['slug' => 'delete-towers', 'name' => 'Delete Towers', 'description' => 'Can delete towers'],
            ['slug' => 'view-inventories', 'name' => 'View Inventories', 'description' => 'Can view inventories'],
            ['slug' => 'create-inventories', 'name' => 'Create Inventories', 'description' => 'Can create inventories'],
            ['slug' => 'edit-inventories', 'name' => 'Edit Inventories', 'description' => 'Can edit inventories'],
            ['slug' => 'delete-inventories', 'name' => 'Delete Inventories', 'description' => 'Can delete inventories'],
        ];

        foreach ($permissions as $permData) {
            $permission = Permission::firstOrCreate(
                ['slug' => $permData['slug']],
                ['name' => $permData['name'], 'description' => $permData['description']]
            );
            
            if (!$adminRole->permissions()->where('permissions.id', $permission->id)->exists()) {
                $adminRole->permissions()->attach($permission);
            }
        }

        // Buat user biasa untuk testing
        $normalUser = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User Test',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );
    }
}
