@props(['listing'])

<a href="{{ route('listings.show', $listing) }}" draggable="false" class="block w-full max-w-[380px] bg-white rounded-[8px] shadow-[0px_2px_16px_0px_rgba(0,0,0,0.06)] overflow-hidden group relative">
    <div class="relative h-[238px]">
        <img class="w-full h-full object-cover"
             draggable="false"
             src="{{ $listing->images->first() ? (Str::startsWith($listing->images->first()->image_url, 'http') ? $listing->images->first()->image_url : Illuminate\Support\Facades\Storage::url($listing->images->first()->image_url)) : asset('images/placeholder-image.png') }}"
             alt="{{ $listing->name }}">

        {{-- Decorative Arrows --}}
        <div class="absolute top-[107px] left-[10px] pointer-events-none">
            <img src="{{ asset('images/arrow.svg') }}" class="size-6 rotate-180 opacity-80" alt="">
        </div>
        <div class="absolute top-[107px] right-[10px] pointer-events-none">
            <img src="{{ asset('images/arrow.svg') }}" class="size-6 opacity-80" alt="">
        </div>

        <div class="absolute top-[12px] right-[12px]">
            <img src="{{ asset('images/favorite_white.svg') }}" draggable="false" alt="Favorite" class="size-[32px]">
        </div>
        <div class="absolute top-[219px] left-1/2 -translate-x-1/2">
            <img src="{{ asset('images/Dots.svg') }}" draggable="false" alt="Image carousel indicator" class="h-[7px] w-[82px]">
        </div>
    </div>
    <div class="p-[20px]">
        <h3 class="font-medium text-[20px] text-[#1E1D1D] tracking-[-0.4px] leading-[1.28] truncate">{{ $listing->name }}</h3>
        <p class="text-[14px] text-[#464646] leading-[1.5] mt-1 truncate">{{ $listing->address }}</p>

        <div class="flex items-center gap-x-[16px] text-[14px] text-[#464646] mt-[18px]">
            <div class="flex items-end gap-[3px]">
                <img src="{{ asset('images/activity_zone.svg') }}" class="size-5" alt="">
                <span class="leading-[1.5]">{{ $listing->area }} sqft</span>
            </div>
            <div class="flex items-end gap-[3px]">
                <img src="{{ asset('images/bed.svg') }}" class="size-5" alt="">
                <span class="leading-[1.5]">{{ $listing->bedrooms }} beds</span>
            </div>
            <div class="flex items-end gap-[4px]">
                <img src="{{ asset('images/bathtub.svg') }}" class="size-5" alt="">
                <span class="leading-[1.5]">{{ $listing->bathrooms }} bath</span>
            </div>
            <div class="flex items-end gap-[4px]">
                <img src="{{ asset('images/floor.svg') }}" class="size-5" alt="">
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
</a>
