<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

/**
 * Black Box Testing - Pengujian Autentikasi
 * Teknik: Decision Table Testing & State Transition Testing
 */
class AuthenticationBlackBoxTest extends TestCase
{
    /**
     * Test 1: User dapat mengakses halaman login
     */
    public function test_user_can_access_login_page(): void
    {
        $response = $this->get('/admin/login');
        $response->assertStatus(200);
    }

    /**
     * Test 1: User dengan kredensial valid dapat login
     * Teknik: Equivalence Partitioning - kredensial valid
     */
    public function test_user_can_login_with_valid_credentials(): void
    {
        $user = User::where('email', 'admin@gmail.com')->first();

        $response = $this->post('/admin/login', [
            'email' => 'admin@gmail.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('/admin');
        $this->assertAuthenticatedAs($user, 'web');
    }

    /**
     * Test 3: User dengan password salah tidak dapat login
     * Teknik: Decision Table (Email Benar + Password Salah = Login Gagal)
     */
    public function test_user_cannot_login_with_wrong_password(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@gmail.com',
            'password' => 'wrongpassword',
        ]);

        $this->assertGuest();
    }

    /**
     * Test 4: User dengan email tidak terdaftar tidak dapat login
     * Teknik: Decision Table (Email Salah = Login Gagal)
     */
    public function test_user_cannot_login_with_unregistered_email(): void
    {
        $response = $this->post('/admin/login', [
            'email' => 'notexist@test.com',
            'password' => 'password123',
        ]);

        $this->assertGuest();
    }

    /**
     * Test 5: Guest (tidak login) tidak dapat mengakses halaman admin
     * Teknik: Equivalence Partitioning (Unauthorized Access)
     */
    public function test_guest_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin');
        
        // Harus redirect ke login
        $response->assertStatus(302);
    }

    /**
     * Test 6: User yang sudah login dapat mengakses halaman admin
     * Teknik: Equivalence Partitioning (Authorized Access)
     */
    public function test_authenticated_user_can_access_admin_dashboard(): void
    {
        $user = User::where('email', 'admin@gmail.com')->first();
        
        $response = $this->actingAs($user)->get('/admin');
        
        $response->assertStatus(200);
    }

    /**
     * Test 7: User dapat logout
     * Teknik: State Transition (Authenticated → Guest)
     */
    public function test_user_can_logout(): void
    {
        $user = User::where('email', 'admin@gmail.com')->first();
        
        // Login dulu
        $this->actingAs($user);
        $this->assertAuthenticatedAs($user);
        
        // Logout
        $response = $this->post('/admin/logout');
        
        // Sekarang jadi guest
        $this->assertGuest();
    }
}
