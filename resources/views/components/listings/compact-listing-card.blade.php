@props(['listing'])

<a href="{{ route('listings.show', $listing) }}" class="block rounded-lg shadow-[0px_2px_16px_0px_rgba(0,0,0,0.06)] bg-white overflow-hidden group">
    <div class="relative h-[225px]">
        <img class="w-full h-full object-cover" src="{{ $listing->images->first()->image_path ?? asset('images/candice-picard-vLENm-coX5Y-unsplash-1.png') }}" alt="{{ $listing->title }}">
        <div class="absolute top-3 right-3">
            <img src="{{ asset('images/favorite_white.svg') }}" alt="Favorite" class="size-8">
        </div>
        <div class="absolute bottom-4 left-1/2 -translate-x-1/2">
            <img src="{{ asset('images/Dots.svg') }}" alt="Dots" class="h-[7px] w-[82px]">
        </div>
    </div>
    <div class="p-5 flex flex-col h-[192px]">
        <h3 class="text-xl font-medium text-black tracking-tight leading-tight">{{ $listing->title }}</h3>
        <p class="text-sm text-[#464646] mt-1">{{ $listing->address }}</p>

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-x-4 gap-y-2 text-sm text-[#464646] mt-4">
            <div class="flex items-center gap-1">
                <img src="{{ asset('images/activity_zone.svg') }}" class="size-5" alt="">
                <span>{{ $listing->area_sqft }} sqft</span>
            </div>
            <div class="flex items-center gap-1">
                <img src="{{ asset('images/bed.svg') }}" class="size-5" alt="">
                <span>{{ $listing->bedrooms }} beds</span>
            </div>
            <div class="flex items-center gap-1">
                <img src="{{ asset('images/bathtub.svg') }}" class="size-5" alt="">
                <span>{{ $listing->bathrooms }} bath</span>
            </div>
            <div class="flex items-center gap-1">
                <img src="{{ asset('images/floor.svg') }}" class="size-5" alt="">
                <span>{{ $listing->floor_number }}/{{ $listing->total_floors }}</span>
            </div>
        </div>

        <hr class="mt-auto mb-4 opacity-50">

        <div class="flex items-end justify-between">
            <div>
                <span class="text-2xl font-semibold text-black">AED {{ number_format($listing->price) }}</span>
                <span class="text-sm font-medium text-black">Yearly</span>
            </div>
            <p class="text-xs text-[#464646]">Utilities excluded</p>
        </div>
    </div>
</a>
