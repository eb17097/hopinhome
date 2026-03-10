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
            <div x-data="{ open: false }" class="relative">
                <img 
                    src="{{ asset('images/info_gray.svg') }}" 
                    alt="Info" 
                    class="w-5 h-5 cursor-pointer"
                    @mouseenter="open = true"
                    @mouseleave="open = false"
                >
                <div 
                    x-show="open"
                    x-cloak
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1"
                    class="absolute z-50 bottom-full right-[-14px] mb-[18px] w-[441px] bg-white rounded-[6px] shadow-[0px_4px_16px_0px_rgba(0,0,0,0.15)] p-[14px] pointer-events-none"
                >
                    <p class="text-[16px] leading-[1.5] text-[#464646] mb-[18px] font-['General_Sans',_sans-serif]">
                        Any unused listing credits included in your plan will expire with your next renewal on <span class="font-medium text-[#1e1d1d]">March 15, 2026.</span>
                    </p>
                    <p class="text-[16px] leading-[1.5] text-[#464646] font-['General_Sans',_sans-serif]">
                        Additional listing credits that you purchased separately <span class="font-medium text-[#1e1d1d]">will roll over</span> to the next month and remain available as long as you have an active subscription.
                    </p>
                    {{-- Caret --}}
                    <div class="absolute bottom-[-6px] right-[18px] w-3 h-3 bg-white rotate-45 border-r border-b border-gray-100"></div>
                </div>
            </div>
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
