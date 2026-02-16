@props(['listing'])
@php
    $featureIconMap = [
        'High-speed internet' => 'android_wifi_3_bar.svg',
        'Dishwasher' => 'dishwasher.svg',
        'Pets allowed' => 'pet_supplies.svg',
        'Fully furnished' => 'dine_lamp.svg',
        'Air conditioner' => 'ac_unit.svg',
        'Maid room' => 'local_laundry_service.svg',
    ];

    $amenityIconMap = [
        'Built in 2025' => 'calendar_check.svg',
        'Free parking' => 'parking_sign.svg',
        'Swimming pool' => 'pool.svg',
        'Elevator' => 'elevator.svg',
        'Security cameras' => 'camera_outdoor.svg',
        'Gym' => 'exercise.svg',
    ];

@endphp

<div x-data="{ featuresOpen: false, amenitiesOpen: false }">
    <h3 class="text-[18px] font-medium text-black tracking-[-0.36px] leading-[1.28]">Apartment features</h3>
    <div class="grid grid-cols-2 gap-y-[20px] gap-x-[120px] mt-[20px]">
        @foreach($listing->features as $feature)
            <div class="flex items-center gap-[8px]">
                <img src="{{ asset('images/' . ($featureIconMap[$feature->name] ?? 'check.svg')) }}" alt="{{ $feature->name }}" class="w-[24px] h-[24px]">
                <span class="text-[14px] font-medium text-[#464646] leading-[1.3]">{{ $feature->name }}</span>
            </div>
        @endforeach
    </div>
    <button @click="featuresOpen = !featuresOpen" class="mt-[28px] text-[#1447D4] font-medium flex items-center gap-[8px]">
        <span class="text-[16px] tracking-[-0.48px] leading-[1.22]" x-text="featuresOpen ? 'Show less features' : 'Show all features'"></span>
        <img src="{{ asset('images/arrow_downward.svg') }}" alt="Arrow" class="size-[18px] transition-transform" :class="{ 'transform rotate-180': featuresOpen }">
    </button>

    <h3 class="text-[18px] font-medium text-black tracking-[-0.36px] leading-[1.28] mt-[40px]">Building amenities</h3>
    <div class="grid grid-cols-2 gap-y-[20px] gap-x-[120px] mt-[20px]">
        @foreach($listing->amenities as $amenity)
            <div class="flex items-center gap-[8px]">
                <img src="{{ asset('images/' . ($amenityIconMap[$amenity->name] ?? 'check.svg')) }}" alt="{{ $amenity->name }}" class="w-[24px] h-[24px]">
                <span class="text-[14px] font-medium text-[#464646] leading-[1.3]">{{ $amenity->name }}</span>
            </div>
        @endforeach
    </div>
    {{-- No 'Show all amenities' button in Figma for building amenities, so not adding one --}}
</div>
