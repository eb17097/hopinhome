<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apartments for Rent in Dubai - HopInHome</title>

    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@200,300,400,500,600,700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body { font-family: 'General Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">

<nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span class="text-2xl font-bold text-blue-900">HopInHome</span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition">Home</a>
                <a href="#" class="text-sm font-medium text-gray-900">Find Properties</a>
                <a href="#" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition">Articles & Insights</a>
                <a href="#" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition">About Us</a>
            </div>

            <div class="flex items-center">
                <a href="#" class="bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-blue-700 transition">
                    Log in or sign up
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="border-b border-gray-200 py-4 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row gap-3 items-center">

            <div class="text-lg font-medium mr-4">Search & Filters</div>

            <div class="flex flex-wrap gap-3 flex-grow">
                <div class="relative w-full md:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <input type="text" value="Dubai" class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-lg text-sm bg-gray-50 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none">
                    <button class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <select class="py-2.5 px-4 border border-gray-200 rounded-lg text-sm bg-gray-50 text-gray-700 outline-none focus:border-blue-500 cursor-pointer">
                    <option>Property type</option>
                </select>

                <select class="py-2.5 px-4 border border-gray-200 rounded-lg text-sm bg-gray-50 text-gray-700 outline-none focus:border-blue-500 cursor-pointer">
                    <option>Bedrooms</option>
                </select>

                <select class="py-2.5 px-4 border border-gray-200 rounded-lg text-sm bg-gray-50 text-gray-700 outline-none focus:border-blue-500 cursor-pointer">
                    <option>Price</option>
                </select>

                <button class="flex items-center gap-2 py-2.5 px-4 bg-gray-50 border border-gray-200 rounded-lg text-sm font-medium text-blue-600 hover:bg-blue-50 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                    More filters
                    <span class="bg-blue-600 text-white text-[10px] w-5 h-5 flex items-center justify-center rounded-full">3</span>
                </button>
            </div>

            <button class="bg-blue-600 text-white px-8 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-700 transition shadow-sm flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Search
            </button>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="text-sm text-gray-500 mb-2">
        Home <span class="mx-2">></span> Dubai <span class="mx-2">></span> <span class="text-gray-900">Apartments for Rent</span>
    </div>

    <h1 class="text-3xl font-medium text-gray-900 mb-6">Apartments for Rent in Dubai</h1>

    <div class="flex flex-wrap gap-3 mb-8">
        <button class="px-5 py-2 bg-blue-600 text-white text-sm font-medium rounded-full shadow-sm hover:bg-blue-700 transition">
            Downtown Dubai
        </button>
        @foreach(['Dubai Marina', 'Jumeirah Village Circle (JVC)', 'Business Bay', 'Arabian Ranches'] as $area)
            <button class="px-5 py-2 bg-white border border-blue-200 text-blue-600 text-sm font-medium rounded-full hover:bg-blue-50 transition">
                {{ $area }}
            </button>
        @endforeach
    </div>

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
                    <div class="flex flex-col md:flex-row bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition duration-300 group">
                        <div class="relative w-full md:w-[40%] h-64 md:h-auto overflow-hidden">
                            <img src="{{ $listing['image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <button class="absolute top-3 right-3 text-white hover:text-red-500 transition shadow-sm">
                                <svg class="w-6 h-6 drop-shadow-md" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path></svg>
                            </button>
                            <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex justify-between px-2 opacity-0 group-hover:opacity-100 transition duration-300">
                                <button class="bg-white/90 p-1.5 rounded-full text-gray-800 hover:bg-white shadow-md"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
                                <button class="bg-white/90 p-1.5 rounded-full text-gray-800 hover:bg-white shadow-md"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
                            </div>
                        </div>

                        <div class="p-5 flex flex-col justify-between w-full md:w-[60%]">
                            <div>
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-medium text-gray-900 mb-1 group-hover:text-blue-600 transition">{{ $listing['title'] }}</h3>
                                        <p class="text-sm text-gray-500 mb-4">{{ $listing['location'] }}</p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg>
                            {{ $listing['sqft'] }} sqft
                        </span>
                                    <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            {{ $listing['beds'] }} beds
                        </span>
                                    <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path></svg>
                            {{ $listing['baths'] }} bath
                        </span>
                                    <span class="text-gray-400 text-xs flex items-center gap-1 ml-auto">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            {{ $listing['images_count'] }}
                        </span>
                                </div>
                            </div>

                            <div class="flex items-end justify-between pt-4 border-t border-gray-100">
                                <div>
                                    <span class="text-xl font-bold text-gray-900">AED {{ $listing['price'] }}</span>
                                    <span class="text-xs text-gray-500"> {{ $listing['period'] }}</span>
                                </div>
                                <span class="text-xs text-gray-400">{{ $listing['utilities'] }}</span>
                            </div>
                        </div>
                    </div>
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

<div class="bg-white border-t border-gray-200 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            <div class="relative h-[400px] rounded-3xl overflow-hidden shadow-sm">
                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=1000&auto=format&fit=crop"
                     alt="Ideal Home in Dubai"
                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
            </div>

            <div>
                <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.02em] text-gray-900 mb-6 font-['General_Sans',_sans-serif]">
                    Find your <span class="text-blue-600">ideal</span> home
                </h2>

                <div class="space-y-6 text-base text-gray-500 leading-relaxed font-['General_Sans',_sans-serif]">
                    <p>
                        Dubai offers one of the most dynamic rental markets in the world, with apartments suited to every lifestyle and budget.
                        Whether you’re searching for a modern studio in the city center, a family-friendly apartment near schools,
                        or a luxury residence with skyline views, Dubai has a wide range of rental options to match your needs.
                    </p>

                    <p>
                        Our selection of apartments for rent in Dubai allows you to explore verified listings across the city’s most popular neighborhoods.
                        Renting an apartment in Dubai is an attractive choice for residents, professionals, and expats alike.
                    </p>
                </div>
            </div>

        </div>

    </div>
</div>


<div class="bg-white pb-20 pt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            <div class="lg:col-span-8 space-y-12">

                <div>
                    <h3 class="text-2xl font-medium text-gray-900 mb-4">Why rent an apartment in Dubai?</h3>
                    <p class="text-gray-500 mb-4 leading-relaxed">
                        Dubai is known for its high quality of life, safety, and modern infrastructure.
                    </p>
                    <p class="text-gray-500 mb-4">Renting an apartment here gives you access to:</p>
                    <ul class="list-disc pl-5 space-y-2 text-gray-500 mb-6 marker:text-gray-400">
                        <li>International schools and universities</li>
                        <li>World-class healthcare facilities</li>
                        <li>Beaches, parks, and waterfront promenades</li>
                        <li>Shopping malls, restaurants, and entertainment hubs</li>
                        <li>Efficient public transport including the Dubai Metro</li>
                    </ul>
                    <p class="text-gray-500 leading-relaxed">
                        The rental market is regulated and transparent, making it easier for tenants to find secure, well-maintained homes.
                    </p>
                </div>

                <div>
                    <h3 class="text-2xl font-medium text-gray-900 mb-4">Popular areas to rent apartments in Dubai</h3>
                    <p class="text-gray-500 mb-6 leading-relaxed">
                        Choosing the right neighborhood is key to finding the perfect apartment. Some of the most in-demand areas include:
                    </p>
                    <ul class="space-y-3 text-gray-500">
                        <li><a href="#" class="text-blue-600 hover:underline">Downtown Dubai</a> – Close to business hubs, shopping, and landmarks</li>
                        <li><a href="#" class="text-blue-600 hover:underline">Dubai Marina</a> – Waterfront living with restaurants and nightlife</li>
                        <li><a href="#" class="text-blue-600 hover:underline">Business Bay</a> – Ideal for professionals working in the city</li>
                        <li><a href="#" class="text-blue-600 hover:underline">Jumeirah Village Circle (JVC)</a> – Affordable and family-friendly</li>
                        <li><a href="#" class="text-blue-600 hover:underline">Palm Jumeirah</a> – Luxury beachfront apartments</li>
                        <li><a href="#" class="text-blue-600 hover:underline">Deira & Bur Dubai</a> – Central locations with competitive rental prices</li>
                    </ul>
                    <p class="text-gray-500 mt-6 leading-relaxed">
                        Each area offers a unique lifestyle, price range, and community atmosphere.
                    </p>
                </div>

                <div x-data="{ activeAccordion: 1 }">
                    <h3 class="text-2xl font-medium text-gray-900 mb-6">Frequently asked questions</h3>

                    <div class="border-t border-gray-200">
                        <div class="border-b border-gray-200">
                            <button @click="activeAccordion = activeAccordion === 1 ? null : 1" class="flex justify-between items-center w-full py-5 text-left focus:outline-none">
                                <span class="text-gray-900 font-medium">How much does it cost to rent an apartment in Dubai?</span>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="activeAccordion === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="activeAccordion === 1" x-collapse class="pb-5 text-gray-500 leading-relaxed text-sm">
                                Furnished apartments are convenient for short-term stays, while unfurnished apartments are more cost-effective for long-term tenants who prefer to personalize their space. Prices vary significantly based on location and amenities.
                            </div>
                        </div>

                        <div class="border-b border-gray-200">
                            <button @click="activeAccordion = activeAccordion === 2 ? null : 2" class="flex justify-between items-center w-full py-5 text-left focus:outline-none">
                                <span class="text-gray-900 font-medium">Is it better to rent a furnished or unfurnished apartment?</span>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="activeAccordion === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="activeAccordion === 2" x-collapse class="pb-5 text-gray-500 leading-relaxed text-sm">
                                It depends on your stay duration. Furnished is easier for quick moves, while unfurnished offers better value long-term.
                            </div>
                        </div>

                        <div class="border-b border-gray-200">
                            <button @click="activeAccordion = activeAccordion === 3 ? null : 3" class="flex justify-between items-center w-full py-5 text-left focus:outline-none">
                                <span class="text-gray-900 font-medium">What documents are required to rent an apartment in Dubai?</span>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="activeAccordion === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="activeAccordion === 3" x-collapse class="pb-5 text-gray-500 leading-relaxed text-sm">
                                Typically you need your Emirates ID, Passport copy, Residency Visa, and a cheque book for rental payments.
                            </div>
                        </div>

                        <div class="border-b border-gray-200">
                            <button @click="activeAccordion = activeAccordion === 4 ? null : 4" class="flex justify-between items-center w-full py-5 text-left focus:outline-none">
                                <span class="text-gray-900 font-medium">Are utility bills included in the rent?</span>
                                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="activeAccordion === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="activeAccordion === 4" x-collapse class="pb-5 text-gray-500 leading-relaxed text-sm">
                                Usually, DEWA (water & electricity) and internet are separate, unless specified as "Bills Included" (common in hotel apartments).
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="lg:col-span-4">
                <div class="sticky top-24">
                    <h3 class="text-2xl font-medium text-gray-900 mb-6">Inside <span class="text-blue-600">the UAE</span>: tips, insights & living</h3>

                    <div class="space-y-6">
                        <a href="#" class="flex gap-4 group">
                            <div class="w-24 h-16 shrink-0 rounded-lg overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1516961642265-531546e84af2?q=80&w=200&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition">
                            </div>
                            <div>
                                <span class="text-blue-600 text-xs font-bold uppercase tracking-wide">Insights</span>
                                <h4 class="text-sm font-medium text-gray-900 mt-1 leading-snug group-hover:text-blue-600 transition">Best rental locations in Dubai for couples</h4>
                            </div>
                        </a>

                        <a href="#" class="flex gap-4 group">
                            <div class="w-24 h-16 shrink-0 rounded-lg overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1518684079-3c830dcef6c0?q=80&w=200&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition">
                            </div>
                            <div>
                                <span class="text-blue-600 text-xs font-bold uppercase tracking-wide">Insights</span>
                                <h4 class="text-sm font-medium text-gray-900 mt-1 leading-snug group-hover:text-blue-600 transition">What to expect when renting in the UAE for the first time</h4>
                            </div>
                        </a>

                        <a href="#" class="flex gap-4 group">
                            <div class="w-24 h-16 shrink-0 rounded-lg overflow-hidden">
                                <img src="https://images.unsplash.com/photo-1584622050111-993a426fbf0a?q=80&w=200&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition">
                            </div>
                            <div>
                                <span class="text-blue-600 text-xs font-bold uppercase tracking-wide">Community guide</span>
                                <h4 class="text-sm font-medium text-gray-900 mt-1 leading-snug group-hover:text-blue-600 transition">Hidden Costs to Look Out For When Renting in the UAE</h4>
                            </div>
                        </a>
                    </div>

                    <div class="mt-8">
                        <a href="#" class="block w-full py-3 border border-gray-200 rounded-full text-center text-sm font-medium text-gray-700 hover:bg-gray-50 hover:border-gray-300 transition">
                            View more articles
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<x-footer />

</body>
</html>
