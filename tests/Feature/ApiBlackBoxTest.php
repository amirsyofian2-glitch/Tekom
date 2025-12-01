<?php

namespace Tests\Feature;

use App\Models\Site;
use App\Models\Tower;
use Tests\TestCase;

/**
 * Black Box Testing - Pengujian API Endpoints
 * Teknik: Input/Output Testing
 */
class APIBlackBoxTest extends TestCase
{
    /**
     * Test 1: API tower locations mengembalikan response sukses
     */
    public function test_api_tower_locations_returns_success(): void
    {
        $response = $this->get('/api/tower-locations');

        $response->assertStatus(200);
    }

    /**
     * Test 2: API tower locations mengembalikan format JSON
     */
    public function test_api_tower_locations_returns_json_format(): void
    {
        $response = $this->get('/api/tower-locations');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');
    }

    /**
     * Test 3: API tower locations mengembalikan structure GeoJSON yang benar
     */
    public function test_api_tower_locations_returns_correct_geojson_structure(): void
    {
        // Buat data site dengan koordinat
        $site = Site::factory()->create([
            'latitude' => -6.200000,
            'longitude' => 106.816666,
        ]);

        Tower::factory()->create(['site_id' => $site->id]);

        $response = $this->get('/api/tower-locations');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'type',
            'features' => [
                '*' => [
                    'type',
                    'geometry' => [
                        'type',
                        'coordinates',
                    ],
                    'properties',
                ],
            ],
        ]);
    }

    /**
     * Test 4: API dengan database kosong mengembalikan array features kosong
     */
    public function test_api_tower_locations_with_empty_database_returns_empty_features(): void
    {
        $response = $this->get('/api/tower-locations');

        $response->assertStatus(200);
        $response->assertJson([
            'type' => 'FeatureCollection',
            'features' => [],
        ]);
    }

    /**
     * Test 5: API hanya menampilkan site yang memiliki koordinat
     */
    public function test_api_only_returns_sites_with_coordinates(): void
    {
        // Site dengan koordinat
        $siteWithCoords = Site::factory()->create([
            'name' => 'Site With Coords',
            'latitude' => -6.200000,
            'longitude' => 106.816666,
        ]);

        // Site tanpa koordinat
        $siteWithoutCoords = Site::factory()->create([
            'name' => 'Site Without Coords',
            'latitude' => null,
            'longitude' => null,
        ]);

        $response = $this->get('/api/tower-locations');
        $data = $response->json();

        // Harus ada 1 feature (hanya yang punya koordinat)
        $this->assertCount(1, $data['features']);
    }

    /**
     * Test 6: Endpoint yang tidak ada mengembalikan 404
     */
    public function test_nonexistent_endpoint_returns_404(): void
    {
        $response = $this->get('/api/endpoint-tidak-ada');

        $response->assertStatus(404);
    }

    /**
     * Test 7: Method HTTP yang salah ditolak
     */
    public function test_wrong_http_method_rejected(): void
    {
        $response = $this->post('/api/tower-locations');

        $response->assertStatus(405); // Method Not Allowed
    }
}
