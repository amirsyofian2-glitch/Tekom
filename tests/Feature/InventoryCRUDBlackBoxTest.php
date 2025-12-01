<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Inventory;
use App\Models\Site;
use App\Models\EquipmentType;
use Tests\TestCase;

/**
 * Black Box Testing - Pengujian CRUD Inventory
 */
class InventoryCRUDBlackBoxTest extends TestCase
{
    private User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminUser = User::where('email', 'admin@gmail.com')->first();
    }

    /**
     * Test 1: User dapat mengakses halaman inventories
     */
    public function test_user_can_access_inventories_page(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/inventories');

        $response->assertStatus(200);
    }

    /**
     * Test 2: Inventory dengan data valid dapat dibuat
     */
    public function test_inventory_can_be_created_with_valid_data(): void
    {
        $site = Site::factory()->create();
        $equipmentType = EquipmentType::factory()->create();

        $inventoryData = [
            'site_id' => $site->id,
            'equipment_type_id' => $equipmentType->id,
            'code' => 'INV001',
            'name' => 'Equipment Test',
            'quantity' => 10,
            'condition' => 'BB',
            'is_active' => true,
        ];

        $inventory = Inventory::create($inventoryData);

        $this->assertDatabaseHas('inventories', [
            'code' => 'INV001',
            'name' => 'Equipment Test',
        ]);
    }

    /**
     * Test 3: Inventory dapat diupdate
     */
    public function test_inventory_can_be_updated(): void
    {
        $inventory = Inventory::factory()->create(['quantity' => 10]);

        $inventory->update(['quantity' => 20]);

        $this->assertDatabaseHas('inventories', [
            'id' => $inventory->id,
            'quantity' => 20,
        ]);
    }

    /**
     * Test 4: Inventory dapat dihapus
     */
    public function test_inventory_can_be_deleted(): void
    {
        $inventory = Inventory::factory()->create();
        $inventoryId = $inventory->id;

        $inventory->delete();

        $this->assertDatabaseMissing('inventories', ['id' => $inventoryId]);
    }
}
