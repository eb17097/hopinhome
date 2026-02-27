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
        $realUser = User::findOrFail($id);

        // Map role to display name
        $realUser->display_role = $realUser->role === 'property_manager' 
            ? 'Property manager' 
            : str_replace('_', ' ', ucfirst($realUser->role));

        // Enhance the real user with mock data for fields not yet in DB
        $realUser->license_number = '31139';
        $realUser->member_since = $realUser->created_at->year;
        $realUser->response_time = 'less than 2 hours';
        $realUser->total_listings = $realUser->listings()->count() ?: 136;
        $realUser->rating = 4.7;
        $realUser->review_count = 15;
        $realUser->reviews_stats = [
            5 => 11,
            4 => 4,
            3 => 0,
            2 => 0,
            1 => 0,
        ];

        // Use real bio if available, otherwise fallback
        if (!$realUser->bio) {
            $realUser->bio = $realUser->name . ' is an experienced Dubai-based professional specializing in luxury residences, tenant relations, and seamless operations, delivering exceptional value to clients across the UAE real estate market.';
        }

        $user = $realUser;

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

        // Fetch real listings for this user
        $listings = $user->listings()->with('images')->take(3)->get();
        
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
