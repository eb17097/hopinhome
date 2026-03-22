@php
    $user = auth()->user();
    $isOwner = $user->isBusinessOwner();
    
    $card1Label = $isOwner ? 'Active listings' : 'Listing views';
    $card2Label = $isOwner ? 'Listing views' : 'Profile views';
    $card3Label = $isOwner ? 'Agent profile views' : 'Message requests';
@endphp

<div class="bg-white border border-light-gray rounded-[8px] shadow-[0px_2px_8px_0px_rgba(0,0,0,0.04)] p-6 pt-[20px]">
    <div class="flex justify-between items-center mb-[16px]">
        <div class="flex items-baseline space-x-2">
            <h3 class="leading-[1.28] tracking-[-0.36px] text-[18px] font-medium text-[#1e1d1d]">Analytics</h3>
            <span class="text-[14px] text-[#464646] leading-[1.5]">Last 7 days</span>
        </div>
        <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] brightness-0 opacity-70">
    </div>

    <div class="grid grid-cols-3 gap-[10px]">
        <!-- Card 1 -->
        <div class="border border-light-gray rounded-[6px] pt-[18px] px-[14px] pb-[10px] h-[96px] flex flex-col justify-between relative overflow-hidden" style="background: radial-gradient(117.68% 96% at 0% 100%, rgba(16, 168, 16, 0.05) 0%, rgba(16, 168, 16, 0) 100%), #fff;">
            <p class="text-[14px] text-[#1E1D1D] leading-[1.5]">{{ $card1Label }}</p>
            <div class="flex items-end justify-between">
                <span class="text-[32px] font-medium text-[#1e1d1d] leading-[1.28] tracking-[-0.64px]">{{ $isOwner ? '56' : '310' }}</span>
                <span class="bg-like-green text-white text-[12px] font-medium px-[3px] pr-[4px] py-[1px] leading-[1.5] rounded-[3px] mb-[8px]">+24%</span>
            </div>
        </div>
        <!-- Card 2 -->
        <div class="border border-light-gray rounded-[6px] pt-[18px] px-[14px] pb-[10px] h-[96px] flex flex-col justify-between relative overflow-hidden" style="background: radial-gradient(117.68% 96% at 0% 100%, rgba(16, 168, 16, 0.05) 0%, rgba(16, 168, 16, 0) 100%), #fff;">
            <p class="text-[14px] text-[#1E1D1D] leading-[1.5]">{{ $card2Label }}</p>
            <div class="flex items-end justify-between">
                <span class="text-[32px] font-medium text-[#1e1d1d] leading-[1.28]">{{ $isOwner ? '1 895' : '21' }}</span>
                <span class="bg-like-green text-white text-[12px] font-medium px-[3px] pr-[4px] py-[1px] leading-[1.5] rounded-[3px] mb-[8px]">+43%</span>
            </div>
        </div>
        <!-- Card 3 -->
        <div class="border border-light-gray rounded-[6px] pt-[18px] px-[14px] pb-[10px] h-[96px] flex flex-col justify-between relative overflow-hidden" style="background: radial-gradient(117.68% 96% at 0% 100%, rgba(237, 7, 7, 0.05) 0%, rgba(237, 7, 7, 0) 100%), #fff;">
            <p class="text-[14px] text-[#1E1D1D] leading-[1.5]">{{ $card3Label }}</p>
            <div class="flex items-end justify-between">
                <span class="text-[32px] font-medium text-[#1e1d1d] leading-[1.28]">{{ $isOwner ? '89' : '21' }}</span>
                <span class="bg-[#ed0707] text-white text-[12px] font-medium px-[3px] pr-[4px] py-[1px] leading-[1.5] rounded-[3px] mb-[8px]">-6%</span>
            </div>
        </div>
    </div>
</div>
