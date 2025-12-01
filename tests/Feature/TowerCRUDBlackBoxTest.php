<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Tower;
use App\Models\Site;
use Tests\TestCase;

/**
 * Black Box Testing - Pengujian CRUD Tower
 */
class TowerCRUDBlackBoxTest extends TestCase
{
    private User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminUser = User::where('email', 'admin@gmail.com')->first();
    }

    /**
     * Test 1: User dapat mengakses halaman towers
     */
    public function test_user_can_access_towers_page(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/towers');

        $response->assertStatus(200);
    }

    /**
     * Test 2: Tower dengan data valid dapat dibuat
     */
    public function test_tower_can_be_created_with_valid_data(): void
    {
        $site = Site::factory()->create();

        $towerData = [
            'site_id' => $site->id,
            'repeater_type' => 'ANALOG',
            'system' => 'VHF',
            'frequency_rx' => 145.5000,
            'frequency_tx' => 150.5000,
            'site_status' => 'OPERASIONAL',
            'tower_structure' => 'SST',
            'tower_height' => 50,
            'condition_bb' => 5,
            'condition_rr' => 4,
            'condition_rb' => 5,
            'user' => 'Admin Test',
        ];

        $tower = Tower::create($towerData);

        $this->assertDatabaseHas('towers', [
            'site_id' => $site->id,
            'repeater_type' => 'ANALOG',
            'system' => 'VHF',
        ]);
    }

    /**
     * Test 3: Tower dapat diupdate
     */
    public function test_tower_can_be_updated(): void
    {
        $tower = Tower::factory()->create(['repeater_type' => 'ANALOG']);

        $tower->update(['repeater_type' => 'DIGITAL']);

        $this->assertDatabaseHas('towers', [
            'id' => $tower->id,
            'repeater_type' => 'DIGITAL',
        ]);
    }

    /**
     * Test 4: Tower dapat dihapus
     */
    public function test_tower_can_be_deleted(): void
    {
        $tower = Tower::factory()->create();
        $towerId = $tower->id;

        $tower->delete();

        $this->assertDatabaseMissing('towers', ['id' => $towerId]);
    }

    /**
     * Test 5: Filter tower berdasarkan system
     */
    public function test_can_filter_towers_by_system(): void
    {
        Tower::factory()->create(['system' => 'VHF']);
        Tower::factory()->create(['system' => 'UHF']);

        $vhfTowers = Tower::where('system', 'VHF')->get();

        $this->assertCount(1, $vhfTowers);
    }
}
