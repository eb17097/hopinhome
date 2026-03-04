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
}" class="block w-full max-w-[380px] bg-white rounded-[8px] shadow-[0px_2px_16px_0px_rgba(0,0,0,0.06)] overflow-hidden group relative">
    <div class="relative h-[238px]">
        <a href="{{ route('listings.show', $listing) }}" class="block w-full h-full">
            <template x-for="(image, index) in images" :key="index">
                <img 
                    x-show="currentIndex === index"
                    class="w-full h-full object-cover absolute inset-0"
                    draggable="false"
                    :src="image"
                    alt="{{ $listing->name }}"
                    x-transition:enter="transition opacity-300"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                >
            </template>
        </a>

        {{-- Navigation Arrows --}}
        <div class="absolute inset-0 flex items-center justify-between px-[10px] pointer-events-none">
            <button 
                @click.prevent="prev()" 
                class="pointer-events-auto opacity-0 group-hover:opacity-80 transition-opacity focus:outline-none"
                x-show="images.length > 1"
            >
                <img src="{{ asset('images/arrow_left_white_notail.svg') }}" class="size-6" alt="Previous">
            </button>
            <button 
                @click.prevent="next()" 
                class="pointer-events-auto opacity-0 group-hover:opacity-80 transition-opacity focus:outline-none"
                x-show="images.length > 1"
            >
                <img src="{{ asset('images/arrow1.svg') }}" class="size-6" alt="Next">
            </button>
        </div>

        {{-- Favorite Button --}}
        <div class="absolute top-[12px] right-[12px]">
            <button class="focus:outline-none">
                <img src="{{ asset('images/favorite_white.svg') }}" draggable="false" alt="Favorite" class="size-[32px]">
            </button>
        </div>

        {{-- Dynamic Dots --}}
        <div class="absolute bottom-[12px] left-1/2 -translate-x-1/2 flex gap-1.5" x-show="images.length > 1">
            <template x-for="(image, index) in images" :key="index">
                <button 
                    @click.prevent="currentIndex = index"
                    class="size-[7px] rounded-full transition-all duration-300 focus:outline-none"
                    :class="currentIndex === index ? 'bg-white w-[14px]' : 'bg-white/60'"
                ></button>
            </template>
        </div>
    </div>

    <div class="p-[20px]">
        <a href="{{ route('listings.show', $listing) }}" class="block group/title">
            <h3 class="font-medium text-[20px] text-[#1E1D1D] tracking-[-0.4px] leading-[1.28] truncate group-hover/title:text-electric-blue transition-colors">{{ $listing->name }}</h3>
        </a>
        <p class="text-[14px] text-[#464646] leading-[1.5] mt-1 truncate">{{ $listing->address }}</p>

        <div class="flex items-center gap-x-[16px] text-[14px] text-[#464646] mt-[18px]">
            <div class="flex items-end gap-[3px]">
                <img src="{{ asset('images/activity_zone_gray.svg') }}" class="size-5" alt="">
                <span class="leading-[1.5]">{{ $listing->area }} sqft</span>
            </div>
            <div class="flex items-end gap-[3px]">
                <img src="{{ asset('images/bed_gray.svg') }}" class="size-5" alt="">
                <span class="leading-[1.5]">{{ $listing->bedrooms }} beds</span>
            </div>
            <div class="flex items-end gap-[4px]">
                <img src="{{ asset('images/bathtub_gray.svg') }}" class="size-5" alt="">
                <span class="leading-[1.5]">{{ $listing->bathrooms }} bath</span>
            </div>
            <div class="flex items-end gap-[4px]">
                <img src="{{ asset('images/floor_gray.svg') }}" class="size-5" alt="">
                <span class="leading-[1.5]">{{ $listing->floor_number }}/{{ $listing->total_floors }}</span>
            </div>
        </div>

        <hr class="w-full h-px bg-[#E8E8E7] opacity-50 my-[20px]">

        <div class="flex items-end justify-between">
            <div class="flex items-end gap-[4px]">
                <span class="font-semibold text-[24px] text-[#1E1D1D] tracking-[-0.48px] leading-[1.28]">AED {{ number_format($listing->price) }}</span>
                <span class="font-medium text-[14px] text-[#1E1D1D] leading-[1.5]">{{ $listing->payment_option }}</span>
            </div>
            <p class="text-[12px] text-[#464646] leading-[1.5]">Utilities {{ strtolower($listing->utilities_option) }}</p>
        </div>
    </div>
</div>
