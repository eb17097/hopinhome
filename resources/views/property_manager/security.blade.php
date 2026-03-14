<x-property-manager-layout>
    <div class="p-6">
        <div class="flex items-center gap-[10px] mb-[50px]">
            <img src="{{ asset('images/account_circle.svg') }}" class="w-[30px] h-[30px]" alt="">
            <h2 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] leading-[1.28]">
                Account security
            </h2>
        </div>

        <div class="flex flex-wrap gap-4">
            {{-- Add a phone number --}}
            <a href="#" class="bg-white border border-[#e8e8e7] rounded-[6px] px-6 py-[26px] flex justify-between items-center w-full max-w-[245px] hover:bg-gray-50 transition-colors group">
                <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Add a phone number</span>
                <img src="{{ asset('images/arrow_forward_black.svg') }}" class="w-[18px] h-[18px] opacity-60 group-hover:opacity-100 transition-opacity" alt="">
            </a>

            {{-- Reset password --}}
            <button @click="$dispatch('open-reset-password-modal')" class="bg-white border border-[#e8e8e7] rounded-[6px] px-6 py-[26px] flex justify-between items-center w-full max-w-[245px] hover:bg-gray-50 transition-colors group text-left">
                <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Reset password</span>
                <img src="{{ asset('images/arrow_forward_black.svg') }}" class="w-[18px] h-[18px] opacity-60 group-hover:opacity-100 transition-opacity" alt="">
            </button>

            {{-- Delete account --}}
            <a href="#" class="bg-white border border-[#ed0707] rounded-[6px] px-6 py-[26px] flex justify-between items-center w-full max-w-[245px] hover:bg-red-50 transition-colors group">
                <span class="text-[16px] font-medium text-[#ed0707] leading-[1.5]">Delete account</span>
                <img src="{{ asset('images/arrow_forward_red.svg') }}" class="w-[18px] h-[18px] opacity-60 group-hover:opacity-100 transition-opacity" alt="">
            </a>
        </div>
    </div>
</x-property-manager-layout>
