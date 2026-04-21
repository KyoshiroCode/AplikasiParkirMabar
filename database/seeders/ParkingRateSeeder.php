<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ParkingRate;

class ParkingRateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParkingRate::create([
            'vehicle_type' => 'car',
            'rate_hour' => 5000,
        ]);

        ParkingRate::create([
            'vehicle_type' => 'motorcycle',
            'rate_hour' => 3000,
        ]);

        ParkingRate::create([
            'vehicle_type' => 'truck',
            'rate_hour' => 3000,
        ]);

    }
}
