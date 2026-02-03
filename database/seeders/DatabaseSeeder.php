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
        // Apartment 1
        \App\Models\Listing::create([
            'title' => 'Luxury Loft near Old Town',
            'city' => 'Riga',
            'price' => 85,
            'image_url' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=800&q=80'
        ]);

        // Apartment 2
        \App\Models\Listing::create([
            'title' => 'Cozy Studio in Center',
            'city' => 'Riga',
            'price' => 45,
            'image_url' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=800&q=80'
        ]);

        // Apartment 3 (Updated Image)
        \App\Models\Listing::create([
            'title' => 'Modern Suite',
            'city' => 'Jurmala',
            'price' => 120,
            'image_url' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80'
        ]);
    }
}
