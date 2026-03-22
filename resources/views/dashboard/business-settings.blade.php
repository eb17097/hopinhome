<x-professional-layout>
    <div class="p-[24px] max-w-[768px]">
        {{-- Header Section --}}
        <div class="flex items-center space-x-[10px] mb-[20px]">
            <img src="{{ asset('images/business_case.svg') }}" alt="Business" class="w-[30px] h-[30px] brightness-0">
            <h1 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px]">Business settings</h1>
        </div>

        {{-- Business Info Card (Dark) --}}
        <div class="bg-[#0A1739] rounded-[6px] mb-[16px] p-[24px] text-white overflow-hidden relative" style="background: linear-gradient(294deg, #0A1739 0%, #122557 99.42%);">
            <div class="flex items-start space-x-[16px] mb-[16px]">
                <div class="w-[64px] h-[64px] rounded-[6px] bg-white/10 flex items-center justify-center border border-white/20 shrink-0">
                    {{-- Placeholder Logo --}}
                    <img src="{{ asset('images/apartment_big.svg') }}" alt="" class="w-[32px] h-[32px] brightness-0 invert opacity-60">
                </div>
                <div>
                    <div class="flex items-center space-x-1 mb-1">
                        <h2 class="text-[20px] font-medium tracking-[-0.4px] leading-[1.28]">Azure Crescent Realty</h2>
                        <img src="{{ asset('images/verified_user.svg') }}" alt="Verified" class="w-[20px] h-[20px] brightness-0 invert">
                    </div>
                    <p class="text-[14px] text-white/60 font-medium">16 agents • 560 active listings</p>
                </div>
            </div>

            <div class="border-t border-white/10 pt-4">
                <p class="text-[16px] text-white/80 leading-[1.5]">
                    A modern real estate brand inspired by Dubai’s iconic skyline, specializing in premium properties and smart investment opportunities. The business focuses on contemporary architecture, luxury living, and high-quality developments that combine elegant design with long-term value.
                </p>
            </div>
        </div>

        {{-- Action Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            {{-- Edit Bio --}}
            <button @click="$dispatch('open-edit-bio-modal')" class="h-[76px] bg-white border border-light-gray rounded-[6px] p-6 flex items-center justify-between hover:bg-gray-50 transition-colors group">
                <span class="text-[16px] font-medium text-[#1e1d1d]">Edit bio</span>
                <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
            </button>

            {{-- Change Logo (Reuses profile photo modal) --}}
            <button @click="$dispatch('open-profile-photo-modal')" class="h-[76px] bg-white border border-light-gray rounded-[6px] p-6 flex items-center justify-between hover:bg-gray-50 transition-colors group">
                <span class="text-[16px] font-medium text-[#1e1d1d]">Change logo</span>
                <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
            </button>
        </div>

        <div class="border-t border-light-gray my-6"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            {{-- Regulatory Information --}}
            <a href="#" class="h-[124px] opacity-60 pointer-events-none border border-light-gray rounded-[6px] p-6 flex flex-col hover:bg-gray-50 transition-colors group">
                <div class="flex items-center justify-between mb-[6px]">
                    <span class="text-[16px] font-medium text-[#1e1d1d]">Regulatory information</span>
                    <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
                </div>
                <p class="text-[14px] text-[#464646]">Manage your business license and compliance information in one place.</p>
            </a>

            {{-- Payments & Subscriptions --}}
            <a href="#" class="h-[124px] opacity-60 pointer-events-none bg-white border border-light-gray rounded-[6px] p-6 flex flex-col hover:bg-gray-50 transition-colors group">
                <div class="flex items-center justify-between mb-[6px]">
                    <span class="text-[16px] font-medium text-[#1e1d1d]">Payments & Subscriptions</span>
                    <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
                </div>
                <p class="text-[14px] text-[#464646]">Manage your plan, billing details, invoices, and subscription settings in one place.</p>
            </a>
        </div>

        <div class="border-t border-light-gray my-6"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            {{-- Account security --}}
            <a href="{{ route('business_owner.security') }}" class="h-[76px] bg-white border border-light-gray rounded-[6px] p-6 flex items-center justify-between hover:bg-gray-50 transition-colors group">
                <span class="text-[16px] font-medium text-[#1e1d1d]">Account security</span>
                <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
            </a>

            {{-- Sign out --}}
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="h-[76px] bg-white border border-[#ed0707] rounded-[6px] p-6 flex items-center justify-between hover:bg-red-50 transition-colors group w-full text-left">
                    <span class="text-[16px] font-medium text-[#ed0707]">Sign out</span>
                    <img src="{{ asset('images/arrow_forward_red.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
                </button>
            </form>
        </div>
    </div>
</x-professional-layout>
