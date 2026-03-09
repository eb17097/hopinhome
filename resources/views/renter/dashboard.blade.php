<x-renter-layout>
    <div class="bg-white">
        <div class="max-w-[1204px] mx-auto flex min-h-screen">
            {{-- Left Sidebar --}}
            <aside class="w-[320px] shrink-0 pt-[40px] pr-[16px]">
                <x-renter.renter-sidebar />
            </aside>

            {{-- Vertical Divider --}}
            <div class="w-px bg-[#e8e8e7] self-stretch"></div>

            {{-- Main Content --}}
            <main class="flex-1 ml-[24px] pt-[40px] max-w-[567px]">
                <h2 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-[24px] leading-[1.28]">
                    My profile
                </h2>

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
            </main>
        </div>
    </div>
</x-renter-layout>

