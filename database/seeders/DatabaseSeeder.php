<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users for admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@wbs.com',
            'password' => bcrypt('password'),
        ]);

        User::factory()->create([
            'name' => 'Staff',
            'email' => 'staff@wbs.com',
            'password' => bcrypt('password'),
        ]);

        // Seed bookings
        $this->call([
            BookingSeeder::class,
        ]);
    }
}
