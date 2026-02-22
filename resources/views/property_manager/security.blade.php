<x-property-manager-layout>
    <div class="max-w-4xl">
        <h2 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-8 font-['General_Sans',_sans-serif]">
            Account security
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            {{-- Add a phone number --}}
            <a href="#" class="bg-white border border-[#e8e8e7] rounded-[6px] p-6 flex items-center justify-between hover:bg-gray-50 transition-colors group">
                <span class="text-[16px] font-medium text-[#1e1d1d]">Add a phone number</span>
                <img src="{{ asset('images/arrow_forward_black.svg') }}" class="w-[18px] h-[18px] opacity-60 group-hover:opacity-100 transition-opacity" alt="">
            </a>

            {{-- Reset password --}}
            <a href="#" class="bg-white border border-[#e8e8e7] rounded-[6px] p-6 flex items-center justify-between hover:bg-gray-50 transition-colors group">
                <span class="text-[16px] font-medium text-[#1e1d1d]">Reset password</span>
                <img src="{{ asset('images/arrow_forward_black.svg') }}" class="w-[18px] h-[18px] opacity-60 group-hover:opacity-100 transition-opacity" alt="">
            </a>
        </div>

        {{-- Delete account --}}
        <div class="max-w-[275px]">
            <a href="#" class="bg-white border border-[#ed0707] rounded-[6px] p-6 flex items-center justify-between hover:bg-red-50 transition-colors group">
                <span class="text-[16px] font-medium text-[#ed0707]">Delete account</span>
                <img src="{{ asset('images/arrow_forward_red.svg') }}" class="w-[18px] h-[18px] opacity-60 group-hover:opacity-100 transition-opacity" alt="">
            </a>
        </div>
    </div>
</x-property-manager-layout>
