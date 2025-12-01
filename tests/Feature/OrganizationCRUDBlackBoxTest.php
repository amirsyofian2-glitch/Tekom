<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Organization;
use Tests\TestCase;

/**
 * Black Box Testing - Pengujian CRUD Organization
 * Teknik: Equivalence Partitioning & Boundary Value Analysis
 */
class OrganizationCRUDBlackBoxTest extends TestCase
{
    private User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->adminUser = User::where('email', 'admin@gmail.com')->first();
    }

    /**
     * Test 1: User yang login dapat mengakses halaman list organization
     * Teknik: Positive Testing
     */
    public function test_authenticated_user_can_access_organization_list(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/organizations');

        $response->assertStatus(200);
    }

    /**
     * Test 2: Guest tidak dapat mengakses halaman organization
     * Teknik: Negative Testing
     */
    public function test_guest_cannot_access_organization_list(): void
    {
        $response = $this->get('/admin/organizations');

        $response->assertStatus(302); // Redirect to login
    }

    /**
     * Test 3: Halaman list menampilkan data organization yang ada
     * Teknik: Data Verification
     */
    public function test_organization_list_displays_existing_data(): void
    {
        // Buat beberapa organization
        Organization::factory()->create(['name' => 'Polda Metro Jaya', 'type' => 'POLDA']);
        Organization::factory()->create(['name' => 'Polres Jakarta Selatan', 'type' => 'POLRES']);

        $response = $this->actingAs($this->adminUser)
            ->get('/admin/organizations');

        $response->assertStatus(200);
        $response->assertSee('Polda Metro Jaya');
        $response->assertSee('Polres Jakarta Selatan');
    }

    /**
     * Test 4: User dapat mengakses halaman create organization
     */
    public function test_user_can_access_create_organization_page(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->get('/admin/organizations/create');

        $response->assertStatus(200);
    }

    /**
     * Test 5: Organization dengan data valid dapat dibuat
     * Teknik: Equivalence Partitioning (Valid Data)
     */
    public function test_organization_can_be_created_with_valid_data(): void
    {
        $validData = [
            'code' => 'POLDA001',
            'name' => 'Polda Test',
            'type' => 'POLDA',
            'address' => 'Jakarta',
            'is_active' => true,
        ];

        $this->actingAs($this->adminUser);
        
        // Hitung jumlah organization sebelum create
        $countBefore = Organization::count();
        
        // Buat organization baru
        Organization::create($validData);
        
        // Verifikasi jumlah bertambah
        $this->assertEquals($countBefore + 1, Organization::count());
        
        // Verifikasi data tersimpan
        $this->assertDatabaseHas('organizations', [
            'code' => 'POLDA001',
            'name' => 'Polda Test',
            'type' => 'POLDA',
        ]);
    }

    /**
     * Test 6: Organization dengan nama kosong tidak dapat dibuat
     * Teknik: Equivalence Partitioning (Invalid Data - Empty Name)
     */
    public function test_organization_cannot_be_created_with_empty_name(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Organization::create([
            'code' => 'POLDA002',
            'name' => '', // Invalid: kosong
            'type' => 'POLDA',
        ]);
    }

    /**
     * Test 7: Organization dengan type invalid tidak dapat dibuat
     * Teknik: Equivalence Partitioning (Invalid Data - Wrong Enum)
     */
    public function test_organization_cannot_be_created_with_invalid_type(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Organization::create([
            'code' => 'POLDA003',
            'name' => 'Polda Invalid',
            'type' => 'INVALID_TYPE', // Invalid: bukan enum yang valid
        ]);
    }

    /**
     * Test 8: Organization dapat diupdate
     * Teknik: CRUD Update Testing
     */
    public function test_organization_can_be_updated(): void
    {
        $org = Organization::factory()->create([
            'name' => 'Original Name',
            'type' => 'POLDA',
        ]);

        $org->update(['name' => 'Updated Name']);

        $this->assertDatabaseHas('organizations', [
            'id' => $org->id,
            'name' => 'Updated Name',
        ]);
    }

    /**
     * Test 9: Organization dapat dihapus
     * Teknik: CRUD Delete Testing
     */
    public function test_organization_can_be_deleted(): void
    {
        $org = Organization::factory()->create(['name' => 'To Be Deleted']);

        $orgId = $org->id;
        $org->delete();

        $this->assertDatabaseMissing('organizations', [
            'id' => $orgId,
        ]);
    }

    /**
     * Test 10: Filter organization berdasarkan status aktif
     * Teknik: Business Logic Testing
     */
    public function test_can_filter_organizations_by_active_status(): void
    {
        Organization::factory()->create(['name' => 'Active Org', 'is_active' => true]);
        Organization::factory()->create(['name' => 'Inactive Org', 'is_active' => false]);

        $activeOrgs = Organization::where('is_active', true)->get();

        $this->assertCount(1, $activeOrgs);
        $this->assertEquals('Active Org', $activeOrgs->first()->name);
    }
}
