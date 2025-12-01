<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * Setup database untuk testing
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // Jalankan seeder untuk testing
        $this->seed(\Database\Seeders\TestUserSeeder::class);
    }
}
