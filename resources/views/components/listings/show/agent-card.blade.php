@props(['listing'])
@php
    use Illuminate\Support\Str;
@endphp

<div class="w-[390px] bg-white rounded-[8px] shadow-[0px_2px_10px_0px_rgba(0,0,0,0.1)] mt-[32px] sticky top-[440px]">
    <div class="bg-[#04247B] h-[82px] rounded-tl-[8px] rounded-tr-[8px] p-[20px] flex items-center gap-[12px]">
        <img src="{{ asset('images/ChatGPT Image Jan 22, 2026, 03_20_07 PM 1.png') }}" alt="Azure Crescent Realty Logo" class="w-[50px] h-[50px] object-cover rounded-full">
        <div>
            <p class="text-[16px] font-medium text-white leading-[1.3]">Azure Crescent Realty</p>
            <p class="text-[14px] text-white leading-[1.5] opacity-80">16 agents • 560 active listings</p>
        </div>
        <img src="{{ asset('images/verified_user.svg') }}" alt="Verified" class="w-[16px] h-[16px] ml-auto">
    </div>
    <div class="p-[20px] pt-[24px]">
        <div class="flex items-center gap-[12px]">
            <img src="{{ $listing->user->profile_photo_url ?? asset('images/profile_picture.png') }}" alt="{{ $listing->user->name }}" class="w-[64px] h-[64px] rounded-full border border-[#E8E8E7] object-cover">
            <div>
                <div class="flex items-center gap-[4px]">
                    <p class="text-[18px] font-medium text-black tracking-[-0.36px] leading-[1.28]">Jane Smith</p>
                    <img src="{{ asset('images/verified_user.svg') }}" alt="Verified" class="w-[18px] h-[18px]">
                </div>
                <p class="text-[14px] text-[#464646] leading-[1.5] mt-1">Usually responds in less than 2 hours</p>
            </div>
        </div>

        <div class="flex items-center gap-[4px] mt-[16px]">
            <span class="text-[18px] font-medium text-[#1447D4] tracking-[-0.36px] leading-[1.28]">4.7</span>
            <img src="{{ asset('images/star_filled.svg') }}" alt="Star" class="w-[21px] h-[21px]">
            <img src="{{ asset('images/star_filled.svg') }}" alt="Star" class="w-[21px] h-[21px]">
            <img src="{{ asset('images/star_filled.svg') }}" alt="Star" class="w-[21px] h-[21px]">
            <img src="{{ asset('images/star_filled.svg') }}" alt="Star" class="w-[21px] h-[21px]">
            <img src="{{ asset('images/star_filled.svg') }}" alt="Star" class="w-[21px] h-[21px]">
            <span class="text-[14px] font-medium text-[#464646] leading-[1.3] ml-[4px]">15 reviews</span>
        </div>

        <p class="text-[14px] text-[#464646] leading-[1.5] mt-[16px]">Jane Smith is an experienced Dubai-based property manager specializing in luxury residences, tenant relations, and seamless operations, delivering exceptional value to owners across the UAE.</p>

        <button class="w-full bg-white rounded-[29.5px] border border-[#E8E8E7] text-black font-medium text-[16px] leading-[1.22] tracking-[-0.48px] py-[10px] px-[20px] mt-[32px] hover:bg-gray-50 transition">
            View full profile
        </button>
    </div>
</div>
