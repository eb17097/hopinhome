<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Feature;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $features = [
            'High-speed internet',
            'Maid room',
            'Fully furnished',
            'Laundry room',
            'Pets allowed',
            'Balcony or terrace',
            'Air conditioner',
            'Hot Tub',
            'Dishwasher',
            'Fireplace',
        ];

        foreach ($features as $feature) {
            Feature::firstOrCreate(['name' => $feature]);
        }
    }
}
