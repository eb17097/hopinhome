<div class="bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] overflow-hidden">
    {{-- Header --}}
    <div class="px-6 py-[20px] border-b border-light-gray flex justify-between items-center">
        <h3 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.28] tracking-[-0.36px]">Agents</h3>
        <a href="#">
            <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow Forward" class="w-[18px] h-[18px] brightness-0 opacity-70">
        </a>
    </div>

    {{-- Agents List --}}
    <div class="divide-y divide-light-gray">
        {{-- Agent 1: Invite Sent --}}
        <div class="px-6 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-[64px] h-[64px] rounded-full border border-light-gray overflow-hidden shrink-0 bg-[#f0f0f0] flex items-center justify-center">
                    <img src="{{ asset('images/user-placeholder.svg') }}" alt="Jane Smith" class="w-full h-full object-cover">
                </div>
                <div>
                    <h4 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.28]">Jane Smith</h4>
                    <p class="text-[14px] text-[#464646] leading-[1.5]">jane@example.com</p>
                </div>
            </div>
            <div class="bg-[#f9f9f8] px-3 py-1 rounded-full flex items-center space-x-1.5 border border-light-gray">
                <img src="{{ asset('images/schedule.svg') }}" class="w-4 h-4 opacity-70" alt="">
                <span class="text-[14px] text-[#464646] font-medium">Invite sent</span>
            </div>
        </div>

        {{-- Agent 2 --}}
        <div class="px-6 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-[64px] h-[64px] rounded-full border border-light-gray overflow-hidden shrink-0">
                    <img src="{{ asset('images/user-placeholder.svg') }}" alt="Sarah Johnson" class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="flex items-center space-x-1">
                        <h4 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.28]">Sarah Johnson</h4>
                        <img src="{{ asset('images/verified_user.svg') }}" class="w-[18px] h-[18px]" alt="Verified">
                    </div>
                    <p class="text-[14px] text-[#464646] leading-[1.5]">sarah@example.com</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-1 px-2 py-1 border border-light-gray rounded-[4px]">
                    <img src="{{ asset('images/star.svg') }}" class="w-4 h-4 brightness-0 opacity-70" alt="Rating">
                    <span class="text-[15px] font-medium text-[#1e1d1d]">4.9</span>
                </div>
                <div class="flex items-center space-x-1 px-2 py-1 border border-light-gray rounded-[4px]">
                    <img src="{{ asset('images/apartment_black.svg') }}" class="w-4 h-4 opacity-70" alt="Listings">
                    <span class="text-[15px] font-medium text-[#1e1d1d]">46</span>
                </div>
            </div>
        </div>

        {{-- Agent 3 --}}
        <div class="px-6 py-4 flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <div class="w-[64px] h-[64px] rounded-full border border-light-gray overflow-hidden shrink-0">
                    <img src="{{ asset('images/user-placeholder.svg') }}" alt="Sarah Johnson" class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="flex items-center space-x-1">
                        <h4 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.28]">Sarah Johnson</h4>
                        <img src="{{ asset('images/verified_user.svg') }}" class="w-[18px] h-[18px]" alt="Verified">
                    </div>
                    <p class="text-[14px] text-[#464646] leading-[1.5]">sarah@example.com</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-1 px-2 py-1 border border-light-gray rounded-[4px]">
                    <img src="{{ asset('images/star.svg') }}" class="w-4 h-4 brightness-0 opacity-70" alt="Rating">
                    <span class="text-[15px] font-medium text-[#1e1d1d]">4.7</span>
                </div>
                <div class="flex items-center space-x-1 px-2 py-1 border border-light-gray rounded-[4px]">
                    <img src="{{ asset('images/apartment_black.svg') }}" class="w-4 h-4 opacity-70" alt="Listings">
                    <span class="text-[15px] font-medium text-[#1e1d1d]">34</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="p-6 border-t border-light-gray">
        <a href="#" class="h-[51px] w-full border border-light-gray rounded-[50px] flex justify-center items-center text-[16px] font-medium text-[#1e1d1d] hover:bg-gray-50 transition-colors">
            View all agents
        </a>
    </div>
</div>
