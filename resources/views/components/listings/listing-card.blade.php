<div class="bg-white rounded-lg shadow-md overflow-hidden relative group">
    <!-- Image Section -->
    <div class="relative w-full h-[238px] overflow-hidden rounded-t-lg">
        <img src="{{ $listing['image'] }}" alt="{{ $listing['title'] }}" class="w-full h-full object-cover rounded-t-lg transform group-hover:scale-105 transition-transform duration-500">
        
        <!-- Favorite Icon -->
        <button class="absolute top-3 right-3 p-2 rounded-full bg-white/80 text-gray-800 hover:text-red-500 transition shadow-sm">
            <img src="{{ asset('images/favorite.svg') }}" alt="Favorite" class="w-6 h-6">
        </button>

        <!-- Image Navigation (Arrows) -->
        <div class="absolute inset-y-0 left-0 right-0 flex items-center justify-between px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <button class="bg-white/90 p-1.5 rounded-full text-gray-800 hover:bg-white shadow-md">
                <img src="{{ asset('images/arrow.svg') }}" alt="Previous" class="w-4 h-4">
            </button>
            <button class="bg-white/90 p-1.5 rounded-full text-gray-800 hover:bg-white shadow-md">
                <img src="{{ asset('images/arrow1.svg') }}" alt="Next" class="w-4 h-4 transform rotate-180">
            </button>
        </div>

        <!-- Image Navigation (Dots) -->
        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-1 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <img src="{{ asset('images/dots.svg') }}" alt="Dots" class="h-[7px] w-auto">
        </div>
    </div>

    <!-- Content Section -->
    <div class="p-6 space-y-4">
        <div>
            <h3 class="text-xl font-medium text-gray-900 leading-tight mb-1">{{ $listing['title'] }}</h3>
            <p class="text-sm text-gray-500">{{ $listing['location'] }}</p>
        </div>

        <div class="flex items-center gap-4 text-sm text-gray-600">
            <div class="flex items-center gap-1">
                <img src="{{ asset('images/activity_zone.svg') }}" alt="Area Icon" class="w-5 h-5 text-gray-400">
                <span>{{ $listing['sqft'] }} sqft</span>
            </div>
            <div class="flex items-center gap-1">
                <img src="{{ asset('images/bed.svg') }}" alt="Beds Icon" class="w-5 h-5 text-gray-400">
                <span>{{ $listing['beds'] }} beds</span>
            </div>
            <div class="flex items-center gap-1">
                <img src="{{ asset('images/bathtub.svg') }}" alt="Baths Icon" class="w-5 h-5 text-gray-400">
                <span>{{ $listing['baths'] }} bath</span>
            </div>
            <div class="flex items-center gap-1 ml-auto text-gray-400 text-xs">
                <img src="{{ asset('images/floor.svg') }}" alt="Images Icon" class="w-5 h-5">
                <span>{{ $listing['images_count'] }}</span>
            </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
            <div>
                <span class="text-2xl font-semibold text-gray-900">AED {{ $listing['price'] }}</span>
                <span class="text-sm text-gray-500"> / {{ $listing['period'] }}</span>
            </div>
            <span class="text-xs text-gray-400">{{ $listing['utilities'] }}</span>
        </div>
    </div>
</div>
