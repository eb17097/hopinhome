@props(['listing'])
@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
    // Prepare a JSON-encoded array of all image URLs for Alpine.js
    $imageUrls = $listing->images->map(function ($image) {
        return Str::startsWith($image->image_url, 'http') ? $image->image_url : Storage::url($image->image_url);
    });
@endphp

<div x-data="{
        isSliderOpen: false,
        currentImageIndex: 0,
        images: {{ $imageUrls }},
        openSlider(index) {
            this.currentImageIndex = index;
            this.isSliderOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeSlider() {
            this.isSliderOpen = false;
            document.body.style.overflow = 'auto';
        },
        nextImage() {
            this.currentImageIndex = (this.currentImageIndex + 1) % this.images.length;
        },
        prevImage() {
            this.currentImageIndex = (this.currentImageIndex - 1 + this.images.length) % this.images.length;
        }
    }"
    @keydown.escape.window="closeSlider()"
    @keydown.arrow-right.window="nextImage()"
    @keydown.arrow-left.window="prevImage()"
    class="mt-6 relative">

    {{-- Gallery Display --}}
    <div class="grid grid-cols-2 gap-[16px]">
        {{-- Main Image --}}
        <div class="col-span-1">
            @if($listing->images->first())
                <img @click="openSlider(0)" src="{{ $imageUrls[0] }}" alt="{{ $listing->name }}" class="w-full h-[499px] object-cover rounded-tl-[14px] rounded-bl-[14px] cursor-pointer">
            @else
                <div class="w-full h-[499px] bg-gray-200 rounded-tl-[14px] rounded-bl-[14px]"></div>
            @endif
        </div>
        
        {{-- Side Images --}}
        <div class="col-span-1 grid grid-rows-2 gap-[16px]">
            @if($imageUrls->get(1))
                <img @click="openSlider(1)" src="{{ $imageUrls[1] }}" alt="{{ $listing->name }}" class="w-full h-[241.5px] object-cover rounded-tr-[14px] cursor-pointer">
            @else
                <div class="w-full h-[241.5px] bg-gray-200 rounded-tr-[14px]"></div>
            @endif

            @if($imageUrls->get(2))
                <img @click="openSlider(2)" src="{{ $imageUrls[2] }}" alt="{{ $listing->name }}" class="w-full h-[241.5px] object-cover rounded-br-[14px] cursor-pointer">
            @else
                <div class="w-full h-[241.5px] bg-gray-200 rounded-br-[14px]"></div>
            @endif
        </div>
    </div>

    {{-- "All Photos" Button --}}
    @if($imageUrls->count() > 3)
    <button @click="openSlider(3)" class="absolute bottom-[24px] right-[24px] backdrop-blur-[3px] bg-black/30 text-white font-medium text-[16px] py-[6px] px-[12px] rounded-[4px] flex items-center space-x-[4px]">
        <img src="{{ asset('images/filter.svg') }}" alt="All photos" class="w-[16px] h-[16px]">
        <span>{{ $imageUrls->count() }}</span>
    </button>
    @endif

    {{-- Full-Screen Slider Modal --}}
    <template x-if="isSliderOpen">
        <div class="fixed inset-0 bg-black/90 z-50 flex items-center justify-center" @click.self="closeSlider()">
            <!-- Close Button -->
            <button @click="closeSlider()" class="absolute top-10 left-10 z-50">
                <img src="{{ asset('images/close_white.svg') }}" alt="Close" class="w-6 h-6">
            </button>

            <!-- Image Counter -->
            <div class="absolute top-10 right-10 text-white text-lg z-50">
                <span x-text="currentImageIndex + 1"></span> / <span x-text="images.length"></span>
            </div>

            <!-- Main Image Display -->
            <div class="relative w-full h-full flex items-center justify-center">
                <img :src="images[currentImageIndex]" class="max-w-[80vw] max-h-[80vh] object-contain">
            </div>

            <!-- Previous Button -->
            <button @click="prevImage()" class="absolute left-10 top-1/2 -translate-y-1/2 bg-white/20 rounded-full p-3 text-white z-50 hover:bg-white/30 transition">
                <img src="{{ asset('images/arrow_left_white_notail.svg') }}" alt="Previous" class="w-6 h-6">
            </button>

            <!-- Next Button -->
            <button @click="nextImage()" class="absolute right-10 top-1/2 -translate-y-1/2 bg-white/20 rounded-full p-3 text-white z-50 hover:bg-white/30 transition">
                <img src="{{ asset('images/arrow1.svg') }}" alt="Next" class="w-6 h-6">
            </button>
        </div>
    </template>
</div>
