<x-renter-layout>
    <div class="bg-white">
        <div class="max-w-[1440px] mx-auto flex min-h-screen">
            {{-- Left Sidebar --}}
            <aside class="w-[320px] shrink-0 px-4 py-12">
                <x-renter.renter-sidebar />
            </aside>

            {{-- Vertical Divider --}}
            <div class="w-px bg-[#e8e8e7] self-stretch"></div>

            {{-- Main Content --}}
            <main class="flex-1 px-12 py-12 max-w-[800px]">
                <h2 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-8 leading-[1.28]">
                    Account security
                </h2>

                <div class="space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Add a phone number --}}
                        <a href="#" class="bg-white border border-[#e8e8e7] rounded-[6px] px-6 py-[26px] flex justify-between items-center w-full hover:bg-gray-50 transition-colors group">
                            <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Add a phone number</span>
                            <img src="{{ asset('images/arrow_forward_black.svg') }}" class="w-[18px] h-[18px] opacity-60 group-hover:opacity-100 transition-opacity" alt="">
                        </a>

                        {{-- Reset password --}}
                        <a href="#" class="bg-white border border-[#e8e8e7] rounded-[6px] px-6 py-[26px] flex justify-between items-center w-full hover:bg-gray-50 transition-colors group">
                            <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Reset password</span>
                            <img src="{{ asset('images/arrow_forward_black.svg') }}" class="w-[18px] h-[18px] opacity-60 group-hover:opacity-100 transition-opacity" alt="">
                        </a>
                    </div>

                    {{-- Delete account --}}
                    <div class="max-w-[344px]" style="margin-top: 1rem;">
                        <a href="#" class="bg-white border border-[#ed0707] rounded-[6px] px-6 py-[26px] flex justify-between items-center w-full hover:bg-red-50 transition-colors group">
                            <span class="text-[16px] font-medium text-[#ed0707] leading-[1.5]">Delete account</span>
                            <img src="{{ asset('images/arrow_forward_red.svg') }}" class="w-[18px] h-[18px] opacity-60 group-hover:opacity-100 transition-opacity" alt="">
                        </a>
                    </div>
                </div>
            </main>
        </div>
    </div>
</x-renter-layout>
