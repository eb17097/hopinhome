<div class="bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] overflow-hidden">
    {{-- Header --}}
    <div class="px-6 py-[20px] border-b border-light-gray flex justify-between items-center">
        <h3 class="text-[18px] font-medium text-[#1e1d1d]">Current plan</h3>
    </div>

    {{-- Body --}}
    <div class="flex h-[182px]">
        {{-- Left Column: Plan Info --}}
        <div class="w-1/3 p-[24px] border-r border-light-gray flex flex-col">
            <h4 class="leading-[1.28] text-[20px] tracking-[-0.4px] font-medium text-[#1e1d1d]">Starter plan</h4>
            <div class="h-[24px] w-[158px] mt-2 inline-flex items-center justify-center bg-like-green rounded-full">
                <span class="text-[14px] leading-[1.3] font-medium text-white">Subscription active</span>
            </div>

            <div class="flex items-baseline mt-[6px]">
                <span class="text-[18px] font-medium text-[#1e1d1d]">€</span>
                <span class="text-[32px] font-medium text-[#1e1d1d] leading-[1.5]">9</span>
                <span class="text-[18px] font-medium text-[#1e1d1d]">/month</span>
            </div>
            <p class="text-[14px] text-[#464646]">Next renewal on Mar 15, 2026</p>
        </div>

        {{-- Middle Column: Features --}}
        <div class="w-1/3 px-[27px] py-[29px] border-r border-light-gray">
            <p class="text-[14px] font-medium text-[#1e1d1d] mb-[6px]">Plan includes:</p>
            <ul class="space-y-[8px]">
                <li class="flex items-center space-x-[3px]">
                    <img src="{{ asset('images/checkmark.svg') }}" alt="Check" class="w-[18px] h-[18px] brightness-0">
                    <span class="text-[14px] text-[#464646]">100 monthly listing credits</span>
                </li>
                <li class="flex items-center space-x-[3px]">
                    <img src="{{ asset('images/checkmark.svg') }}" alt="Check" class="w-[18px] h-[18px] brightness-0">
                    <span class="text-[14px] text-[#464646]">50 monthly boost credits</span>
                </li>
                <li class="flex items-center space-x-[3px]">
                    <img src="{{ asset('images/checkmark.svg') }}" alt="Check" class="w-[18px] h-[18px] brightness-0">
                    <span class="text-[14px] text-[#464646]">24/7 support</span>
                </li>
            </ul>
        </div>

        {{-- Right Column: Actions --}}
        <div class="w-1/3 p-8 flex flex-col items-center justify-center space-y-[14px]">
            <button class="leading-[1.22] tracking-[-0.45px] w-full h-[45px] bg-electric-blue text-white rounded-[50px] text-[15px] font-medium hover:opacity-90 transition">
                Upgrade plan
            </button>
            <a href="#" class="text-[14px] text-[#464646] underline hover:text-black transition">
                Cancel subscription
            </a>
        </div>
    </div>
</div>
