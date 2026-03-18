@props(['listing'])

<div class="block w-full max-w-[380px] bg-white rounded-[8px] shadow-[0px_2px_16px_0px_rgba(0,0,0,0.06)] overflow-hidden group relative">

    <!-- Main Card Link -->
    <a href="{{ route('listings.show', $listing) }}" class="absolute inset-0 z-0" aria-label="View listing details"></a>

    <div class="relative h-[238px] z-10">
        <x-listings.listing-image-slider :images="$listing->images" :name="$listing->name" aspectRatio="h-[238px]" :url="route('listings.show', $listing)" />
    </div>

    <div class="p-[20px] relative z-10 pointer-events-none">
        <h3 class="font-medium text-[20px] text-[#1E1D1D] tracking-[-0.4px] leading-[1.28] truncate" title="{{ $listing->name }}">{{ $listing->name }}</h3>
        <p class="text-[14px] text-[#464646] leading-[1.5] mt-1 truncate" title="{{ $listing->address }}">{{ $listing->address }}</p>

        <div class="flex items-center gap-x-[16px] text-[14px] text-[#464646] mt-[18px]">
            <div class="flex items-end gap-[3px]">
                <img src="{{ asset('images/activity_zone_gray.svg') }}" class="size-5" alt="">
                <span class="leading-[1.5]">{{ $listing->area }} sqft</span>
            </div>
            <div class="flex items-end gap-[3px]">
                <img src="{{ asset('images/bed_gray.svg') }}" alt="" class="size-5">
                <span class="leading-[1.5]">{{ $listing->bedrooms }} beds</span>
            </div>
            <div class="flex items-end gap-[4px]">
                <img src="{{ asset('images/bathtub_gray.svg') }}" alt="" class="size-5">
                <span class="leading-[1.5]">{{ $listing->bathrooms }} bath</span>
            </div>
            <div class="flex items-end gap-[4px]">
                <img src="{{ asset('images/floor_gray.svg') }}" alt="" class="size-5">
                <span class="leading-[1.5]">{{ $listing->floor_number }}/{{ $listing->total_floors }}</span>
            </div>
        </div>

    </div>

    <hr class="w-full h-px bg-[#E8E8E7] opacity-50">

    <div class="py-[18px] px-[20px] relative z-10 pointer-events-none">
        <div class="flex items-end justify-between">
            <div class="flex items-end gap-[4px]">
                <span class="font-semibold text-[24px] text-[#1E1D1D] tracking-[-0.48px] leading-[1.28]">AED {{ number_format($listing->price) }}</span>
                <span class="font-medium text-[14px] text-[#1E1D1D] leading-[1.5]">{{ $listing->payment_option }}</span>
            </div>
            <p class="text-[12px] text-[#464646] leading-[1.5]">Utilities {{ strtolower($listing->utilities_option) }}</p>
        </div>
    </div>
</div>
