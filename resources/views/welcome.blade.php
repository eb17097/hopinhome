<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hopinhome</title>
    <meta name="robots" content="noindex, nofollow">

    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@200,300,400,500,600,700&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        /* 2. APPLY THE FONT GLOBALLY */
        body {
            font-family: 'General Sans', sans-serif;
        }
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-50 antialiased">

<nav x-data="{ scrolled: false }"
     @scroll.window="scrolled = (window.pageYOffset > 20)"
     :class="scrolled ? 'bg-white/95 backdrop-blur-md shadow-sm py-3' : 'bg-transparent py-5'"
     class="fixed top-0 w-full z-50 transition-all duration-300 ease-in-out">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <div class="flex items-center">
                <a href="/" class="text-2xl font-bold flex items-center gap-2 transition-colors duration-300"
                   :class="scrolled ? 'text-rose-500' : 'text-white'">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span>Hopinhome</span>
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                @foreach(['Home', 'Find Properties', 'Articles & Insights', 'About Us'] as $item)
                    <a href="#" class="text-[18px] font-medium leading-[1.28] tracking-[-0.02em] transition-colors duration-300 hover:opacity-75"
                       :class="scrolled ? 'text-gray-800 hover:text-rose-500' : 'text-white/90 hover:text-white'">
                        {{ $item }}
                    </a>
                @endforeach

                <div class="h-6 w-px mx-2 transition-colors duration-300"
                     :class="scrolled ? 'bg-gray-300' : 'bg-white/30'"></div>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="text-[18px] font-medium leading-[1.28] tracking-[-0.02em] transition-colors duration-300"
                           :class="scrolled ? 'text-gray-800 hover:text-gray-900' : 'text-white hover:text-white'">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="bg-blue-600 text-white px-6 py-2.5 rounded-full text-[16px] font-medium hover:bg-blue-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Log in or sign up
                        </a>
                    @endauth
                @endif
            </div>

            <div class="md:hidden flex items-center">
                <button class="focus:outline-none transition-colors duration-300"
                        :class="scrolled ? 'text-gray-800' : 'text-white'">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
    </div>
</nav>

<div class="relative w-full h-[800px] flex items-center justify-center overflow-hidden">

    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 scale-105"
         style="background-image: url('https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?q=80&w=2144&auto=format&fit=crop');">
    </div>

    <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-900/70 to-transparent"></div>
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-gradient-to-t from-slate-900/50 to-transparent"></div>

    <div class="relative z-10 w-full max-w-5xl px-4 text-center mt-16">

        <h1 class="text-[64px] font-medium leading-[1.22] tracking-[-0.03em] text-white mb-6 drop-shadow-2xl font-['PP_Formula','General_Sans',_sans-serif]">
            Find trusted <br />
            rental properties
        </h1>

        <p class="text-[18px] font-normal leading-[1.5] tracking-normal text-gray-100 mb-12 max-w-2xl mx-auto drop-shadow-lg font-['General_Sans_Variable','General_Sans',_sans-serif]">
            HopInHome helps you find <span class="font-semibold text-white">trusted</span> rental properties with ease.
            Explore listings and start renting with confidence.
        </p>

        <div class="bg-white/95 backdrop-blur-md p-6 rounded-3xl shadow-2xl mx-auto w-full max-w-4xl text-left border border-white/20">
            <form action="#" method="GET">
                <div class="flex flex-col md:flex-row gap-4 mb-4">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <input type="text"
                               class="block w-full pl-12 pr-4 py-4 bg-gray-50 border-transparent focus:bg-white border focus:border-blue-500 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition"
                               placeholder="Enter City or Location">
                    </div>

                    <button class="bg-blue-600 text-white font-semibold py-4 px-8 rounded-xl hover:bg-blue-700 transition flex items-center justify-center gap-2 shadow-lg shadow-blue-500/30">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Search properties
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach(['Property type', 'Bedrooms', 'Price'] as $label)
                        <div class="relative">
                            <select class="block w-full py-3 px-4 bg-gray-50 border-transparent focus:bg-white border focus:border-blue-500 rounded-xl text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/20 cursor-pointer">
                                <option>{{ $label }}</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                                <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
</div>

<div class="bg-white py-20 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.02em] text-gray-900 mb-8 font-['General_Sans',_sans-serif]">
            Popular cities in the UAE
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-20">
            <a href="#" class="group cursor-pointer block">
                <div class="overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1546412414-e1885259563a?q=80&w=800&auto=format&fit=crop"
                         alt="Dubai"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="text-center font-medium text-gray-900 text-lg font-['General_Sans',_sans-serif]">Dubai</h3>
            </a>

            <a href="#" class="group cursor-pointer block">
                <div class="overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1546412414-e1885259563a?q=80&w=800&auto=format&fit=crop"
                         alt="Abu Dhabi"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="text-center font-medium text-gray-900 text-lg font-['General_Sans',_sans-serif]">Abu Dhabi</h3>
            </a>

            <a href="#" class="group cursor-pointer block">
                <div class="overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1546412414-e1885259563a?q=80&w=800&auto=format&fit=crop"
                         alt="Sharjah"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="text-center font-medium text-gray-900 text-lg font-['General_Sans',_sans-serif]">Sharjah</h3>
            </a>

            <a href="#" class="group cursor-pointer block">
                <div class="overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1546412414-e1885259563a?q=80&w=800&auto=format&fit=crop"
                         alt="Al Ain"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="text-center font-medium text-gray-900 text-lg font-['General_Sans',_sans-serif]">Al Ain</h3>
            </a>
        </div>


        <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.02em] text-gray-900 mb-8 font-['General_Sans',_sans-serif]">
            Browse by property type
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <a href="#" class="group p-6 border border-gray-100 rounded-2xl bg-white hover:shadow-lg hover:border-transparent transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 mb-4 text-blue-600">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"></path></svg>
                </div>
                <h3 class="font-medium text-gray-900 font-['General_Sans',_sans-serif]">Apartment</h3>
                <p class="text-xs text-gray-500 mt-1 font-['General_Sans',_sans-serif]">800+ listings</p>
            </a>

            <a href="#" class="group p-6 border border-gray-100 rounded-2xl bg-white hover:shadow-lg hover:border-transparent transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 mb-4 text-blue-600">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"></path></svg>
                </div>
                <h3 class="font-medium text-gray-900 font-['General_Sans',_sans-serif]">Villa</h3>
                <p class="text-xs text-gray-500 mt-1 font-['General_Sans',_sans-serif]">150+ listings</p>
            </a>

            <a href="#" class="group p-6 border border-gray-100 rounded-2xl bg-white hover:shadow-lg hover:border-transparent transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 mb-4 text-blue-600">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path></svg>
                </div>
                <h3 class="font-medium text-gray-900 font-['General_Sans',_sans-serif]">House</h3>
                <p class="text-xs text-gray-500 mt-1 font-['General_Sans',_sans-serif]">300+ listings</p>
            </a>

            <a href="#" class="group p-6 border border-gray-100 rounded-2xl bg-white hover:shadow-lg hover:border-transparent transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 mb-4 text-blue-600">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"></path></svg>
                </div>
                <h3 class="font-medium text-gray-900 font-['General_Sans',_sans-serif]">Townhouse</h3>
                <p class="text-xs text-gray-500 mt-1 font-['General_Sans',_sans-serif]">100+ listings</p>
            </a>

            <a href="#" class="group p-6 border border-gray-100 rounded-2xl bg-white hover:shadow-lg hover:border-transparent transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 mb-4 text-blue-600">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"></path></svg>
                </div>
                <h3 class="font-medium text-gray-900 font-['General_Sans',_sans-serif]">Hotel Apt</h3>
                <p class="text-xs text-gray-500 mt-1 font-['General_Sans',_sans-serif]">100+ listings</p>
            </a>

            <a href="#" class="group p-6 border border-gray-100 rounded-2xl bg-white hover:shadow-lg hover:border-transparent transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 mb-4 text-blue-600">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z"></path></svg>
                </div>
                <h3 class="font-medium text-gray-900 font-['General_Sans',_sans-serif]">Penthouse</h3>
                <p class="text-xs text-gray-500 mt-1 font-['General_Sans',_sans-serif]">50+ listings</p>
            </a>

        </div>
    </div>

    <div class="bg-white pb-20 pt-10 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.02em] text-gray-900 font-['General_Sans',_sans-serif]">
                        Popular homes in <span class="text-blue-600">the UAE</span>
                    </h2>
                </div>

                <a href="#" class="inline-flex items-center justify-center px-6 py-2.5 border border-gray-200 rounded-full text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-300 transition font-['General_Sans',_sans-serif]">
                    View more properties
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="relative w-full aspect-[4/3] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?q=80&w=800&auto=format&fit=crop"
                             alt="Cozy apartment"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <button class="absolute top-4 right-4 text-white hover:text-red-500 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path></svg>
                        </button>

                        <button class="absolute top-1/2 left-2 -translate-y-1/2 bg-white/80 p-1.5 rounded-full opacity-0 group-hover:opacity-100 transition hover:bg-white">
                            <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5"></path></svg>
                        </button>
                        <button class="absolute top-1/2 right-2 -translate-y-1/2 bg-white/80 p-1.5 rounded-full opacity-0 group-hover:opacity-100 transition hover:bg-white">
                            <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"></path></svg>
                        </button>
                    </div>

                    <div class="p-5">
                        <h3 class="text-xl font-medium text-gray-900 mb-1 font-['General_Sans',_sans-serif]">Cozy apartment with great views</h3>
                        <p class="text-sm text-gray-500 mb-4 font-['General_Sans',_sans-serif]">Down Town rd 2, Dubai</p>

                        <div class="flex items-center gap-4 text-sm text-gray-600 mb-6 font-['General_Sans',_sans-serif]">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"></path></svg>
                                <span>861 sqft</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 7.5V3.75m0 0a3.75 3.75 0 017.5 0v3.75m-7.5 0H9m11.25 0H21"></path></svg>
                                <span>2 beds</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"></path></svg>
                                <span>1 bath</span>
                            </div>
                        </div>

                        <div class="flex items-end justify-between border-t border-gray-100 pt-4">
                            <div>
                                <span class="text-xl font-bold text-gray-900 font-['General_Sans',_sans-serif]">AED 200,000</span>
                                <span class="text-sm text-gray-500 font-normal"> Yearly</span>
                            </div>
                            <span class="text-xs text-gray-400">Utilities excluded</span>
                        </div>
                    </div>
                </div>

                <div class="group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="relative w-full aspect-[4/3] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1613977257363-707ba9348227?q=80&w=800&auto=format&fit=crop"
                             alt="Beautiful villa"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <button class="absolute top-4 right-4 text-white hover:text-red-500 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path></svg>
                        </button>
                    </div>

                    <div class="p-5">
                        <h3 class="text-xl font-medium text-gray-900 mb-1 font-['General_Sans',_sans-serif]">Beautiful villa in a new project</h3>
                        <p class="text-sm text-gray-500 mb-4 font-['General_Sans',_sans-serif]">Down Town rd 2, Dubai</p>

                        <div class="flex items-center gap-4 text-sm text-gray-600 mb-6 font-['General_Sans',_sans-serif]">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"></path></svg>
                                <span>1200 sqft</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 7.5V3.75m0 0a3.75 3.75 0 017.5 0v3.75m-7.5 0H9m11.25 0H21"></path></svg>
                                <span>4 beds</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"></path></svg>
                                <span>3 baths</span>
                            </div>
                        </div>

                        <div class="flex items-end justify-between border-t border-gray-100 pt-4">
                            <div>
                                <span class="text-xl font-bold text-gray-900 font-['General_Sans',_sans-serif]">AED 400,000</span>
                                <span class="text-sm text-gray-500 font-normal"> Yearly</span>
                            </div>
                            <span class="text-xs text-gray-400">Utilities included</span>
                        </div>
                    </div>
                </div>

                <div class="group bg-white border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="relative w-full aspect-[4/3] overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?q=80&w=800&auto=format&fit=crop"
                             alt="Chic apartment"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <button class="absolute top-4 right-4 text-white hover:text-red-500 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z"></path></svg>
                        </button>
                    </div>

                    <div class="p-5">
                        <h3 class="text-xl font-medium text-gray-900 mb-1 font-['General_Sans',_sans-serif]">Chic apartment in Downtown</h3>
                        <p class="text-sm text-gray-500 mb-4 font-['General_Sans',_sans-serif]">Down Town rd 2, Dubai</p>

                        <div class="flex items-center gap-4 text-sm text-gray-600 mb-6 font-['General_Sans',_sans-serif]">
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"></path></svg>
                                <span>861 sqft</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 7.5V3.75m0 0a3.75 3.75 0 017.5 0v3.75m-7.5 0H9m11.25 0H21"></path></svg>
                                <span>2 beds</span>
                            </div>
                            <div class="flex items-center gap-1.5">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"></path></svg>
                                <span>1 bath</span>
                            </div>
                        </div>

                        <div class="flex items-end justify-between border-t border-gray-100 pt-4">
                            <div>
                                <span class="text-xl font-bold text-gray-900 font-['General_Sans',_sans-serif]">AED 465,000</span>
                                <span class="text-sm text-gray-500 font-normal"> Yearly</span>
                            </div>
                            <span class="text-xs text-gray-400">Utilities excluded</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

<div class="bg-gray-50 py-20 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div>
                <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.02em] text-gray-900 font-['General_Sans',_sans-serif]">
                    Inside <span class="text-blue-600">the UAE</span>: Tips, Insights & Living
                </h2>
            </div>

            <a href="#" class="inline-flex items-center justify-center px-6 py-2.5 border border-gray-200 rounded-full text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-300 transition font-['General_Sans',_sans-serif]">
                View more articles
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

            <a href="#" class="group cursor-pointer block">
                <div class="relative overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1516961642265-531546e84af2?q=80&w=800&auto=format&fit=crop"
                         alt="Couple in Dubai"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-md uppercase tracking-wide">
                        Insights
                    </span>
                </div>
                <h3 class="text-lg font-medium text-gray-900 leading-snug group-hover:text-blue-600 transition font-['General_Sans',_sans-serif]">
                    Best rental locations in Dubai for couples
                </h3>
            </a>

            <a href="#" class="group cursor-pointer block">
                <div class="relative overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1516961642265-531546e84af2?q=80&w=800&auto=format&fit=crop"
                         alt="Dubai Street"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-md uppercase tracking-wide">
                        Community guide
                    </span>
                </div>
                <h3 class="text-lg font-medium text-gray-900 leading-snug group-hover:text-blue-600 transition font-['General_Sans',_sans-serif]">
                    What to expect when renting in the UAE for the first time
                </h3>
            </a>

            <a href="#" class="group cursor-pointer block">
                <div class="relative overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1516961642265-531546e84af2?q=80&w=800&auto=format&fit=crop"
                         alt="Bathroom Interior"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-md uppercase tracking-wide">
                        Community guide
                    </span>
                </div>
                <h3 class="text-lg font-medium text-gray-900 leading-snug group-hover:text-blue-600 transition font-['General_Sans',_sans-serif]">
                    Hidden Costs to Look Out For When Renting in the UAE
                </h3>
            </a>

            <a href="#" class="group cursor-pointer block">
                <div class="relative overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1516961642265-531546e84af2?q=80&w=800&auto=format&fit=crop"
                         alt="UAE Culture"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-md uppercase tracking-wide">
                        Insights
                    </span>
                </div>
                <h3 class="text-lg font-medium text-gray-900 leading-snug group-hover:text-blue-600 transition font-['General_Sans',_sans-serif]">
                    UAE Cultural Norms Every New Resident Should Know
                </h3>
            </a>

        </div>
    </div>
</div>

<div class="bg-white py-20 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20 items-center">

            <div class="relative rounded-3xl overflow-hidden aspect-square shadow-lg">
                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=1000&auto=format&fit=crop"
                     alt="Cozy Living Room"
                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
            </div>

            <div>
                <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.02em] text-gray-900 mb-6 font-['General_Sans',_sans-serif]">
                    About <span class="text-blue-600">HopInHome</span>
                </h2>

                <div class="space-y-6 text-lg text-gray-600 leading-relaxed font-['General_Sans',_sans-serif]">
                    <p>
                        At HopInHome our mission is to make renting <span class="font-semibold text-gray-900">easier and more transparent</span>.
                        We help renters navigate one of the most stressful parts of moving by providing verified listings,
                        straightforward guidance, and trusted insights from the community.
                    </p>

                    <p>
                        Our goal is to <span class="font-semibold text-gray-900">reduce surprises</span>, remove uncertainty, and
                        <span class="font-semibold text-gray-900">help people</span> make confident decisions - without pressure or hidden risks.
                    </p>
                </div>

                <div class="mt-8">
                    <a href="#" class="inline-flex items-center justify-center px-8 py-3 border border-blue-600 rounded-full text-base font-medium text-blue-600 bg-transparent hover:bg-blue-50 transition duration-300 font-['General_Sans',_sans-serif]">
                        Learn more
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-semibold text-gray-900 mb-8">Latest Stays in Latvia & Italy</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($listings as $listing)
                <a href="{{ route('listings.show', $listing) }}" class="group cursor-pointer block bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100">
                    <div class="relative w-full aspect-[4/3] overflow-hidden">
                        <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}" class="object-cover w-full h-full group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-lg flex items-center shadow-sm">
                            <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <span class="text-xs font-bold text-gray-800">4.9</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-900 text-lg leading-tight">{{ $listing->city }}</h3>
                        <p class="text-gray-500 text-sm mt-1 line-clamp-1">{{ $listing->title }}</p>
                        <div class="flex items-end justify-between mt-3 pt-3 border-t border-gray-100">
                            <div><span class="font-bold text-gray-900 text-xl">€{{ $listing->price }}</span> <span class="text-gray-500 text-sm">/ night</span></div>
                            <button class="bg-rose-50 text-rose-600 p-2 rounded-full hover:bg-rose-100 transition"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg></button>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

</body>
</html>
