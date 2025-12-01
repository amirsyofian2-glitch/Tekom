<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Tests\TestCase;

/**
 * Black Box Testing - Pengujian Role & Permission
 * Teknik: Business Logic Testing
 */
class RolePermissionBlackBoxTest extends TestCase
{
    private User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminUser = User::where('email', 'admin@gmail.com')->first();
    }

    /**
     * Test 1: Role dapat dibuat
     */
    public function test_role_can_be_created(): void
    {
        $role = Role::create([
            'name' => 'Manager',
            'slug' => 'manager',
            'description' => 'Manager role',
        ]);

        $this->assertDatabaseHas('roles', [
            'name' => 'Manager',
            'slug' => 'manager',
        ]);
    }

    /**
     * Test 2: Permission dapat dibuat
     */
    public function test_permission_can_be_created(): void
    {
        $permission = Permission::create([
            'name' => 'View Reports',
            'slug' => 'view-reports',
            'description' => 'Can view reports',
        ]);

        $this->assertDatabaseHas('permissions', [
            'name' => 'View Reports',
            'slug' => 'view-reports',
        ]);
    }

    /**
     * Test 3: User dapat di-assign role
     */
    public function test_user_can_be_assigned_role(): void
    {
        $user = User::factory()->create();
        $role = Role::create([
            'name' => 'Editor',
            'slug' => 'editor',
        ]);

        $user->assignRole($role);

        $this->assertTrue($user->hasRole('editor'));
    }

    /**
     * Test 4: User dapat di-assign permission
     */
    public function test_user_can_be_assigned_permission(): void
    {
        $user = User::factory()->create();
        $permission = Permission::create([
            'name' => 'Edit Content',
            'slug' => 'edit-content',
        ]);

        $user->givePermissionTo($permission);

        $this->assertTrue($user->hasPermission('edit-content'));
    }

    /**
     * Test 5: Role dapat di-remove dari user
     */
    public function test_role_can_be_removed_from_user(): void
    {
        $user = User::factory()->create();
        $role = Role::create([
            'name' => 'Temporary',
            'slug' => 'temporary',
        ]);

        $user->assignRole($role);
        $this->assertTrue($user->hasRole('temporary'));

        $user->removeRole($role);
        $this->assertFalse($user->hasRole('temporary'));
    }

    /**
     * Test 6: Permission dapat di-revoke dari user
     */
    public function test_permission_can_be_revoked_from_user(): void
    {
        $user = User::factory()->create();
        $permission = Permission::create([
            'name' => 'Delete Content',
            'slug' => 'delete-content',
        ]);

        $user->givePermissionTo($permission);
        $this->assertTrue($user->hasPermission('delete-content'));

        $user->revokePermissionTo($permission);
        $this->assertFalse($user->hasPermission('delete-content'));
    }
}
