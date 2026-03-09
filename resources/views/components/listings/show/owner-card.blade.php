@props(['listing'])
@php
    use Illuminate\Support\Str;
@endphp

<div class="w-full bg-white rounded-[8px] shadow-[0px_2px_10px_0px_rgba(0,0,0,0.1)]">
    <div class="p-[20px] pt-[24px]">
        {{-- Profile Header --}}
        <div class="flex items-center gap-[12px]">
            <img src="{{ $listing->user->getProfilePhotoUrl() }}" alt="{{ $listing->user->name }}" class="w-[64px] h-[64px] rounded-full border border-[#E8E8E7] object-cover">
            <div>
                <div class="flex items-center gap-[4px]">
                    <p class="text-[20px] font-semibold text-black tracking-[-0.4px] leading-[1.2]">{{ $listing->user->name }}</p>
                    <img src="{{ asset('images/verified_user.svg') }}" alt="Verified" class="w-[18px] h-[18px]">
                </div>
                <p class="text-[14px] text-[#464646] leading-[1.5] mt-1">Property owner</p>
            </div>
        </div>

        {{-- Rating Section --}}
        <div class="mt-[20px] flex items-center gap-[12px]">
            <div class="inline-flex items-center gap-[8px] px-[12px] py-[8px] border border-[#E8E8E7] rounded-[8px]">
                <div class="flex items-center gap-[4px]">
                    @for ($i = 0; $i < 5; $i++)
                        <img src="{{ asset('images/star_filled.svg') }}" alt="Star" class="w-[18px] h-[18px]">
                    @endfor
                </div>
                <p class="text-[18px] font-semibold text-electric-blue leading-none">5.0</p>
            </div>
            <p class="text-[16px] text-[#464646]">1 review</p>
        </div>

        {{-- Bio Section --}}
        <p class="text-[16px] text-[#464646] leading-[1.5] mt-[20px]">
            {{ $listing->user->bio ?: 'This property is being rented out by the owner without an agent or real estate business.' }}
        </p>

        {{-- Verification Box --}}
        <div class="mt-[20px] p-[16px] bg-[#F7F7F7] rounded-[8px] flex items-center gap-[12px]">
            <img src="{{ asset('images/white_checkmark_on_blue.svg') }}" alt="Verified User" class="w-[20px] h-[20px]">
            <p class="text-[16px] text-[#464646] leading-[1.4]">The person has verified ownership of the property.</p>
        </div>

        {{-- View Full Profile Button --}}
        <a href="{{ route('public_profile.show', $listing->user->id) }}" class="mt-[24px] w-full flex items-center justify-center py-[14px] border border-[#E8E8E7] rounded-full text-[16px] font-semibold text-[#1A1A1A] hover:bg-gray-50 transition">
            View full profile
        </a>
    </div>
</div>
