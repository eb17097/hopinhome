@props(['listing'])

<div class="mt-6 relative">
    <div class="grid grid-cols-3 gap-2">
        {{-- Main Image --}}
        <div class="col-span-2">
            @if($listing->images->first())
                <img src="{{ $listing->images->first()->image_url }}" alt="{{ $listing->name }}" class="w-full h-[499px] object-cover rounded-tl-[14px] rounded-bl-[14px]">
            @else
                <div class="w-full h-[499px] bg-gray-200 rounded-tl-[14px] rounded-bl-[14px]"></div>
            @endif
        </div>
        
        {{-- Side Images --}}
        <div class="col-span-1 grid grid-rows-2 gap-2">
            @if($listing->images->get(1))
                <img src="{{ $listing->images->get(1)->image_url }}" alt="{{ $listing->name }}" class="w-full h-[245px] object-cover rounded-tr-[14px]">
            @else
                <div class="w-full h-[245px] bg-gray-200 rounded-tr-[14px]"></div>
            @endif

            @if($listing->images->get(2))
                <img src="{{ $listing->images->get(2)->image_url }}" alt="{{ $listing->name }}" class="w-full h-[245px] object-cover rounded-br-[14px]">
            @else
                <div class="w-full h-[245px] bg-gray-200 rounded-br-[14px]"></div>
            @endif
        </div>
    </div>

    {{-- Overlay Buttons --}}
    <div class="absolute bottom-6 left-6 flex space-x-2">
        <button class="backdrop-blur-sm bg-black/30 text-white font-medium text-sm py-2 px-4 rounded-md flex items-center space-x-2">
            <img src="{{ asset('images/location_on.svg') }}" alt="Map" class="w-5 h-5">
            <span>View map</span>
        </button>
        @if($listing->video_url)
        <a href="{{$listing->video_url}}" target="_blank" class="backdrop-blur-sm bg-black/30 text-white font-medium text-sm py-2 px-4 rounded-md flex items-center space-x-2">
            <img src="{{ asset('images/play_arrow.svg') }}" alt="Video" class="w-5 h-5">
            <span>Watch video tour</span>
        </a>
        @endif
    </div>

    @if($listing->images->count() > 3)
    <button class="absolute bottom-6 right-6 backdrop-blur-sm bg-black/30 text-white font-medium text-sm py-2 px-3 rounded-md flex items-center space-x-2">
        <img src="{{ asset('images/filter.svg') }}" alt="All photos" class="w-4 h-4">
        <span>{{ $listing->images->count() }}</span>
    </button>
    @endif
</div>
