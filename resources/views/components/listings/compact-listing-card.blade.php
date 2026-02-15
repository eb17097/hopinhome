@props(['listing'])

<a href="{{ route('listings.show', $listing) }}" class="block w-[358px] h-[437px] rounded-lg shadow-[0px_2px_16px_0px_rgba(0,0,0,0.06)] bg-white overflow-hidden group">
    <div class="relative h-[225px]">
        {{-- Use the first image or a placeholder --}}
        <img class="w-full h-full object-cover" src="{{ $listing->images->first()->image_path ?? asset('images/candice-picard-vLENm-coX5Y-unsplash-1.png') }}" alt="{{ $listing->title }}">
        <div class="absolute top-[12px] right-[12px]">
            <img src="{{ asset('images/favorite_white.svg') }}" alt="Favorite" class="size-[32px]">
        </div>
        <div class="absolute top-[206px] left-1/2 -translate-x-1/2">
            <img src="{{ asset('images/Dots.svg') }}" alt="Image carousel indicator" class="h-[7px] w-[82px]">
        </div>
    </div>
    <div class="pt-[24px] px-[20px] pb-[16px] flex flex-col">
        <h3 class="text-[20px] font-medium text-black tracking-[-0.4px] leading-[1.28]">{{ $listing->title }}</h3>
        <p class="text-[14px] text-[#464646] leading-[1.5] mt-1">{{ $listing->address }}</p>

        <div class="flex items-center gap-x-[16px] text-sm text-[#464646] mt-[19px]">
            <div class="flex items-end gap-[3px]">
                <img src="{{ asset('images/activity_zone.svg') }}" class="size-5" alt="">
                <span class="leading-[1.5]">{{ $listing->area_sqft }} sqft</span>
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
                <span class="text-[24px] font-semibold text-black tracking-[-0.48px] leading-[1.28]">AED {{ number_format($listing->price) }}</span>
                <span class="text-[14px] font-medium text-black leading-[1.5]">Yearly</span>
            </div>
            <p class="text-[12px] text-[#464646] leading-[1.5]">Utilities excluded</p>
        </div>
    </div>
</a>
