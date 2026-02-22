<div x-data="{ 
        show: false
     }" 
     @open-account-security-modal.window="show = true"
     x-show="show" 
     class="fixed inset-0 z-[60] overflow-y-auto" 
     style="display: none;">
    
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        {{-- Background overlay --}}
        <div x-show="show" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             @click="show = false"
             class="fixed inset-0 transition-opacity bg-black bg-opacity-40"></div>

        {{-- Modal panel --}}
        <div x-show="show" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             class="inline-block w-full max-w-[560px] my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] rounded-[14px]">
            
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-[#e8e8e7] flex items-center justify-between relative">
                <button @click="show = false" class="text-[#1447d4] hover:opacity-70 transition-opacity z-10">
                    <img src="{{ asset('images/close.svg') }}" class="w-6 h-6 brightness-0 [filter:invert(22%)_sepia(77%)_saturate(5734%)_hue-rotate(219deg)_brightness(85%)_contrast(95%)]" alt="Close">
                </button>
                <h3 class="absolute inset-0 flex items-center justify-center text-[18px] font-medium text-[#1e1d1d] pointer-events-none">
                    Account security
                </h3>
                <div class="w-6"></div>
            </div>

            <div class="p-8 space-y-4">
                {{-- Add a phone number --}}
                <button class="w-full flex items-center justify-between p-6 border border-[#e8e8e7] rounded-[6px] hover:bg-gray-50 transition-colors text-left group">
                    <span class="text-[16px] font-medium text-[#1e1d1d]">Add a phone number</span>
                    <img src="{{ asset('images/arrow_forward_black.svg') }}" class="w-[18px] h-[18px] opacity-60 group-hover:opacity-100 transition-opacity" alt="">
                </button>

                {{-- Reset password --}}
                <button class="w-full flex items-center justify-between p-6 border border-[#e8e8e7] rounded-[6px] hover:bg-gray-50 transition-colors text-left group">
                    <span class="text-[16px] font-medium text-[#1e1d1d]">Reset password</span>
                    <img src="{{ asset('images/arrow_forward_black.svg') }}" class="w-[18px] h-[18px] opacity-60 group-hover:opacity-100 transition-opacity" alt="">
                </button>

                {{-- Delete account --}}
                <button class="w-full flex items-center justify-between p-6 border border-[#ed0707] rounded-[6px] hover:bg-red-50 transition-colors text-left group mt-4">
                    <span class="text-[16px] font-medium text-[#ed0707]">Delete account</span>
                    <img src="{{ asset('images/arrow_forward_red.svg') }}" class="w-[18px] h-[18px] opacity-60 group-hover:opacity-100 transition-opacity" alt="">
                </button>
            </div>
        </div>
    </div>
</div>
