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
        'Elevator' => 'elevator.svg',
        'Free parking' => 'parking_sign.svg',
        'Security cameras' => 'camera_outdoor.svg',
        'Swimming pool' => 'pool.svg',
        'Gym' => 'exercise.svg',
    ];
@endphp

<div>
    {{-- Apartment Features --}}
    <div x-data="{
            open: false,
            showButton: false,
            clampedHeight: 'auto',
            updateClamp() {
                this.$nextTick(() => {
                    const grid = this.$refs.featuresGrid;
                    if (grid.children.length < 1) { this.showButton = false; return; }
                    const itemHeight = grid.children[0].offsetHeight;
                    const gap = parseInt(window.getComputedStyle(grid).getPropertyValue('row-gap'));
                    const twoRowsHeight = (itemHeight * 2) + gap;

                    if (grid.scrollHeight > twoRowsHeight + 2) { // Add a 2px buffer for rounding
                        this.showButton = true;
                        this.clampedHeight = `${twoRowsHeight}px`;
                    } else {
                        this.showButton = false;
                        this.clampedHeight = 'auto';
                    }
                });
            }
        }"
         x-init="updateClamp()"
         @resize.window.debounce.300ms="updateClamp()">
        <h3 class="text-[18px] font-medium text-black tracking-[-0.36px] leading-[1.28]">Apartment features</h3>
        <div x-ref="featuresGrid"
             class="grid grid-cols-2 sm:grid-cols-3 gap-y-[20px] gap-x-[40px] mt-[20px] overflow-hidden transition-all duration-300"
             :style="{ 'max-height': open ? `${$refs.featuresGrid.scrollHeight}px` : clampedHeight }">
            @foreach($listing->features as $feature)
                <div class="flex items-center gap-[8px]">
                    @if(isset($featureIconMap[$feature->name]))
                        <img src="{{ asset('images/' . $featureIconMap[$feature->name]) }}" alt="{{ $feature->name }}" class="w-[24px] h-[24px]">
                    @endif
                    <span class="text-[14px] font-medium text-[#464646] leading-[1.3]">{{ $feature->name }}</span>
                </div>
            @endforeach
        </div>
        <template x-if="showButton">
            <button @click="open = !open" class="mt-[28px] text-[#1447D4] font-medium flex items-center gap-[8px]">
                <span class="text-[16px] tracking-[-0.48px] leading-[1.22]" x-text="open ? 'Show less features' : 'Show all features'"></span>
                <img src="{{ asset('images/arrow_downward.svg') }}" alt="Arrow" class="size-[18px] transition-transform" :class="{ 'transform rotate-180': open }">
            </button>
        </template>
    </div>

    {{-- Building Amenities --}}
    <div x-data="{
            open: false,
            showButton: false,
            clampedHeight: 'auto',
            updateClamp() {
                this.$nextTick(() => {
                    const grid = this.$refs.amenitiesGrid;
                    if (grid.children.length < 1) { this.showButton = false; return; }
                    const itemHeight = grid.children[0].offsetHeight;
                    const gap = parseInt(window.getComputedStyle(grid).getPropertyValue('row-gap'));
                    const twoRowsHeight = (itemHeight * 2) + gap;

                    if (grid.scrollHeight > twoRowsHeight + 2) { // Add a 2px buffer for rounding
                        this.showButton = true;
                        this.clampedHeight = `${twoRowsHeight}px`;
                    } else {
                        this.showButton = false;
                        this.clampedHeight = 'auto';
                    }
                });
            }
        }"
         x-init="updateClamp()"
         @resize.window.debounce.300ms="updateClamp()" class="mt-[40px]">
        <h3 class="text-[18px] font-medium text-black tracking-[-0.36px] leading-[1.28]">Building amenities</h3>
        <div x-ref="amenitiesGrid"
             class="grid grid-cols-2 sm:grid-cols-3 gap-y-[20px] gap-x-[40px] mt-[20px] overflow-hidden transition-all duration-300"
             :style="{ 'max-height': open ? `${$refs.amenitiesGrid.scrollHeight}px` : clampedHeight }">
            @foreach($listing->amenities as $amenity)
                <div class="flex items-center gap-[8px]">
                    @if(isset($amenityIconMap[$amenity->name]))
                        <img src="{{ asset('images/' . $amenityIconMap[$amenity->name]) }}" alt="{{ $amenity->name }}" class="w-[24px] h-[24px]">
                    @endif
                    <span class="text-[14px] font-medium text-[#464646] leading-[1.3]">{{ $amenity->name }}</span>
                </div>
            @endforeach
        </div>
        <template x-if="showButton">
            <button @click="open = !open" class="mt-[28px] text-[#1447D4] font-medium flex items-center gap-[8px]">
                <span class="text-[16px] tracking-[-0.48px] leading-[1.22]" x-text="open ? 'Show less amenities' : 'Show all amenities'"></span>
                <img src="{{ asset('images/arrow_downward.svg') }}" alt="Arrow" class="size-[18px] transition-transform" :class="{ 'transform rotate-180': open }">
            </button>
        </template>
    </div>
</div>
