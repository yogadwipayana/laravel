<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookings = [
            [
                'name' => 'Budi Santoso',
                'phone' => '081234567890',
                'date' => Carbon::today()->addDays(1)->format('Y-m-d'),
                'time' => '19:00:00',
                'people' => 4,
                'notes' => 'Kursi tinggi untuk anak',
                'status' => 'confirmed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Siti Nurhaliza',
                'phone' => '082345678901',
                'date' => Carbon::today()->addDays(1)->format('Y-m-d'),
                'time' => '20:00:00',
                'people' => 6,
                'notes' => 'Alergi seafood',
                'status' => 'pending',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Adi Kurniawan',
                'phone' => '083456789012',
                'date' => Carbon::today()->format('Y-m-d'),
                'time' => '18:30:00',
                'people' => 2,
                'notes' => 'Meja dekat jendela',
                'status' => 'confirmed',
                'created_at' => Carbon::now()->subHours(2),
                'updated_at' => Carbon::now()->subHours(2),
            ],
            [
                'name' => 'Dewi Lestari',
                'phone' => '084567890123',
                'date' => Carbon::today()->addDays(2)->format('Y-m-d'),
                'time' => '19:30:00',
                'people' => 8,
                'notes' => 'Ulang tahun, tolong siapkan kue',
                'status' => 'pending',
                'created_at' => Carbon::now()->subHours(5),
                'updated_at' => Carbon::now()->subHours(5),
            ],
            [
                'name' => 'Made Wirawan',
                'phone' => '085678901234',
                'date' => Carbon::today()->addDays(3)->format('Y-m-d'),
                'time' => '12:00:00',
                'people' => 10,
                'notes' => 'Meeting kantor, butuh proyektor',
                'status' => 'confirmed',
                'created_at' => Carbon::now()->subDay(),
                'updated_at' => Carbon::now()->subDay(),
            ],
            [
                'name' => 'Putu Ayu',
                'phone' => '086789012345',
                'date' => Carbon::yesterday()->format('Y-m-d'),
                'time' => '19:00:00',
                'people' => 3,
                'notes' => null,
                'status' => 'completed',
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::yesterday(),
            ],
            [
                'name' => 'Wayan Sudiarta',
                'phone' => '087890123456',
                'date' => Carbon::today()->subDays(3)->format('Y-m-d'),
                'time' => '20:00:00',
                'people' => 5,
                'notes' => 'Pembatalan karena hujan',
                'status' => 'cancelled',
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'name' => 'Ketut Suryani',
                'phone' => '088901234567',
                'date' => Carbon::today()->addDays(4)->format('Y-m-d'),
                'time' => '18:00:00',
                'people' => 4,
                'notes' => 'Vegetarian menu',
                'status' => 'pending',
                'created_at' => Carbon::now()->subHours(1),
                'updated_at' => Carbon::now()->subHours(1),
            ],
            [
                'name' => 'Agung Permana',
                'phone' => '089012345678',
                'date' => Carbon::today()->addDays(5)->format('Y-m-d'),
                'time' => '19:00:00',
                'people' => 7,
                'notes' => 'Anniversary dinner',
                'status' => 'confirmed',
                'created_at' => Carbon::now()->subHours(3),
                'updated_at' => Carbon::now()->subHours(3),
            ],
            [
                'name' => 'Ni Luh Komang',
                'phone' => '+6281234567891',
                'date' => Carbon::today()->addDays(1)->format('Y-m-d'),
                'time' => '21:00:00',
                'people' => 2,
                'notes' => 'Late dinner setelah acara',
                'status' => 'pending',
                'created_at' => Carbon::now()->subMinutes(30),
                'updated_at' => Carbon::now()->subMinutes(30),
            ],
        ];

        DB::table('bookings')->insert($bookings);
    }
}
