@props(['listing'])

<div>
    <h3 class="text-lg font-medium text-black">Apartment features</h3>
    <div class="grid grid-cols-2 gap-y-4 gap-x-8 mt-4">
        @foreach($listing->features as $feature)
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/' . ($iconMap[$feature->name] ?? 'check.svg')) }}" alt="{{ $feature->name }}" class="w-6 h-6">
                <span class="text-gray-700">{{ $feature->name }}</span>
            </div>
        @endforeach
    </div>

    <h3 class="text-lg font-medium text-black mt-8">Building amenities</h3>
    <div class="grid grid-cols-2 gap-y-4 gap-x-8 mt-4">
        @foreach($listing->amenities as $amenity)
            <div class="flex items-center space-x-3">
                <img src="{{ asset('images/' . ($iconMap[$amenity->name] ?? 'check.svg')) }}" alt="{{ $amenity->name }}" class="w-6 h-6">
                <span class="text-gray-700">{{ $amenity->name }}</span>
            </div>
        @endforeach
    </div>
</div>
