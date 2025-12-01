<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Create Permissions
        $permissions = [
            // User Management
            'view_users' => 'Melihat daftar pengguna',
            'create_users' => 'Membuat pengguna baru',
            'edit_users' => 'Mengedit pengguna',
            'delete_users' => 'Menghapus pengguna',
            
            // Role Management
            'view_roles' => 'Melihat daftar peran',
            'create_roles' => 'Membuat peran baru',
            'edit_roles' => 'Mengedit peran',
            'delete_roles' => 'Menghapus peran',
            
            // Permission Management
            'view_permissions' => 'Melihat daftar izin',
            'create_permissions' => 'Membuat izin baru',
            'edit_permissions' => 'Mengedit izin',
            'delete_permissions' => 'Menghapus izin',
            
            // Organization Management
            'view_organizations' => 'Melihat daftar organisasi',
            'create_organizations' => 'Membuat organisasi baru',
            'edit_organizations' => 'Mengedit organisasi',
            'delete_organizations' => 'Menghapus organisasi',
            
            // Site Management
            'view_sites' => 'Melihat daftar site',
            'create_sites' => 'Membuat site baru',
            'edit_sites' => 'Mengedit site',
            'delete_sites' => 'Menghapus site',
            
            // Tower Management
            'view_towers' => 'Melihat daftar tower',
            'create_towers' => 'Membuat tower baru',
            'edit_towers' => 'Mengedit tower',
            'delete_towers' => 'Menghapus tower',
            
            // Equipment Type Management
            'view_equipment_types' => 'Melihat daftar tipe peralatan',
            'create_equipment_types' => 'Membuat tipe peralatan baru',
            'edit_equipment_types' => 'Mengedit tipe peralatan',
            'delete_equipment_types' => 'Menghapus tipe peralatan',
            
            // Inventory Management
            'view_inventories' => 'Melihat daftar inventaris',
            'create_inventories' => 'Membuat inventaris baru',
            'edit_inventories' => 'Mengedit inventaris',
            'delete_inventories' => 'Menghapus inventaris',
            
            // User Activity
            'view_user_activities' => 'Melihat aktivitas pengguna',
            
            // Reports
            'view_reports' => 'Melihat laporan',
            'export_reports' => 'Ekspor laporan',
        ];

        $createdPermissions = [];
        foreach ($permissions as $name => $description) {
            $createdPermissions[$name] = Permission::firstOrCreate(
                ['name' => $name],
                ['description' => $description]
            );
        }

        // Create Roles
        $superAdmin = Role::firstOrCreate(
            ['name' => 'Super Admin'],
            ['description' => 'Akses penuh ke semua fitur sistem']
        );

        $admin = Role::firstOrCreate(
            ['name' => 'Admin'],
            ['description' => 'Administrator dengan akses terbatas']
        );

        $operator = Role::firstOrCreate(
            ['name' => 'Operator'],
            ['description' => 'Operator untuk manajemen inventaris']
        );

        $viewer = Role::firstOrCreate(
            ['name' => 'Viewer'],
            ['description' => 'Hanya dapat melihat data']
        );

        // Assign all permissions to Super Admin
        $superAdmin->permissions()->sync(array_values(array_map(fn($p) => $p->id, $createdPermissions)));

        // Assign permissions to Admin
        $adminPermissions = [
            'view_users', 'create_users', 'edit_users',
            'view_roles', 'view_permissions',
            'view_organizations', 'create_organizations', 'edit_organizations', 'delete_organizations',
            'view_sites', 'create_sites', 'edit_sites', 'delete_sites',
            'view_towers', 'create_towers', 'edit_towers', 'delete_towers',
            'view_equipment_types', 'create_equipment_types', 'edit_equipment_types', 'delete_equipment_types',
            'view_inventories', 'create_inventories', 'edit_inventories', 'delete_inventories',
            'view_user_activities',
            'view_reports', 'export_reports',
        ];
        $admin->permissions()->sync(array_map(fn($name) => $createdPermissions[$name]->id, $adminPermissions));

        // Assign permissions to Operator
        $operatorPermissions = [
            'view_organizations',
            'view_sites', 'create_sites', 'edit_sites',
            'view_towers', 'create_towers', 'edit_towers',
            'view_equipment_types',
            'view_inventories', 'create_inventories', 'edit_inventories',
            'view_reports',
        ];
        $operator->permissions()->sync(array_map(fn($name) => $createdPermissions[$name]->id, $operatorPermissions));

        // Assign permissions to Viewer
        $viewerPermissions = [
            'view_organizations',
            'view_sites',
            'view_towers',
            'view_equipment_types',
            'view_inventories',
            'view_reports',
        ];
        $viewer->permissions()->sync(array_map(fn($name) => $createdPermissions[$name]->id, $viewerPermissions));

        // Assign Super Admin role to existing admin users
        $adminUsers = User::whereIn('email', ['admin@gmail.com', 'superadmin@gmail.com'])->get();
        foreach ($adminUsers as $user) {
            $user->roles()->syncWithoutDetaching([$superAdmin->id]);
        }

        $this->command->info('Roles and Permissions seeded successfully!');
    }
}
