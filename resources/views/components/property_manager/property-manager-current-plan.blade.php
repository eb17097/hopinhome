<div class="bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] overflow-hidden">
    {{-- Header --}}
    <div class="px-6 py-4 border-b border-light-gray flex justify-between items-center">
        <h3 class="text-[18px] font-semibold text-[#1e1d1d]">Current plan</h3>
    </div>

    {{-- Body --}}
    <div class="flex">
        {{-- Left Column: Plan Info --}}
        <div class="w-1/3 p-8 border-r border-light-gray flex flex-col">
            <h4 class="text-[24px] font-semibold text-[#1e1d1d]">Starter plan</h4>
            <div class="mt-2 inline-flex items-center px-4 py-1.5 bg-like-green rounded-full">
                <span class="text-[14px] font-medium text-white">Subscription active</span>
            </div>

            <div class="mt-8 flex items-baseline">
                <span class="text-[18px] font-medium text-[#1e1d1d]">€</span>
                <span class="text-[48px] font-bold text-[#1e1d1d] leading-none mx-0.5">9</span>
                <span class="text-[18px] font-medium text-[#1e1d1d]">/month</span>
            </div>
            <p class="text-[14px] text-[#464646] mt-2">Next renewal on Mar 15, 2026</p>
        </div>

        {{-- Middle Column: Features --}}
        <div class="w-1/3 p-8 border-r border-light-gray">
            <p class="text-[16px] font-semibold text-[#1e1d1d] mb-4">Plan includes:</p>
            <ul class="space-y-4">
                <li class="flex items-center space-x-3">
                    <img src="{{ asset('images/checkmark.svg') }}" alt="Check" class="w-[18px] h-[18px] brightness-0">
                    <span class="text-[14px] text-[#464646]">100 monthly listing credits</span>
                </li>
                <li class="flex items-center space-x-3">
                    <img src="{{ asset('images/checkmark.svg') }}" alt="Check" class="w-[18px] h-[18px] brightness-0">
                    <span class="text-[14px] text-[#464646]">50 monthly boost credits</span>
                </li>
                <li class="flex items-center space-x-3">
                    <img src="{{ asset('images/checkmark.svg') }}" alt="Check" class="w-[18px] h-[18px] brightness-0">
                    <span class="text-[14px] text-[#464646]">24/7 support</span>
                </li>
            </ul>
        </div>

        {{-- Right Column: Actions --}}
        <div class="w-1/3 p-8 flex flex-col items-center justify-center space-y-4">
            <button class="w-full h-[51px] bg-electric-blue text-white rounded-[6px] text-[16px] font-semibold hover:opacity-90 transition">
                Upgrade plan
            </button>
            <a href="#" class="text-[14px] text-[#464646] underline hover:text-black transition">
                Cancel subscription
            </a>
        </div>
    </div>
</div>
