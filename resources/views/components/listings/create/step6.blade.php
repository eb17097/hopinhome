<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">What amenities does the building have?</h3>
    <p class="text-base text-gray-600 mt-2">Select all that apply</p>

    <div class="mt-8">
        <h4 class="text-lg font-medium text-black">Building amenities</h4>
        <div class="grid grid-cols-2 gap-4 mt-4">
            @foreach(['Swimming pool', 'Gym', 'Reception', 'Concierge', 'Parking garage', 'Elevator / lift', 'Children’s play area', 'Outdoor area', 'Garden', 'BBQ area', 'Tennis court', 'Community lounge', 'Business center', 'Bicycle storage'] as $amenity)
                <div class="flex items-center">
                    <div class="w-6 h-6 rounded-md border border-light-gray flex items-center justify-center mr-3">
                        <img src="{{ asset('images/check.svg') }}" alt="Check" class="h-4 w-4 hidden">
                    </div>
                    <span class="text-sm font-medium text-gray-700">{{ $amenity }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
