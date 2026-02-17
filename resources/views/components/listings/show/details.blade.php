@props(['listing'])

<div>
    <h2 class="text-[24px] font-medium text-black tracking-[-0.48px] leading-[1.28] mb-1">Apartment for rent</h2>
    <p class="text-[14px] text-[#464646] leading-[1.5] mb-4">{{ $listing->address }}</p>

    <div class="flex items-center gap-[16px]">
        <div class="flex items-end gap-[3px]">
            <img src="{{ asset('images/activity_zone.svg') }}" alt="Area" class="w-[22px] h-[22px]">
            <span class="text-[16px] text-[#464646] leading-[1.5]">{{ $listing->area }} sqft</span>
        </div>
        <div class="flex items-end gap-[3px]">
            <img src="{{ asset('images/bed.svg') }}" alt="Bedrooms" class="w-[22px] h-[22px]">
            <span class="text-[16px] text-[#464646] leading-[1.5]">{{ $listing->bedrooms }} beds</span>
        </div>
        <div class="flex items-end gap-[4px]">
            <img src="{{ asset('images/bathtub.svg') }}" alt="Bathrooms" class="w-[22px] h-[22px]">
            <span class="text-[16px] text-[#464646] leading-[1.5]">{{ $listing->bathrooms }} bath</span>
        </div>
        <div class="flex items-end gap-[4px]">
            <img src="{{ asset('images/floor.svg') }}" alt="Floor" class="w-[22px] h-[22px]">
            <span class="text-[16px] text-[#464646] leading-[1.5]">{{ $listing->floor_number }}/{{ $listing->total_floors }}</span>
        </div>
    </div>
</div>
