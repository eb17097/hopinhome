@props(['listing'])

<div class="flex items-center space-x-8">
    <div class="flex items-center space-x-2">
        <img src="{{ asset('images/activity_zone.svg') }}" alt="Area" class="w-6 h-6">
        <span class="text-base text-gray-700">{{ $listing->area }} sqft</span>
    </div>
    <div class="flex items-center space-x-2">
        <img src="{{ asset('images/bed.svg') }}" alt="Bedrooms" class="w-6 h-6">
        <span class="text-base text-gray-700">{{ $listing->bedrooms }} beds</span>
    </div>
    <div class="flex items-center space-x-2">
        <img src="{{ asset('images/bathtub.svg') }}" alt="Bathrooms" class="w-6 h-6">
        <span class="text-base text-gray-700">{{ $listing->bathrooms }} bath</span>
    </div>
    <div class="flex items-center space-x-2">
        <img src="{{ asset('images/floor.svg') }}" alt="Floor" class="w-6 h-6">
        <span class="text-base text-gray-700">{{ $listing->floor_number }}/{{ $listing->total_floors }}</span>
    </div>
</div>
