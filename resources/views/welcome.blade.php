<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hopinhome</title>
    <meta name="robots" content="noindex, nofollow">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom scrollbar hide for cleaner look if needed */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-50 font-sans antialiased">

<nav class="bg-white border-b border-gray-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <span class="text-2xl font-bold text-rose-500 flex items-center gap-2">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    Hopinhome
                </span>
            </div>

            <div class="flex items-center space-x-6">
                <a href="#" class="hidden md:block text-gray-600 hover:text-gray-900 font-medium transition">Home</a>
                <a href="#" class="hidden md:block text-gray-600 hover:text-gray-900 font-medium transition">Find Properties</a>
                <a href="#" class="hidden md:block text-gray-600 hover:text-gray-900 font-medium transition">Articles & Insights</a>
                <a href="#" class="hidden md:block text-gray-600 hover:text-gray-900 font-medium transition">About Us</a>

                <div class="h-6 w-px bg-gray-300 mx-2 hidden md:block"></div>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-gray-900 font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-5 py-2.5 rounded-full font-medium hover:bg-blue-700 transition shadow-md">
                            Log in or sign up
                        </a>
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>

<div class="relative w-full h-[700px] flex items-center justify-center">

    <div class="absolute inset-0 bg-cover bg-center"
         style="background-image: url('https://images.unsplash.com/photo-1477959858617-67f85cf4f1df?q=80&w=2144&auto=format&fit=crop');">
    </div>

    <div class="absolute inset-0 bg-slate-900/50"></div>

    <div class="relative z-10 w-full max-w-5xl px-4 text-center">

        <h1 class="text-5xl md:text-6xl font-bold text-white mb-6 drop-shadow-lg tracking-tight">
            Find trusted <br />
            rental properties
        </h1>

        <p class="text-lg md:text-xl text-gray-100 mb-10 max-w-2xl mx-auto font-light drop-shadow-md">
            HopInHome helps you find <span class="font-semibold text-white">trusted</span> rental properties with ease.
            Explore listings and start renting with confidence.
        </p>

        <div class="bg-white/95 backdrop-blur-md p-6 rounded-3xl shadow-2xl mx-auto w-full max-w-4xl text-left">
            <form action="#" method="GET">

                <div class="flex flex-col md:flex-row gap-4 mb-4">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <input type="text"
                               class="block w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-900 placeholder-gray-500 focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition"
                               placeholder="Enter City or Location"
                        >
                    </div>

                    <button class="bg-blue-600 text-white font-semibold py-4 px-8 rounded-xl hover:bg-blue-700 transition flex items-center justify-center gap-2 shadow-lg shadow-blue-200/50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Search properties
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="relative">
                        <select class="block w-full py-3 px-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                            <option>Property type</option>
                            <option>Apartment</option>
                            <option>House</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                            <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <div class="relative">
                        <select class="block w-full py-3 px-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                            <option>Bedrooms</option>
                            <option>1 Bedroom</option>
                            <option>2 Bedrooms</option>
                            <option>3+ Bedrooms</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                            <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>

                    <div class="relative">
                        <select class="block w-full py-3 px-4 bg-gray-50 border border-gray-200 rounded-xl text-gray-700 appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500 cursor-pointer">
                            <option>Price</option>
                            <option>€0 - €500</option>
                            <option>€500 - €1000</option>
                            <option>€1000+</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                            <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Latest Stays in Latvia & Italy</h2>

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
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <h3 class="font-bold text-gray-900 text-lg leading-tight">{{ $listing->city }}</h3>
                                <p class="text-gray-500 text-sm mt-1 line-clamp-1">{{ $listing->title }}</p>
                            </div>
                        </div>

                        <div class="flex items-end justify-between mt-3 pt-3 border-t border-gray-100">
                            <div>
                                <span class="font-bold text-gray-900 text-xl">€{{ $listing->price }}</span>
                                <span class="text-gray-500 text-sm">/ night</span>
                            </div>
                            <button class="bg-rose-50 text-rose-600 p-2 rounded-full hover:bg-rose-100 transition">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
</div>

</body>
</html>
