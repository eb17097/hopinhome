<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Amenity;

class AmenitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amenities = [
            'Swimming pool',
            'Gym',
            'Reception',
            'Concierge',
            'Parking garage',
            'Elevator',
            'Free parking',
            'Security cameras',
            'Children’s play area',
            'Outdoor area',
            'Garden',
            'BBQ area',
            'Tennis court',
            'Community lounge',
            'Business center',
            'Bicycle storage',
        ];

        foreach ($amenities as $amenity) {
            Amenity::create(['name' => $amenity]);
        }
    }
}
