@props(['listing'])

@php
    $images = $listing->images->map(function($image) {
        return Str::startsWith($image->image_url, 'http') 
            ? $image->image_url 
            : Illuminate\Support\Facades\Storage::url($image->image_url);
    });

    if ($images->isEmpty()) {
        $images->push(asset('images/placeholder-image.png'));
    }
@endphp

<div x-data="{ 
    currentIndex: 0, 
    images: {{ $images->toJson() }},
    next() {
        this.currentIndex = (this.currentIndex + 1) % this.images.length;
    },
    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
    }
}" class="bg-white rounded-lg shadow-[0px_2px_10px_0px_rgba(0,0,0,0.1)] flex items-center group overflow-hidden relative">
    
    <!-- Main Card Link -->
    <a href="{{ route('listings.show', $listing->id) }}" class="absolute inset-0 z-0" aria-label="View listing details"></a>

    <!-- Image Section -->
    <div class="relative w-[380px] h-[238px] flex-shrink-0 z-10">
        <div class="w-full h-full relative overflow-hidden">
            <template x-for="(image, index) in images" :key="index">
                <img 
                    x-show="currentIndex === index"
                    class="w-full h-full object-cover absolute inset-0"
                    draggable="false"
                    :src="image"
                    alt="{{ $listing->name }}"
                    x-transition:enter="transition opacity duration-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                >
            </template>
        </div>

        <!-- Favorite Icon -->
        <button @click.stop.prevent="" class="absolute top-3 right-3 p-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 focus:outline-none z-20">
            <img src="{{ asset('images/favorite_white.svg') }}" alt="Favorite" class="w-8 h-8">
        </button>

        <!-- Image Navigation (Arrows) -->
        <div class="absolute inset-y-0 left-0 right-0 flex items-center justify-between px-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none z-20">
            <button 
                @click.stop.prevent="prev()" 
                class="pointer-events-auto focus:outline-none"
                x-show="images.length > 1"
            >
                <img src="{{ asset('images/arrow_left_white_notail.svg') }}" alt="Previous" class="w-6 h-6">
            </button>
            <button 
                @click.stop.prevent="next()" 
                class="pointer-events-auto focus:outline-none"
                x-show="images.length > 1"
            >
                <img src="{{ asset('images/arrow1.svg') }}" alt="Next" class="w-6 h-6">
            </button>
        </div>

        <!-- Image Navigation (Dots) -->
        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-1.5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20" x-show="images.length > 1">
            <template x-for="(image, index) in images" :key="index">
                <button 
                    @click.stop.prevent="currentIndex = index"
                    class="size-[7px] rounded-full transition-all duration-300 focus:outline-none"
                    :class="currentIndex === index ? 'bg-white w-[14px]' : 'bg-white/60'"
                ></button>
            </template>
        </div>
    </div>

    <!-- Content Section -->
    <div class="p-6 flex-grow flex flex-col justify-between relative z-10 pointer-events-none">
        <div>
            <div class="flex justify-between items-start mb-2">
                <div>
                    <h3 class="text-xl font-medium text-gray-900 leading-tight">{{ $listing->name }}</h3>
                    <p class="text-sm text-gray-500">{{ $listing->address }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4 text-sm text-gray-600 mb-6">
                <div class="flex items-center gap-1">
                    <img src="{{ asset('images/activity_zone_gray.svg') }}" alt="Area Icon" class="w-5 h-5 text-gray-400">
                    <span>{{ $listing->area }} sqft</span>
                </div>
                <div class="flex items-center gap-1">
                    <img src="{{ asset('images/bed_gray.svg') }}" alt="Beds Icon" class="w-5 h-5 text-gray-400">
                    <span>{{ $listing->bedrooms }} beds</span>
                </div>
                <div class="flex items-center gap-1">
                    <img src="{{ asset('images/bathtub_gray.svg') }}" alt="Baths Icon" class="w-5 h-5 text-gray-400">
                    <span>{{ $listing->bathrooms }} bath</span>
                </div>
                <div class="flex items-center gap-1 ml-auto text-gray-400 text-xs">
                    <img src="{{ asset('images/floor_gray.svg') }}" alt="Images Icon" class="w-5 h-5">
                    <span>{{ $listing->floor_number }}/{{ $listing->total_floors }}</span>
                </div>
            </div>
        </div>

        <div class="flex items-end justify-between pt-4 border-t border-gray-100">
            <div>
                <span class="text-2xl font-semibold text-gray-900">AED {{ number_format($listing->price) }}</span>
                <span class="text-sm font-medium text-gray-900"> / {{ $listing->payment_option }}</span>
            </div>
            <span class="text-xs text-gray-400">{{ $listing->utilities_option }}</span>
        </div>
    </div>
</div>
