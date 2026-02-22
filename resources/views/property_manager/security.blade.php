<x-property-manager-layout>
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="lg:col-span-8">
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
                <div class="max-w-[364px]">
                    <a href="#" class="bg-white border border-[#ed0707] rounded-[6px] px-6 py-[26px] flex justify-between items-center w-full hover:bg-red-50 transition-colors group">
                        <span class="text-[16px] font-medium text-[#ed0707] leading-[1.5]">Delete account</span>
                        <img src="{{ asset('images/arrow_forward_red.svg') }}" class="w-[18px] h-[18px] opacity-60 group-hover:opacity-100 transition-opacity" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-property-manager-layout>
