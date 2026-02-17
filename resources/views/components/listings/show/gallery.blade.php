@props(['listing'])
@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
    $imageUrls = $listing->images->map(function ($image) {
        return Str::startsWith($image->image_url, 'http') ? $image->image_url : Storage::url($image->image_url);
    });
@endphp

<div x-data="{
        isSliderOpen: false,
        isVideoModalOpen: false,
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
        },
        openVideoModal() {
            this.isVideoModalOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeVideoModal() {
            this.isVideoModalOpen = false;
            if (this.$refs.videoPlayer) {
                this.$refs.videoPlayer.pause();
            }
            document.body.style.overflow = 'auto';
        }
    }"
    @keydown.escape.window="isSliderOpen ? closeSlider() : (isVideoModalOpen ? closeVideoModal() : null)"
    @keydown.arrow-right.window="if(isSliderOpen) nextImage()"
    @keydown.arrow-left.window="if(isSliderOpen) prevImage()"
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

    {{-- Overlay Buttons --}}
    <div class="absolute bottom-[24px] left-[24px] flex space-x-[16px]">
        <a href="#location" @click.prevent="document.getElementById('location').scrollIntoView({ behavior: 'smooth' })" class="backdrop-blur-[3px] bg-black/30 text-white font-medium text-[14px] py-[10px] px-[16px] rounded-[4px] flex items-center space-x-[8px] hover:bg-black/50 transition">
            <img src="{{ asset('images/location_on.svg') }}" alt="Map" class="w-[28px] h-[28px]">
            <span>View map</span>
        </a>
        @if($listing->video_url)
        <button @click="openVideoModal()" class="backdrop-blur-[3px] bg-black/30 text-white font-medium text-[14px] py-[10px] px-[16px] rounded-[4px] flex items-center space-x-[8px] hover:bg-black/50 transition">
            <img src="{{ asset('images/play_arrow.svg') }}" alt="Video" class="w-[30px] h-[30px]">
            <span>Watch video tour</span>
        </button>
        @endif
    </div>

    @if($imageUrls->count() > 3)
    <button @click="openSlider(3)" class="absolute bottom-[24px] right-[24px] backdrop-blur-[3px] bg-black/30 text-white font-medium text-[16px] py-[6px] px-[12px] rounded-[4px] flex items-center space-x-[4px]">
        <img src="{{ asset('images/filter.svg') }}" alt="All photos" class="w-[16px] h-[16px]">
        <span>{{ $imageUrls->count() }}</span>
    </button>
    @endif

    {{-- Full-Screen Slider Modal --}}
    <template x-if="isSliderOpen">
        <div class="fixed inset-0 bg-black/90 z-50 flex items-center justify-center" @click.self="closeSlider()">
            <button @click="closeSlider()" class="absolute top-10 left-10 z-50">
                <img src="{{ asset('images/close_white.svg') }}" alt="Close" class="w-6 h-6">
            </button>
            <div class="absolute top-10 right-10 text-white text-lg z-50">
                <span x-text="currentImageIndex + 1"></span> / <span x-text="images.length"></span>
            </div>
            <div class="relative w-full h-full flex items-center justify-center">
                <img :src="images[currentImageIndex]" class="max-w-[80vw] max-h-[80vh] object-contain">
            </div>
            <button @click="prevImage()" class="absolute left-10 top-1/2 -translate-y-1/2 bg-white/20 rounded-full p-3 text-white z-50 hover:bg-white/30 transition">
                <img src="{{ asset('images/arrow_left_white_notail.svg') }}" alt="Previous" class="w-6 h-6">
            </button>
            <button @click="nextImage()" class="absolute right-10 top-1/2 -translate-y-1/2 bg-white/20 rounded-full p-3 text-white z-50 hover:bg-white/30 transition">
                <img src="{{ asset('images/arrow1.svg') }}" alt="Next" class="w-6 h-6">
            </button>
        </div>
    </template>
    
    <!-- Video Modal -->
    @if($listing->video_url)
    <template x-if="isVideoModalOpen">
        <div x-init="$watch('isVideoModalOpen', value => { if (value) { $nextTick(() => $refs.videoPlayer.play()) } })" class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen p-4 text-center">
                <div class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true" @click="closeVideoModal()"></div>
                <div class="inline-block bg-black rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 w-full max-w-4xl" @click.stop>
                    <div class="relative">
                        <video x-ref="videoPlayer" class="w-full h-auto" src="{{ Str::startsWith($listing->video_url, 'http') ? $listing->video_url : Storage::url($listing->video_url) }}" controls></video>
                        <button @click="closeVideoModal()" class="absolute top-4 right-4 text-white">
                            <img src="{{ asset('images/close_white.svg') }}" alt="Close" class="w-6 h-6">
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </template>
    @endif
</div>
