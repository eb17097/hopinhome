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

            <div class="flex justify-between items-center mb-6">
                <span class="text-gray-500 text-sm">859 properties</span>
                <div class="flex items-center gap-2">
                    <span class="text-sm text-gray-500">Sort by:</span>
                    <select class="text-sm font-medium text-gray-900 bg-transparent border-none outline-none cursor-pointer">
                        <option>Most popular</option>
                        <option>Price: Low to High</option>
                        <option>Newest</option>
                    </select>
                </div>
            </div>

            <div class="space-y-6">

                @php
                    // Test Data Array
                    $listings = [
                        [
                            'title' => 'Cozy apartment with great views',
                            'location' => 'Down Town rd 2, Dubai',
                            'price' => '200,000',
                            'period' => 'Yearly',
                            'beds' => 2, 'baths' => 1, 'sqft' => 861,
                            'image' => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?q=80&w=800&auto=format&fit=crop',
                            'utilities' => 'Utilities excluded',
                            'images_count' => '13/15'
                        ],
                        [
                            'title' => 'Modern Studio in Business Bay',
                            'location' => 'Business Bay, Dubai',
                            'price' => '85,000',
                            'period' => 'Yearly',
                            'beds' => 'Studio', 'baths' => 1, 'sqft' => 540,
                            'image' => 'https://images.unsplash.com/photo-1554995207-c18c203602cb?q=80&w=800&auto=format&fit=crop',
                            'utilities' => 'Utilities included',
                            'images_count' => '8/12'
                        ],
                        [
                            'title' => 'Luxury Villa with Private Pool',
                            'location' => 'Arabian Ranches, Dubai',
                            'price' => '450,000',
                            'period' => 'Yearly',
                            'beds' => 4, 'baths' => 5, 'sqft' => 4500,
                            'image' => 'https://images.unsplash.com/photo-1613977257363-707ba9348227?q=80&w=800&auto=format&fit=crop',
                            'utilities' => 'Utilities excluded',
                            'images_count' => '20/24'
                        ],
                        [
                            'title' => 'Chic apartment in Downtown',
                            'location' => 'Boulevard Point, Downtown',
                            'price' => '165,000',
                            'period' => 'Yearly',
                            'beds' => 1, 'baths' => 2, 'sqft' => 950,
                            'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?q=80&w=800&auto=format&fit=crop',
                            'utilities' => 'Utilities included',
                            'images_count' => '15/15'
                        ],
                        [
                            'title' => 'Marina View High Floor',
                            'location' => 'Dubai Marina, Dubai',
                            'price' => '140,000',
                            'period' => 'Yearly',
                            'beds' => 2, 'baths' => 2, 'sqft' => 1200,
                            'image' => 'https://images.unsplash.com/photo-1512918760513-95f192972701?q=80&w=800&auto=format&fit=crop',
                            'utilities' => 'Utilities excluded',
                            'images_count' => '10/18'
                        ],
                        [
                            'title' => 'Premium Penthouse Palm Jumeirah',
                            'location' => 'Palm Jumeirah, Dubai',
                            'price' => '850,000',
                            'period' => 'Yearly',
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

                <div class="pt-8 text-center">
                    <button class="inline-flex items-center justify-center gap-2 px-8 py-3 bg-blue-600 text-white rounded-full font-medium hover:bg-blue-700 transition shadow-sm hover:shadow-md">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                        Show more properties
                    </button>
                </div>

            </div>
        </div>

        <div class="lg:col-span-4 space-y-8">

            <div class="bg-[#0A2558] rounded-2xl p-8 text-white relative overflow-hidden shadow-lg">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500 rounded-full blur-3xl opacity-20 -mr-10 -mt-10"></div>

                <h3 class="text-2xl font-medium mb-3 relative z-10">We’ve got your back</h3>
                <p class="text-blue-100 text-sm mb-6 leading-relaxed relative z-10">
                    From honest listings to practical insights, HopInHome helps you make rental decisions with clarity and peace of mind.
                </p>
                <button class="border border-white/30 text-white px-6 py-2 rounded-full text-sm font-medium hover:bg-white hover:text-blue-900 transition relative z-10">
                    Learn more
                </button>
            </div>

            <div class="pt-4 border-b border-gray-100 pb-8">
                <h4 class="font-medium text-gray-900 mb-4 text-lg">Recommended for you</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">2 bedroom apartments for rent in Dubai</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">3 bedroom houses for rent in the UAE</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">Villas for rent in Dubai</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">2 bedroom apartments in Abu Dhabi</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">Penthouses for rent in Downtown Dubai</a></li>
                </ul>
            </div>

            <div>
                <h4 class="font-medium text-gray-900 mb-4 text-lg">Popular searches</h4>
                <ul class="space-y-3">
                    <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">2 bedroom apartments for rent in Dubai</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">3 bedroom houses for rent in the UAE</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">Villas for rent in Dubai</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">2 bedroom apartments in Abu Dhabi</a></li>
                    <li><a href="#" class="text-sm text-gray-500 hover:text-blue-600 transition">Penthouses for rent in Downtown Dubai</a></li>
                </ul>
            </div>

        </div>

    </div>
</div>

<x-footer />

</body>
</html>
