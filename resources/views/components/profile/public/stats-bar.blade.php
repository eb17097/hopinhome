@props(['user'])

<div class="flex gap-4 items-center">
    {{-- Response Time --}}
    <div class="flex items-center gap-2 px-4 py-2 border border-light-gray rounded-full bg-white">
        <img src="{{ asset('images/speed.svg') }}" alt="Speed" class="w-[17px] h-[17px] opacity-70">
        <span class="text-[14px] text-[#1e1d1d]">Usually responds in {{ $user->response_time }}</span>
    </div>

    {{-- Member Since --}}
    <div class="flex items-center gap-2 px-4 py-2 border border-light-gray rounded-full bg-white">
        <img src="{{ asset('images/calendar_check.svg') }}" alt="Calendar" class="w-[17px] h-[17px] opacity-70">
        <span class="text-[14px] text-[#1e1d1d]">Member since {{ $user->member_since }}</span>
    </div>

    {{-- Total Listings --}}
    <div class="flex items-center gap-2 px-4 py-2 border border-light-gray rounded-full bg-white">
        <img src="{{ asset('images/apartment.svg') }}" alt="Apartment" class="w-[17px] h-[17px] opacity-70">
        <span class="text-[14px] text-[#1e1d1d]">{{ $user->total_listings }} listings in total</span>
    </div>
</div>
