<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test login page loads
     */
    public function test_login_page_loads(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Login');
        $response->assertSee('Email');
        $response->assertSee('Password');
    }

    /**
     * Test register page loads
     */
    public function test_register_page_loads(): void
    {
        $response = $this->get('/register');
        $response->assertStatus(200);
        $response->assertSee('Daftar Akun Baru');
    }

    /**
     * Test user can register
     */
    public function test_user_can_register(): void
    {
        $response = $this->withoutMiddleware()->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin');

        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
        ]);
    }

    /**
     * Test user can login with valid credentials
     */
    public function test_user_can_login_with_valid_credentials(): void
    {
        // Create a user using User model
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->withSession(['_token' => 'test'])
            ->post('/login', [
                '_token' => 'test',
                'email' => 'test@example.com',
                'password' => 'password123',
            ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin');
    }

    /**
     * Test user cannot login with invalid credentials
     */
    public function test_user_cannot_login_with_invalid_credentials(): void
    {
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->withSession(['_token' => 'test'])
            ->post('/login', [
                '_token' => 'test',
                'email' => 'test@example.com',
                'password' => 'wrongpassword',
            ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    /**
     * Test authenticated user can access admin dashboard
     */
    public function test_authenticated_user_can_access_admin(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
    }

    /**
     * Test guest cannot access admin dashboard
     */
    public function test_guest_cannot_access_admin(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test user can logout
     */
    public function test_user_can_logout(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->actingAs($user)
            ->withSession(['_token' => 'test'])
            ->post('/logout', ['_token' => 'test']);

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    /**
     * Test authenticated user can access dashboard
     */
    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    /**
     * Test registration validation
     */
    public function test_registration_requires_valid_data(): void
    {
        $response = $this->withoutMiddleware()->post('/register', [
            'name' => 'A', // Too short
            'email' => 'invalid-email',
            'password' => '123', // Too short
            'password_confirmation' => '456', // Doesn't match
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']);
    }
}
