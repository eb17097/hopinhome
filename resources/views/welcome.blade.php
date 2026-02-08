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

        <h1 class="text-5xl md:text-7xl font-semibold text-white mb-6 drop-shadow-2xl tracking-tight leading-tight">
            Find trusted <br />
            rental properties
        </h1>

        <p class="text-lg md:text-xl text-gray-100 mb-12 max-w-2xl mx-auto font-light drop-shadow-lg">
            HopInHome helps you find <span class="font-medium text-white">trusted</span> rental properties with ease.
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
