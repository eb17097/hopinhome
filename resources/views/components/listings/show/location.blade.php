@props(['listing'])

<div>
    <h3 class="text-[18px] font-medium text-black tracking-[-0.36px] leading-[1.28]">Location</h3>
    <p class="text-[16px] text-[#464646] leading-[1.5] mt-[8px]">{{ $listing->address }}</p>
    <div class="mt-[20px] h-[421px] rounded-[8px] overflow-hidden">
        <img src="{{ asset('images/image 9.png') }}" alt="Map of {{ $listing->address }}" class="w-full h-full object-cover">
    </div>
</div>
