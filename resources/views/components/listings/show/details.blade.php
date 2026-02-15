@props(['listing'])

<div class="mb-8">
    <h2 class="text-2xl font-medium text-gray-900 mb-2">Apartment for rent - {{ $listing->city }}, Dubai</h2>
    <p class="text-sm text-gray-500 mb-4">Down Town rd 2, Dubai</p>

    <div class="flex items-center gap-4 text-sm text-gray-600">
        <div class="flex items-center gap-1">
            <img src="{{ asset('images/activity_zone.svg') }}" alt="Area Icon" class="w-5 h-5 text-gray-400">
            <span>861 sqft</span>
        </div>
        <div class="flex items-center gap-1">
            <img src="{{ asset('images/bed.svg') }}" alt="Beds Icon" class="w-5 h-5 text-gray-400">
            <span>2 beds</span>
        </div>
        <div class="flex items-center gap-1">
            <img src="{{ asset('images/bathtub.svg') }}" alt="Baths Icon" class="w-5 h-5 text-gray-400">
            <span>1 bath</span>
        </div>
        <div class="flex items-center gap-1">
            <img src="{{ asset('images/floor.svg') }}" alt="Images Icon" class="w-5 h-5">
            <span>13/15</span>
        </div>
    </div>
</div>
