<div class="flex-1 bg-[#0a1739] border border-[#283351] rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)]">
    <div class="px-[14px] pt-[12px]">
        {{-- Header Section --}}
        <div class="flex justify-between items-center -mb-[7px]">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-[#283351] rounded-[6px] flex items-center justify-center border border-[#3B4561]">
                    <img src="{{ asset('images/bolt_yellow.svg') }}" alt="Boost Icon" class="w-[28px] h-[28px]">
                </div>
                <h3 class="text-[18px] leading-[1.28] tracking-[-0.36px] font-medium text-white">Boost credits</h3>
            </div>
            <div x-data="{ open: false }" class="relative">
                <img
                    src="{{ asset('images/info_white.svg') }}"
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
                    class="text-[16px] leading-[1.5] absolute z-50 bottom-full left-1/2 -translate-x-1/2 mb-[18px] w-[441px] bg-white rounded-[6px] shadow-[0px_4px_16px_0px_rgba(0,0,0,0.15)] p-[14px] pointer-events-none"
                >
                    <p class="text-[16px] leading-[1.5] text-[#464646] mb-[18px] font-['General_Sans',_sans-serif]">
                        Any unused boost credits included in your plan will expire with your next renewal on <span class="font-medium text-[#1e1d1d]">March 15, 2026.</span>
                    </p>
                    <p class="text-[16px] leading-[1.5] text-[#464646] font-['General_Sans',_sans-serif]">
                        Additional boost credits that you purchased separately <span class="font-medium text-[#1e1d1d]">will roll over</span> to the next month and remain available as long as you have an active subscription.
                    </p>
                    {{-- Caret --}}
                    <div class="absolute bottom-[-6px] left-1/2 -translate-x-1/2 w-3 h-3 bg-white rotate-45 border-r border-b border-gray-100"></div>
                </div>
            </div>
        </div>

        {{-- Values Section --}}
        <div class="flex justify-between items-end mb-[7px]">
            <span class="text-[14px] text-white">Remaining</span>
            <div class="flex items-baseline">
                <span class="text-[32px] font-medium text-white leading-[1.3]">120</span>
                <span class="text-[16px] font-medium text-white leading-[1.5]">/ 150</span>
            </div>
        </div>

        {{-- Progress Bar --}}
        <div class="w-full h-[6px] bg-white/20 rounded-full overflow-hidden mb-[20px]">
            <div class="h-full bg-[#fcd34d] rounded-full" style="width: 80%;"></div>
        </div>
    </div>
    <div class="border-t border-[#283351] pt-[11px] px-[14px] pb-[14px]">
        {{-- Action Button --}}
        <button class="w-full bg-[#283351] border border-[#3B4561] text-white h-[51px] rounded-[50px] text-[16px] font-medium hover:bg-[#23335a] transition">
            Get more boost credits
        </button>
    </div>
</div>
