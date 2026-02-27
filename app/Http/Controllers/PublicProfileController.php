<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;

class PublicProfileController extends Controller
{
    /**
     * Display the public profile of a property manager.
     */
    public function show($id)
    {
        // Mocking a property manager user
        $user = (object) [
            'id' => $id,
            'name' => 'Jane Smith',
            'role' => 'Property manager',
            'license_number' => '31139',
            'profile_photo_url' => asset('images/candice-picard-vLENm-coX5Y-unsplash-1.png'),
            'bio' => 'Jane Smith is an experienced Dubai-based property manager specializing in luxury residences, tenant relations, and seamless operations, delivering exceptional value to owners across the UAE real estate market.',
            'member_since' => '2024',
            'response_time' => 'less than 2 hours',
            'total_listings' => 136,
            'rating' => 4.7,
            'review_count' => 15,
            'reviews_stats' => [
                5 => 11,
                4 => 4,
                3 => 0,
                2 => 0,
                1 => 0,
            ],
        ];

        // Mocking reviews
        $reviews = collect([
            (object) [
                'id' => 1,
                'reviewer_name' => 'Emily T.',
                'rating' => 5,
                'date' => 'April 3, 2025',
                'comment' => 'Very professional and helpful throughout the application process. One small repair took a bit longer than expected, but overall I had a great experience.',
            ],
            (object) [
                'id' => 2,
                'reviewer_name' => 'James R.',
                'rating' => 4,
                'date' => 'June 12, 2025',
                'comment' => 'Sarah made the whole process stress-free. She was a bit slow to respond but explained the contract clearly, and checked in after I moved in to make sure everything was fine.',
            ],
        ]);

        // Mocking listings
        // We fetch a few listings if they exist, otherwise we mock them too
        $listings = Listing::with('images')->take(3)->get();
        
        if ($listings->isEmpty()) {
            $listings = collect([
                (object) [
                    'id' => 1,
                    'name' => 'Beautiful apartment in Downtown',
                    'address' => 'Down Town rd 2, Dubai',
                    'area' => 861,
                    'bedrooms' => 2,
                    'bathrooms' => 1,
                    'floor_number' => 13,
                    'total_floors' => 15,
                    'price' => 400000,
                    'payment_option' => 'Monthly',
                    'utilities_option' => 'Utilities included',
                    'images' => collect([(object)['image_url' => asset('images/placeholder_image_1.png')]])
                ],
                (object) [
                    'id' => 2,
                    'name' => 'Chic apartment in Downtown',
                    'address' => 'Down Town rd 2, Dubai',
                    'area' => 861,
                    'bedrooms' => 2,
                    'bathrooms' => 1,
                    'floor_number' => 13,
                    'total_floors' => 15,
                    'price' => 465000,
                    'payment_option' => 'Monthly',
                    'utilities_option' => 'Utilities included',
                    'images' => collect([(object)['image_url' => asset('images/placeholder_image_4.png')]])
                ],
                (object) [
                    'id' => 3,
                    'name' => 'Cozy apartment with great views',
                    'address' => 'Down Town rd 2, Dubai',
                    'area' => 861,
                    'bedrooms' => 2,
                    'bathrooms' => 1,
                    'floor_number' => 13,
                    'total_floors' => 15,
                    'price' => 400000,
                    'payment_option' => 'Monthly',
                    'utilities_option' => 'Utilities included',
                    'images' => collect([(object)['image_url' => asset('images/placeholder_image_2.png')]])
                ],
            ]);
        }

        return view('profile.public.show', compact('user', 'reviews', 'listings'));
    }
}
