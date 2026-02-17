@props(['listing'])
@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp

<div x-data="{ isVideoModalOpen: false }" @keydown.escape.window="isVideoModalOpen = false" x-init="$watch('isVideoModalOpen', value => { 
    if (value) {
        $nextTick(() => $refs.videoPlayer.play());
    } else {
        $refs.videoPlayer.pause();
    }
})" class="mt-6 relative">
    <div class="grid grid-cols-2 gap-[16px]">
        {{-- Main Image --}}
        <div class="col-span-1">
            @if($listing->images->first())
                <img src="{{ Str::startsWith($listing->images->first()->image_url, 'http') ? $listing->images->first()->image_url : Storage::url($listing->images->first()->image_url) }}" alt="{{ $listing->name }}" class="w-full h-[499px] object-cover rounded-tl-[14px] rounded-bl-[14px]">
            @else
                <div class="w-full h-[499px] bg-gray-200 rounded-tl-[14px] rounded-bl-[14px]"></div>
            @endif
        </div>
        
        {{-- Side Images --}}
        <div class="col-span-1 grid grid-rows-2 gap-[16px]">
            @if($listing->images->get(1))
                <img src="{{ Str::startsWith($listing->images->get(1)->image_url, 'http') ? $listing->images->get(1)->image_url : Storage::url($listing->images->get(1)->image_url) }}" alt="{{ $listing->name }}" class="w-full h-[241.5px] object-cover rounded-tr-[14px]">
            @else
                <div class="w-full h-[241.5px] bg-gray-200 rounded-tr-[14px]"></div>
            @endif

            @if($listing->images->get(2))
                <img src="{{ Str::startsWith($listing->images->get(2)->image_url, 'http') ? $listing->images->get(2)->image_url : Storage::url($listing->images->get(2)->image_url) }}" alt="{{ $listing->name }}" class="w-full h-[241.5px] object-cover rounded-br-[14px]">
            @else
                <div class="w-full h-[241.5px] bg-gray-200 rounded-br-[14px]"></div>
            @endif
        </div>
    </div>

    {{-- Overlay Buttons --}}
    <div class="absolute bottom-[24px] left-[24px] flex space-x-[16px]">
        <a href="#" class="backdrop-blur-[3px] bg-black/30 text-white font-medium text-[14px] py-[10px] px-[16px] rounded-[4px] flex items-center space-x-[8px]">
            <img src="{{ asset('images/location_on.svg') }}" alt="Map" class="w-[28px] h-[28px]">
            <span>View map</span>
        </a>
        @if($listing->video_url)
        <button @click="isVideoModalOpen = true" class="backdrop-blur-[3px] bg-black/30 text-white font-medium text-[14px] py-[10px] px-[16px] rounded-[4px] flex items-center space-x-[8px]">
            <img src="{{ asset('images/play_arrow.svg') }}" alt="Video" class="w-[30px] h-[30px]">
            <span>Watch video tour</span>
        </button>
        @endif
    </div>

    @if($listing->images->count() > 3)
    <button class="absolute bottom-[24px] right-[24px] backdrop-blur-[3px] bg-black/30 text-white font-medium text-[16px] py-[6px] px-[12px] rounded-[4px] flex items-center space-x-[4px]">
        <img src="{{ asset('images/filter.svg') }}" alt="All photos" class="w-[16px] h-[16px]">
        <span>{{ $listing->images->count() }}</span>
    </button>
    @endif

    <!-- Video Modal -->
    @if($listing->video_url)
    <div x-show="isVideoModalOpen" style="display: none;" class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div x-show="isVideoModalOpen"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

            <div x-show="isVideoModalOpen"
                 @click.away="isVideoModalOpen = false"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="inline-block bg-black rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 w-full max-w-4xl"
                 @click.stop>
                
                <div class="relative">
                    <video x-ref="videoPlayer" class="w-full h-auto" src="{{ Str::startsWith($listing->video_url, 'http') ? $listing->video_url : Storage::url($listing->video_url) }}" controls></video>
                    <button @click="isVideoModalOpen = false" class="absolute top-4 right-4 text-white">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
