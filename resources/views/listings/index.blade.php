<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apartments for Rent in Dubai - HopInHome</title>

    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@200,300,400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body { font-family: 'General Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased pt-20">

<x-header />

<x-listings.search-filters />

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <x-listings.heading-section />

    <x-listings.area-filters />

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <div class="lg:col-span-8">

            <x-listings.listings-header />

            <div class="space-y-6">

                @php
                    // Test Data Array
                    $listings = [
                        [
                            'title' => 'Cozy apartment with great views',
                            'location' => 'Down Town rd 2, Dubai',
                            'price' => '200,000',
                            'period' => 'Monthly',
                            'beds' => 2, 'baths' => 1, 'sqft' => 861,
                            'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?q=80&w=800&auto=format&fit=crop',
                            'utilities' => 'Utilities excluded',
                            'images_count' => '13/15'
                        ],
                        [
                            'title' => 'Modern Studio in Business Bay',
                            'location' => 'Business Bay, Dubai',
                            'price' => '85,000',
                            'period' => 'Monthly',
                            'beds' => 'Studio', 'baths' => 1, 'sqft' => 540,
                            'image' => 'https://images.unsplash.com/photo-1554995207-c18c203602cb?q=80&w=800&auto=format&fit=crop',
                            'utilities' => 'Utilities included',
                            'images_count' => '8/12'
                        ],
                        [
                            'title' => 'Luxury Villa with Private Pool',
                            'location' => 'Arabian Ranches, Dubai',
                            'price' => '450,000',
                            'period' => 'Monthly',
                            'beds' => 4, 'baths' => 5, 'sqft' => 4500,
                            'image' => 'https://images.unsplash.com/photo-1613977257363-707ba9348227?q=80&w=800&auto=format&fit=crop',
                            'utilities' => 'Utilities excluded',
                            'images_count' => '20/24'
                        ],
                        [
                            'title' => 'Chic apartment in Downtown',
                            'location' => 'Boulevard Point, Downtown',
                            'price' => '165,000',
                            'period' => 'Monthly',
                            'beds' => 1, 'baths' => 2, 'sqft' => 950,
                            'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?q=80&w=800&auto=format&fit=crop',
                            'utilities' => 'Utilities included',
                            'images_count' => '15/15'
                        ],
                        [
                            'title' => 'Marina View High Floor',
                            'location' => 'Dubai Marina, Dubai',
                            'price' => '140,000',
                            'period' => 'Monthly',
                            'beds' => 2, 'baths' => 2, 'sqft' => 1200,
                            'image' => 'https://images.unsplash.com/photo-1512918760513-95f192972701?q=80&w=800&auto=format&fit=crop',
                            'utilities' => 'Utilities excluded',
                            'images_count' => '10/18'
                        ],
                        [
                            'title' => 'Premium Penthouse Palm Jumeirah',
                            'location' => 'Palm Jumeirah, Dubai',
                            'price' => '850,000',
                            'period' => 'Monthly',
                            'beds' => 5, 'baths' => 6, 'sqft' => 6000,
                            'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=800&auto=format&fit=crop',
                            'utilities' => 'Utilities included',
                            'images_count' => '25/30'
                        ],
                    ];
                @endphp

                @foreach($listings as $listing)
                    <x-listings.listing-card :listing="$listing" />
                @endforeach

                <x-listings.show-more-button />

            </div>
        </div>

        <div class="lg:col-span-4 space-y-8">

            <x-listings.we-got-your-back />

            <x-listings.recommended-for-you />

            <x-listings.popular-searches />

        </div>

    </div>
</div>

    <x-listings.find-ideal-home />
<div>
    <div class="bg-white pb-20 pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-8 space-y-12">
                    <x-listings.why-rent-in-dubai />
                    <x-listings.popular-areas />
                    <x-listings.faq-section />
                </div>
                <div class="lg:col-span-4">
                    <x-listings.uae-insights-section />
                </div>
            </div>
        </div>
    </div>

</div>

<x-footer />

</body>
</html>
