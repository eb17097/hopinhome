<div class="flex-1 bg-[#0a1739] border border-[#283351] rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] overflow-hidden">
    <div class="p-[14px]">
        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-[6px]">
            <div class="flex items-center space-x-3">
                <div class="w-10 h-10 bg-[#122557] rounded-[6px] flex items-center justify-center">
                    <img src="{{ asset('images/bolt.svg') }}" alt="Boost Icon" class="w-6 h-6">
                </div>
                <h3 class="text-[18px] font-medium text-white">Boost credits</h3>
            </div>
            <img src="{{ asset('images/info_white.svg') }}" alt="Info" class="w-5 h-5">
        </div>

        {{-- Values Section --}}
        <div class="flex justify-between items-end mb-2">
            <span class="text-[14px] text-white">Remaining</span>
            <div class="flex items-baseline space-x-1">
                <span class="text-[32px] font-medium text-white leading-none">120</span>
                <span class="text-[18px] font-medium text-white">/ 150</span>
            </div>
        </div>

        {{-- Progress Bar --}}
        <div class="w-full h-1.5 bg-white/20 rounded-full overflow-hidden mb-8">
            <div class="h-full bg-[#fcd34d] rounded-full" style="width: 80%;"></div>
        </div>

        {{-- Action Button --}}
        <button class="w-full bg-[#1c2a4d] border border-[#283351] text-white h-[51px] rounded-[6px] text-[16px] font-medium hover:bg-[#23335a] transition">
            Get more boost credits
        </button>
    </div>
</div>
