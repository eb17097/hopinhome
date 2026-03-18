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
        isPhotoTourOpen: false,
        currentImageIndex: 0,
        images: {{ $imageUrls }},
        openPhotoTour() {
            this.isPhotoTourOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closePhotoTour() {
            this.isPhotoTourOpen = false;
            document.body.style.overflow = 'auto';
        },
        openSlider(index) {
            this.currentImageIndex = index;
            this.isSliderOpen = true;
            document.body.style.overflow = 'hidden';
        },
        closeSlider() {
            this.isSliderOpen = false;
            if (!this.isPhotoTourOpen && !this.isVideoModalOpen) {
                document.body.style.overflow = 'auto';
            }
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
                this.videoIsPlaying = false;
            }
            if (!this.isPhotoTourOpen) {
                document.body.style.overflow = 'auto';
            }
        },
        videoIsPlaying: false,
        videoCurrentTime: 0,
        videoDuration: 0,
        toggleVideo() {
            if (this.$refs.videoPlayer.paused) {
                this.$refs.videoPlayer.play();
                this.videoIsPlaying = true;
            } else {
                this.$refs.videoPlayer.pause();
                this.videoIsPlaying = false;
            }
        },
        formatTime(seconds) {
            if (isNaN(seconds)) return '0:00';
            const minutes = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${minutes}:${secs.toString().padStart(2, '0')}`;
        }
    }"
    @keydown.escape.window="isSliderOpen ? closeSlider() : (isPhotoTourOpen ? closePhotoTour() : (isVideoModalOpen ? closeVideoModal() : null))"
    @keydown.arrow-right.window="if(isSliderOpen) nextImage()"
    @keydown.arrow-left.window="if(isSliderOpen) prevImage()"
    class="mt-6 relative">

    {{-- Gallery Display --}}
    <div class="grid grid-cols-3 gap-[8px]">
        {{-- Main Image --}}
        <div class="col-span-2">
            @if($listing->images->first())
                <img @click="openPhotoTour()" src="{{ $imageUrls[0] }}" alt="{{ $listing->name }}" class="w-full h-[499px] object-cover rounded-tl-[14px] rounded-bl-[14px] cursor-pointer">
            @else
                <div class="w-full h-[499px] bg-gray-200 rounded-tl-[14px] rounded-bl-[14px]"></div>
            @endif
        </div>

        {{-- Side Images --}}
        <div class="col-span-1 grid grid-rows-2 gap-[8px]">
            @if($imageUrls->get(1))
                <img @click="openPhotoTour()" src="{{ $imageUrls[1] }}" alt="{{ $listing->name }}" class="w-full h-[245.5px] object-cover rounded-tr-[14px] cursor-pointer">
            @else
                <div class="w-full h-[245.5px] bg-gray-200 rounded-tr-[14px]"></div>
            @endif

            @if($imageUrls->get(2))
                <img @click="openPhotoTour()" src="{{ $imageUrls[2] }}" alt="{{ $listing->name }}" class="w-full h-[245.5px] object-cover rounded-br-[14px] cursor-pointer">
            @else
                <div class="w-full h-[245.5px] bg-gray-200 rounded-br-[14px]"></div>
            @endif
        </div>
    </div>

    {{-- Overlay Buttons --}}
    <div class="absolute bottom-[24px] left-[24px] flex space-x-[16px] h-[40px]">
        <a href="#location" @click.prevent="document.getElementById('location').scrollIntoView({ behavior: 'smooth' })" class="justify-end w-[119px] text-white font-medium text-[14px] py-[10px] pr-[16px] rounded-[4px] flex items-center hover:opacity-90 transition bg-cover bg-center" style="background-image: url('{{ asset('images/view-map-btn.png') }}')">
            <img src="{{ asset('images/location_white.svg') }}" alt="Map" class="w-[28px] h-[28px]">
            <span class="ml-[5px]">View map</span>
        </a>
        @if($listing->video_url)
        <button @click="openVideoModal()" class="justify-end backdrop-blur-[3px] w-[165px] bg-black/20 text-white font-medium text-[14px] py-[11px] pr-[16px] rounded-[4px] flex items-center hover:bg-black/50 transition">
            <img src="{{ asset('images/play_arrow.svg') }}" alt="Video" class="w-[30px] h-[30px]">
            <span class="ml-[4px]">Watch video tour</span>
        </button>
        @endif
    </div>

    @if($imageUrls->count() > 0)
    <button @click="openPhotoTour()" class="absolute bottom-[24px] right-[24px] backdrop-blur-[3px] bg-black/20 text-white font-medium text-[16px] w-[51px] h-[26px] rounded-[4px] flex items-center justify-center gap-[4px] hover:bg-black/40 transition">
        <img src="{{ asset('images/gallery_img_count.svg') }}" alt="All photos" class="w-[16px] h-[16px]">
        <span>{{ $imageUrls->count() }}</span>
    </button>
    @endif

    {{-- Photo Tour Modal --}}
    <template x-if="isPhotoTourOpen">
        <div class="fixed inset-0 bg-black/60 z-[60] flex justify-center" @click.self="closePhotoTour()">
            <div class="w-full max-w-[1360px] bg-white flex flex-col overflow-hidden my-[40px] rounded-[14px]">
                {{-- Header --}}
                <div class="h-[64px] border-b border-[#E8E8E7] flex items-center px-[24px] flex-shrink-0">
                    <button @click="closePhotoTour()" class="p-2 -ml-2 hover:bg-gray-100 rounded-full transition">
                        <img src="{{ asset('images/close_blue.svg') }}" alt="Close" class="w-6 h-6">
                    </button>
                    <h2 class="absolute left-1/2 -translate-x-1/2 text-[18px] font-medium text-[#1B1B18]">Photo tour</h2>
                </div>

                {{-- Content --}}
                <div class="flex-1 overflow-y-auto bg-white py-[48px]">
                    <div class="max-w-[792px] mx-auto">
                        <div class="flex flex-col gap-[8px]">
                            @foreach($imageUrls as $index => $url)
                                @if($index % 3 == 0)
                                    {{-- Full width image --}}
                                    <img @click="openSlider({{ $index }})" src="{{ $url }}" alt="Photo {{ $index + 1 }}" class="w-full h-[499px] object-cover cursor-pointer hover:opacity-95 transition">
                                @else
                                    {{-- Two images side by side --}}
                                    @if($index % 3 == 1)
                                        <div class="grid grid-cols-2 gap-[8px]">
                                            <img @click="openSlider({{ $index }})" src="{{ $url }}" alt="Photo {{ $index + 1 }}" class="w-full h-[239px] object-cover cursor-pointer hover:opacity-95 transition">
                                            @if(isset($imageUrls[$index + 1]))
                                                <img @click="openSlider({{ $index + 1 }})" src="{{ $imageUrls[$index + 1] }}" alt="Photo {{ $index + 2 }}" class="w-full h-[239px] object-cover rounded-[12px] cursor-pointer hover:opacity-95 transition">
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>

    {{-- Full-Screen Slider Modal --}}
    <template x-if="isSliderOpen">
        <div class="fixed inset-0 bg-black/90 z-[70] flex items-center justify-center" @click.self="closeSlider()">
            <button @click="closeSlider()" class="absolute left-[64px] top-[62px] z-[80]">
                <img src="{{ asset('images/close_white.svg') }}" alt="Close" class="w-6 h-6">
            </button>
            <div class="absolute right-[64px] top-[62px] text-white text-lg z-50">
                <span x-text="currentImageIndex + 1"></span> / <span x-text="images.length"></span>
            </div>
            <div class="relative w-full h-full flex items-center justify-center">
                <img :src="images[currentImageIndex]" class="max-w-[938px] max-h-[592px] w-full object-contain">
            </div>
            <button @click="prevImage()" class="absolute left-[64px] top-1/2 -translate-y-1/2 bg-white/20 rounded-full p-3 text-white z-50 hover:bg-white/30 transition">
                <img src="{{ asset('images/arrow_left_white_notail.svg') }}" alt="Previous" class="w-6 h-6">
            </button>
            <button @click="nextImage()" class="absolute right-[64px] top-1/2 -translate-y-1/2 bg-white/20 rounded-full p-3 text-white z-50 hover:bg-white/30 transition">
                <img src="{{ asset('images/arrow1.svg') }}" alt="Next" class="w-6 h-6">
            </button>
        </div>
    </template>

    <!-- Video Modal -->
    @if($listing->video_url)
    <template x-if="isVideoModalOpen">
        <div class="fixed inset-0 bg-black/60 z-[60] flex items-center justify-center" @click.self="closeVideoModal()">
            <div class="w-full max-w-[408px] bg-white rounded-[14px] shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] overflow-hidden flex flex-col" @click.stop>
                {{-- Header --}}
                <div class="h-[64px] border-b border-[#E8E8E7] flex items-center px-[24px] relative flex-shrink-0">
                    <button @click="closeVideoModal()" class="p-2 -ml-2 hover:bg-gray-100 rounded-full transition">
                        <img src="{{ asset('images/close_blue.svg') }}" alt="Close" class="w-6 h-6">
                    </button>
                    <h2 class="absolute left-1/2 -translate-x-1/2 text-[18px] font-medium text-[#1B1B18]">Video tour</h2>
                </div>

                {{-- Content --}}
                <div class="p-[16px]">
                    <div class="relative aspect-[9/16] bg-black rounded-[10px] overflow-hidden group">
                        <video
                            x-ref="videoPlayer"
                            class="w-full h-full object-cover"
                            src="{{ Str::startsWith($listing->video_url, 'http') ? $listing->video_url : Storage::url($listing->video_url) }}"
                            @click="toggleVideo()"
                            @timeupdate="videoCurrentTime = $el.currentTime"
                            @loadedmetadata="videoDuration = $el.duration"
                            @ended="videoIsPlaying = false"
                        ></video>

                        {{-- Agent Overlay --}}
                        <div class="absolute top-[16px] left-[16px] flex items-center gap-[12px] z-10">
                            <div class="w-[40px] h-[40px] rounded-full overflow-hidden border-2 border-white">
                                <img src="{{ $listing->user->profile_photo_url ?? asset('images/user-placeholder.svg') }}" alt="{{ $listing->user->name }}" class="w-full h-full object-cover">
                            </div>
                            <div class="flex items-center gap-[4px]">
                                <span class="text-white font-medium text-[16px] shadow-sm">{{ $listing->user->name }}</span>
                                @if($listing->user->is_agent)
                                    <img src="{{ asset('images/verified_user.svg') }}" alt="Verified" class="w-[16px] h-[16px]">
                                @endif
                            </div>
                        </div>

                        {{-- Center Play Button --}}
                        <button
                            @click="toggleVideo()"
                            class="absolute inset-0 flex items-center justify-center bg-black/40 transition-opacity duration-300"
                            x-show="!videoIsPlaying"
                            x-transition
                        >
                            <div class="w-[64px] h-[64px] rounded-full flex items-center justify-center">
                                <img src="{{ asset('images/video_tour_play_button.svg') }}" alt="Play" class="w-[64px] h-[64px] brightness-0 invert">
                            </div>
                        </button>

                        {{-- Bottom Controls --}}
                        <div class="absolute bottom-0 left-0 right-0 p-[16px] pt-[40px] bg-gradient-to-t from-black/60 to-transparent">
                            {{-- Progress Bar --}}
                            <div class="relative h-[4px] bg-white/30 rounded-full mb-[12px] cursor-pointer" @click="const rect = $el.getBoundingClientRect(); $refs.videoPlayer.currentTime = (($event.clientX - rect.left) / rect.width) * videoDuration">
                                <div class="absolute top-0 left-0 h-full bg-white rounded-full" :style="`width: ${(videoCurrentTime / videoDuration) * 100}%` "></div>
                                <div class="absolute top-1/2 -translate-y-1/2 w-[12px] h-[12px] bg-white rounded-full shadow-md" :style="`left: ${(videoCurrentTime / videoDuration) * 100}%` "></div>
                            </div>
                            {{-- Time --}}
                            <div class="flex justify-between text-white text-[12px] font-medium">
                                <span x-text="formatTime(videoCurrentTime)">0:00</span>
                                <span x-text="formatTime(videoDuration)">0:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    @endif
</div>
