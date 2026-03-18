@props(['listing'])

<div class="h-[238px] bg-white rounded-lg shadow-[0px_2px_10px_0px_rgba(0,0,0,0.1)] flex items-center group overflow-hidden relative">

    <!-- Main Card Link -->
    <a href="{{ route('listings.show', $listing->id) }}" class="absolute inset-0 z-0" aria-label="View listing details"></a>

    <!-- Image Section -->
    <div class="w-[380px] h-[238px] min-w-[380px]">
        <x-listings.listing-image-slider :images="$listing->images" :name="$listing->name" aspectRatio="h-[238px]" :url="route('listings.show', $listing->id)" />
    </div>

    <!-- Content Section -->
    <div class="pt-[24px] pb-[20px] pl-[26px] pr-[20px] flex-grow flex flex-col justify-between relative z-10 pointer-events-none h-full min-w-0">
        <div>
            <div class="flex justify-between items-start mb-[18px]">
                <div class="min-w-0">
                    <h3 class="text-[20px] leading-[1.28] tracking-[-0.4px] font-medium text-gray-900 truncate" title="{{ $listing->name }}">{{ $listing->name }}</h3>
                    <p class="text-[14px] text-gray-600 truncate" title="{{ $listing->address }}">{{ $listing->address }}</p>
                </div>
            </div>

            <div class="flex items-center gap-4 text-sm text-gray-600 mb-6">
                <div class="flex items-center gap-1">
                    <img src="{{ asset('images/activity_zone_gray.svg') }}" alt="Area Icon" class="w-5 h-5 text-gray-400">
                    <span>{{ $listing->area }} sqft</span>
                </div>
                <div class="flex items-center gap-1">
                    <img src="{{ asset('images/bed_gray.svg') }}" alt="Beds Icon" class="w-5 h-5 text-gray-400">
                    <span>{{ $listing->bedrooms }} beds</span>
                </div>
                <div class="flex items-center gap-1">
                    <img src="{{ asset('images/bathtub_gray.svg') }}" alt="Baths Icon" class="w-5 h-5 text-gray-400">
                    <span>{{ $listing->bathrooms }} bath</span>
                </div>
                <div class="flex items-center gap-1">
                    <img src="{{ asset('images/floor_gray.svg') }}" alt="Images Icon" class="w-5 h-5">
                    <span>{{ $listing->floor_number }}/{{ $listing->total_floors }}</span>
                </div>
            </div>
        </div>

        <div class="flex items-end justify-between">
            <div>
                <span class="text-2xl font-semibold text-gray-900">AED {{ number_format($listing->price) }}</span>
                <span class="text-sm font-medium text-gray-900"> {{ $listing->payment_option }}</span>
            </div>
            <span class="text-[12px] text-gray-600">Utilities {{ strtolower($listing->utilities_option) }}</span>
        </div>
    </div>
</div>
