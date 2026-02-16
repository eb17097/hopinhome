@props(['listing'])
@php
    use Illuminate\Support\Str;
@endphp

<div class="w-[390px] bg-white rounded-[8px] shadow-[0px_2px_10px_0px_rgba(0,0,0,0.1)] mt-[32px] sticky top-[440px]">
    <div class="p-[20px] pt-[24px]">
        <div class="flex items-center gap-[12px]">
            <img src="{{ $listing->user->profile_photo_url ?? asset('images/profile_picture.png') }}" alt="{{ $listing->user->name }}" class="w-[64px] h-[64px] rounded-full border border-[#E8E8E7] object-cover">
            <div>
                <div class="flex items-center gap-[4px]">
                    <p class="text-[18px] font-medium text-black tracking-[-0.36px] leading-[1.28]">Jane Smith</p>
                    <img src="{{ asset('images/verified_user.svg') }}" alt="Verified" class="w-[18px] h-[18px]">
                </div>
                <p class="text-[14px] text-[#464646] leading-[1.5] mt-1">Property owner</p>
            </div>
        </div>

        <p class="text-[14px] text-[#464646] leading-[1.5] mt-[16px]">This property is being rented out by the owner without an agent or real estate business.</p>

        <hr class="w-full h-px bg-[#E8E8E7] opacity-50 my-[20px]">

        <div class="flex items-center gap-[8px]">
            <img src="{{ asset('images/verified_user.svg') }}" alt="Verified User" class="w-[18px] h-[18px]">
            <p class="text-[14px] font-medium text-black leading-[1.5]">The person has verified ownership of the property.</p>
        </div>
    </div>
</div>
