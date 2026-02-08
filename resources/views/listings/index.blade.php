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

                <div class="flex flex-col md:flex-row bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="relative w-full md:w-[40%] h-64 md:h-auto group">
                        <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover">
                        <button class="absolute top-3 right-3 text-white hover:text-red-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path></svg></button>
                        <div class="absolute inset-x-0 top-1/2 -translate-y-1/2 flex justify-between px-2 opacity-0 group-hover:opacity-100 transition">
                            <button class="bg-white/80 p-1 rounded-full text-gray-800"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg></button>
                            <button class="bg-white/80 p-1 rounded-full text-gray-800"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg></button>
                        </div>
                    </div>

                    <div class="p-5 flex flex-col justify-between w-full md:w-[60%]">
                        <div>
                            <h3 class="text-xl font-medium text-gray-900 mb-1">Cozy apartment with great views</h3>
                            <p class="text-sm text-gray-500 mb-4">Down Town rd 2, Dubai</p>

                            <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                                <span class="flex items-center gap-1"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 0l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4"></path></svg> 861 sqft</span>
                                <span class="flex items-center gap-1"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg> 2 beds</span>
                                <span class="flex items-center gap-1"><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20"></path></svg> 1 bath</span>
                                <span class="text-gray-400 text-xs flex items-center gap-1"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg> 13/15</span>
                            </div>
                        </div>

                        <div class="flex items-end justify-between pt-4 border-t border-gray-100">
                            <div>
                                <span class="text-xl font-bold text-gray-900">AED 200,000</span>
                                <span class="text-xs text-gray-500"> Monthly</span>
                            </div>
                            <span class="text-xs text-gray-400">Utilities excluded</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="relative w-full md:w-[40%] h-64 md:h-auto group">
                        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover">
                        <button class="absolute top-3 right-3 text-white hover:text-red-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path></svg></button>
                    </div>

                    <div class="p-5 flex flex-col justify-between w-full md:w-[60%]">
                        <div>
                            <h3 class="text-xl font-medium text-gray-900 mb-1">Beautiful apartment in Downtown</h3>
                            <p class="text-sm text-gray-500 mb-4">Down Town rd 2, Dubai</p>

                            <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                                <span class="flex items-center gap-1">861 sqft</span>
                                <span class="flex items-center gap-1">2 beds</span>
                                <span class="flex items-center gap-1">1 bath</span>
                                <span class="text-gray-400 text-xs flex items-center gap-1">13/15</span>
                            </div>
                        </div>

                        <div class="flex items-end justify-between pt-4 border-t border-gray-100">
                            <div>
                                <span class="text-xl font-bold text-gray-900">AED 400,000</span>
                                <span class="text-xs text-gray-500"> Monthly</span>
                            </div>
                            <span class="text-xs text-gray-400">Utilities included</span>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col md:flex-row bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition duration-300">
                    <div class="relative w-full md:w-[40%] h-64 md:h-auto group">
                        <img src="https://images.unsplash.com/photo-1613977257363-707ba9348227?q=80&w=800&auto=format&fit=crop" class="w-full h-full object-cover">
                        <button class="absolute top-3 right-3 text-white hover:text-red-500"><svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path></svg></button>
                    </div>

                    <div class="p-5 flex flex-col justify-between w-full md:w-[60%]">
                        <div>
                            <h3 class="text-xl font-medium text-gray-900 mb-1">Chic apartment in Downtown</h3>
                            <p class="text-sm text-gray-500 mb-4">Down Town rd 2, Dubai</p>

                            <div class="flex items-center gap-4 text-sm text-gray-600 mb-4">
                                <span class="flex items-center gap-1">861 sqft</span>
                                <span class="flex items-center gap-1">2 beds</span>
                                <span class="flex items-center gap-1">1 bath</span>
                                <span class="text-gray-400 text-xs flex items-center gap-1">13/15</span>
                            </div>
                        </div>

                        <div class="flex items-end justify-between pt-4 border-t border-gray-100">
                            <div>
                                <span class="text-xl font-bold text-gray-900">AED 465,000</span>
                                <span class="text-xs text-gray-500"> Monthly</span>
                            </div>
                            <span class="text-xs text-gray-400">Utilities included</span>
                        </div>
                    </div>
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

            <div>
                <h4 class="font-medium text-gray-900 mb-4 text-lg">Recommended for you</h4>
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

</body>
</html>
