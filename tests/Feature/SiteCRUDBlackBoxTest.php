<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Site;
use App\Models\Organization;
use Tests\TestCase;

/**
 * Black Box Testing - Pengujian CRUD Site
 */
class SiteCRUDBlackBoxTest extends TestCase
{
    private User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminUser = User::where('email', 'admin@gmail.com')->first();
    }

    /**
     * Test 1: User dapat mengakses halaman sites
     */
    public function test_user_can_access_sites_page(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/sites');

        $response->assertStatus(200);
    }

    /**
     * Test 2: Site dengan data valid dapat dibuat
     */
    public function test_site_can_be_created_with_valid_data(): void
    {
        $org = Organization::factory()->create();

        $siteData = [
            'organization_id' => $org->id,
            'name' => 'Site Test',
            'region' => 'Jakarta',
            'location' => 'Jakarta Selatan',
            'ownership' => 'POLRI',
            'tower_height' => 50,
            'latitude' => -6.200000,
            'longitude' => 106.816666,
            'is_active' => true,
        ];

        $site = Site::create($siteData);

        $this->assertDatabaseHas('sites', [
            'name' => 'Site Test',
            'region' => 'Jakarta',
        ]);
    }

    /**
     * Test 3: Site dapat diupdate
     */
    public function test_site_can_be_updated(): void
    {
        $site = Site::factory()->create(['name' => 'Original Site']);

        $site->update(['name' => 'Updated Site']);

        $this->assertDatabaseHas('sites', [
            'id' => $site->id,
            'name' => 'Updated Site',
        ]);
    }

    /**
     * Test 4: Site dapat dihapus
     */
    public function test_site_can_be_deleted(): void
    {
        $site = Site::factory()->create();
        $siteId = $site->id;

        $site->delete();

        $this->assertDatabaseMissing('sites', ['id' => $siteId]);
    }

    /**
     * Test 5: Filter site berdasarkan ownership
     */
    public function test_can_filter_sites_by_ownership(): void
    {
        Site::factory()->create(['name' => 'Owned Site', 'ownership' => 'POLRI']);
        Site::factory()->create(['name' => 'Rented Site', 'ownership' => 'TELKOM']);

        $ownedSites = Site::where('ownership', 'POLRI')->get();

        $this->assertCount(1, $ownedSites);
        $this->assertEquals('Owned Site', $ownedSites->first()->name);
    }
}
