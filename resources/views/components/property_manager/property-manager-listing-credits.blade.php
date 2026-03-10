<div class="flex-1 bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] overflow-hidden" style="background: #F9F9F8;">
    <div class="p-[14px]">
        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-[6px]">
            <div class="flex items-center space-x-[10px]">
                <div class="w-10 h-10 bg-[#f4f4f3] rounded-[6px] flex items-center justify-center">
                    <img src="{{ asset('images/toll.svg') }}" alt="Credit Icon" class="w-6 h-6">
                </div>
                <h3 class="text-[18px] font-medium text-[#1e1d1d]">Listing credits</h3>
            </div>
            <img src="{{ asset('images/info_gray.svg') }}" alt="Info" class="w-5 h-5">
        </div>

        {{-- Values Section --}}
        <div class="flex justify-between items-end mb-2">
            <span class="text-[14px] text-[#464646]">Remaining</span>
            <div class="flex items-baseline space-x-1">
                <span class="text-[32px] font-medium text-[#1e1d1d] leading-none">49</span>
                <span class="text-[18px] font-medium">/ 200</span>
            </div>
        </div>

        {{-- Progress Bar --}}
        <div class="w-full h-1.5 bg-[#e5e7eb] rounded-full overflow-hidden mb-8">
            <div class="h-full bg-electric-blue rounded-full" style="width: 24.5%;"></div>
        </div>

        {{-- Action Button --}}
        <button class="w-full bg-electric-blue text-white h-[51px] rounded-[6px] text-[16px] font-medium hover:opacity-90 transition">
            Get more listing credits
        </button>
    </div>
</div>
