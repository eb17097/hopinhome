@props(['listing'])

<div class="mb-8">
    <h2 class="text-xl font-medium text-gray-900 mb-4">Apartment features</h2>
    <div class="grid grid-cols-2 gap-4">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/android_wifi_3_bar.svg') }}" alt="Wifi" class="w-6 h-6">
            <span>High-speed internet</span>
        </div>
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/dishwasher.svg') }}" alt="Dishwasher" class="w-6 h-6">
            <span>Dishwasher</span>
        </div>
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/pet_supplies.svg') }}" alt="Pets" class="w-6 h-6">
            <span>Pets allowed</span>
        </div>
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/dine_lamp.svg') }}" alt="Furnished" class="w-6 h-6">
            <span>Fully furnished</span>
        </div>
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/ac_unit.svg') }}" alt="AC" class="w-6 h-6">
            <span>Air conditioner</span>
        </div>
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/local_laundry_service.svg') }}" alt="Maid room" class="w-6 h-6">
            <span>Maid room</span>
        </div>
    </div>

    <h2 class="text-xl font-medium text-gray-900 mt-8 mb-4">Building amenities</h2>
    <div class="grid grid-cols-2 gap-4">
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/calendar_check.svg') }}" alt="Built in 2025" class="w-6 h-6">
            <span>Built in 2025</span>
        </div>
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/parking_sign.svg') }}" alt="Parking" class="w-6 h-6">
            <span>Free parking</span>
        </div>
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/pool.svg') }}" alt="Pool" class="w-6 h-6">
            <span>Swimming pool</span>
        </div>
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/elevator.svg') }}" alt="Elevator" class="w-6 h-6">
            <span>Elevator</span>
        </div>
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/camera_outdoor.svg') }}" alt="Security" class="w-6 h-6">
            <span>Security cameras</span>
        </div>
        <div class="flex items-center gap-2">
            <img src="{{ asset('images/exercise.svg') }}" alt="Gym" class="w-6 h-6">
            <span>Gym</span>
        </div>
    </div>
</div>
