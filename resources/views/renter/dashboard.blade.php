<x-renter-layout>
    <x-renter.sidebar-layout title="My profile">
        <div>
            <x-renter.renter-profile-header />

            <x-renter.renter-setup-checklist />

            <x-renter.renter-reviews />

            {{-- Footer Action --}}
            <div class="flex justify-center mt-[24px] mb-[128px]">
                <button class="bg-white border border-[#e8e8e7] rounded-full flex items-center justify-center gap-2 h-[52px] w-[280px] hover:bg-gray-50 transition-colors">
                    <img alt="arrow downward" class="w-[17px] h-[17px]" src="{{ asset('images/arrow_downward_gray.svg') }}">
                    <span class="font-medium text-[16px] text-[#1e1d1d] tracking-[-0.48px]">Show all reviews</span>
                </button>
            </div>
        </div>
    </x-renter.sidebar-layout>
</x-renter-layout>
