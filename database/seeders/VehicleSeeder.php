<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vehicle;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create([
            'number_plate' => 'D 5675 BTF',
            'vehicle_type' => 'car',
            'owner' => 'Gordon van seeder',
            'color' => 'black'
        ]);

        Vehicle::create([
            'number_plate' => 'D 5528 FRA',
            'vehicle_type' => 'motorcycle',
            'owner' => 'Gooni ibn seeder',
            'color' => 'red'
        ]);

        Vehicle::create([
            'number_plate' => 'F 0381 TGB',
            'vehicle_type' => 'truck',
            'owner' => 'panel seeder',
            'color' => 'green'
        ]);
    }
}
