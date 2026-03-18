@props(['images', 'name', 'aspectRatio' => 'h-[238px]'])

@php
    $processedImages = $images->map(function($image) {
        return Str::startsWith($image->image_url, 'http')
            ? $image->image_url
            : Illuminate\Support\Facades\Storage::url($image->image_url);
    });

    if ($processedImages->isEmpty()) {
        $processedImages->push(asset('images/placeholder-image.png'));
    }
@endphp

<div x-data="{
    currentIndex: 0,
    images: {{ $processedImages->toJson() }},
    next() {
        this.currentIndex = (this.currentIndex + 1) % this.images.length;
    },
    prev() {
        this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
    }
}" class="relative w-full {{ $aspectRatio }} flex-shrink-0 z-10">
    <div class="w-full h-full relative overflow-hidden bg-gray-100 rounded-inherit">
        <template x-for="(image, index) in images" :key="index">
            <img
                x-show="currentIndex === index"
                class="w-full h-full object-cover absolute inset-0"
                draggable="false"
                :src="image"
                alt="{{ $name }}"
                x-transition:enter="transition ease-in-out duration-500"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                x-transition:leave="transition ease-in-out duration-500"
                x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
            >
        </template>
    </div>

    <!-- Favorite Icon -->
    <button @click.stop.prevent="" class="absolute top-3 right-3 p-2 focus:outline-none z-20">
        <img src="{{ asset('images/favorite_white.svg') }}" alt="Favorite" class="w-8 h-8">
    </button>

    <!-- Image Navigation (Arrows) -->
    <div class="absolute inset-y-0 left-0 right-0 flex items-center justify-between px-2 pointer-events-none z-20">
        <button
            @click.stop.prevent="prev()"
            class="pointer-events-auto focus:outline-none opacity-80"
            x-show="images.length > 1"
        >
            <img src="{{ asset('images/arrow_left_white_notail.svg') }}" alt="Previous" class="w-6 h-6">
        </button>
        <button
            @click.stop.prevent="next()"
            class="pointer-events-auto focus:outline-none opacity-80"
            x-show="images.length > 1"
        >
            <img src="{{ asset('images/arrow1.svg') }}" alt="Next" class="w-6 h-6">
        </button>
    </div>

    <!-- Image Navigation (Dots) -->
    <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex space-x-1.5 z-20" x-show="images.length > 1">
        <template x-for="(image, index) in images" :key="index">
            <button
                @click.stop.prevent="currentIndex = index"
                class="size-[7px] rounded-full transition-all duration-300 focus:outline-none"
                :class="currentIndex === index ? 'bg-white w-[14px]' : 'bg-white/60'"
            ></button>
        </template>
    </div>
</div>
