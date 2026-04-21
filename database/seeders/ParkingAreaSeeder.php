<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ParkingArea;

class ParkingAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ParkingArea::create([
            'code' => 'B1',
            'name' => 'B1-Car',
            'vehicle_type' => 'car',
            'capacity' => 7,
            'used_slot' => 0
        ]);

        ParkingArea::create([
            'code' => 'B1',
            'name' => 'B1-Motorcycle',
            'vehicle_type' => 'motorcycle',
            'capacity' => 7,
            'used_slot' => 0
        ]);

        ParkingArea::create([
            'code' => 'B2',
            'name' => 'B2-Car',
            'vehicle_type' => 'car',
            'capacity' => 10,
            'used_slot' => 0
        ]);

        ParkingArea::create([
            'code' => 'B2',
            'name' => 'B2-Motorcycle',
            'vehicle_type' => 'motorcycle',
            'capacity' => 15,
            'used_slot' => 0
        ]);

    }
}
