<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminBookingTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a test user for authentication
        $this->user = User::create([
            'name' => 'Test Admin',
            'email' => 'testadmin@wbs.com',
            'password' => Hash::make('password'),
        ]);
    }

    /**
     * Test admin dashboard loads successfully
     */
    public function test_admin_dashboard_loads(): void
    {
        $response = $this->actingAs($this->user)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Dashboard');
        $response->assertSee('Booking Hari Ini');
    }

    /**
     * Test bookings index page loads
     */
    public function test_bookings_index_loads(): void
    {
        $response = $this->actingAs($this->user)->get('/admin/bookings');
        $response->assertStatus(200);
        $response->assertSee('Daftar Booking');
    }

    /**
     * Test create booking page loads
     */
    public function test_create_booking_page_loads(): void
    {
        $response = $this->actingAs($this->user)->get('/admin/bookings/create');
        $response->assertStatus(200);
        $response->assertSee('Tambah Booking Baru');
    }

    /**
     * Test store booking functionality
     */
    public function test_can_create_booking(): void
    {
        $bookingData = [
            'name' => 'Test User',
            'phone' => '081234567890',
            'date' => date('Y-m-d', strtotime('+1 day')),
            'time' => '19:00',
            'people' => 4,
            'notes' => 'Test notes',
            'status' => 'pending',
        ];

        $response = $this->withoutMiddleware()->post('/admin/bookings', $bookingData);
        $response->assertStatus(302); // Redirect after success

        $this->assertDatabaseHas('bookings', [
            'name' => 'Test User',
            'phone' => '081234567890',
        ]);
    }

    /**
     * Test show booking page
     */
    public function test_show_booking_page(): void
    {
        // Create a booking
        $id = DB::table('bookings')->insertGetId([
            'name' => 'Test User',
            'phone' => '081234567890',
            'date' => date('Y-m-d', strtotime('+1 day')),
            'time' => '19:00:00',
            'people' => 4,
            'notes' => 'Test notes',
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->user)->get("/admin/bookings/{$id}");
        $response->assertStatus(200);
        $response->assertSee('Test User');
        $response->assertSee('081234567890');
    }

    /**
     * Test edit booking page
     */
    public function test_edit_booking_page(): void
    {
        $id = DB::table('bookings')->insertGetId([
            'name' => 'Test User',
            'phone' => '081234567890',
            'date' => date('Y-m-d', strtotime('+1 day')),
            'time' => '19:00:00',
            'people' => 4,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->actingAs($this->user)->get("/admin/bookings/{$id}/edit");
        $response->assertStatus(200);
        $response->assertSee('Edit Booking');
    }

    /**
     * Test update booking
     */
    public function test_can_update_booking(): void
    {
        $id = DB::table('bookings')->insertGetId([
            'name' => 'Test User',
            'phone' => '081234567890',
            'date' => date('Y-m-d', strtotime('+1 day')),
            'time' => '19:00:00',
            'people' => 4,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $updateData = [
            'name' => 'Updated User',
            'phone' => '082345678901',
            'date' => date('Y-m-d', strtotime('+2 days')),
            'time' => '20:00',
            'people' => 6,
            'status' => 'confirmed',
        ];

        $response = $this->withoutMiddleware()->put("/admin/bookings/{$id}", $updateData);
        $response->assertStatus(302);

        $this->assertDatabaseHas('bookings', [
            'id' => $id,
            'name' => 'Updated User',
            'status' => 'confirmed',
        ]);
    }

    /**
     * Test delete booking
     */
    public function test_can_delete_booking(): void
    {
        $id = DB::table('bookings')->insertGetId([
            'name' => 'Test User',
            'phone' => '081234567890',
            'date' => date('Y-m-d', strtotime('+1 day')),
            'time' => '19:00:00',
            'people' => 4,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->withoutMiddleware()->delete("/admin/bookings/{$id}");
        $response->assertStatus(302);

        $this->assertDatabaseMissing('bookings', ['id' => $id]);
    }

    /**
     * Test filter bookings by status
     */
    public function test_can_filter_bookings_by_status(): void
    {
        DB::table('bookings')->insert([
            [
                'name' => 'Pending User',
                'phone' => '081234567890',
                'date' => date('Y-m-d', strtotime('+1 day')),
                'time' => '19:00:00',
                'people' => 4,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Confirmed User',
                'phone' => '082345678901',
                'date' => date('Y-m-d', strtotime('+1 day')),
                'time' => '20:00:00',
                'people' => 6,
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        $response = $this->actingAs($this->user)->get('/admin/bookings?status=pending');
        $response->assertStatus(200);
        $response->assertSee('Pending User');
    }

    /**
     * Test update status endpoint
     */
    public function test_can_update_booking_status(): void
    {
        $id = DB::table('bookings')->insertGetId([
            'name' => 'Test User',
            'phone' => '081234567890',
            'date' => date('Y-m-d', strtotime('+1 day')),
            'time' => '19:00:00',
            'people' => 4,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->withoutMiddleware()->patch("/admin/bookings/{$id}/status", [
            'status' => 'confirmed',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('bookings', [
            'id' => $id,
            'status' => 'confirmed',
        ]);
    }
}
