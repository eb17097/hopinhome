<div class="flex-1 bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] overflow-hidden">
    {{-- Header --}}
    <div class="px-6 py-4 border-b border-light-gray flex justify-between items-center">
        <h3 class="text-[18px] font-medium text-[#1e1d1d]">Listing credits</h3>
        <img src="{{ asset('images/info.svg') }}" alt="Info" class="w-[22px] h-[22px] brightness-0">
    </div>

    {{-- Body --}}
    <div class="p-6">
        <div class="flex items-center space-x-3 mb-8 mt-2">
            <img src="{{ asset('images/toll.svg') }}" alt="Credit Icon" class="w-10 h-10">
            <div class="flex items-baseline space-x-2">
                <span class="text-[40px] font-medium text-[#1e1d1d] leading-none">3</span>
                <p class="text-[14px] text-[#464646]">Renews of Mar 15, 2026</p>
            </div>
        </div>
        <button class="w-full bg-electric-blue text-white py-4 rounded-[6px] text-[16px] font-medium hover:opacity-90 transition">
            Get more listing credits
        </button>
    </div>
</div>
