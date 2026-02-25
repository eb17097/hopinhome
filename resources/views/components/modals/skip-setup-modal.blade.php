<div x-data="{ 
        show: false,
        skipUrl: ''
     }" 
     @open-skip-setup-modal.window="show = true; skipUrl = $event.detail.skipUrl"
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
             class="inline-block w-full max-w-[480px] my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] rounded-[14px]">
            
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-[#e8e8e7] flex items-center justify-between relative">
                <button type="button" @click="show = false" class="text-[#1e1d1d] hover:opacity-70 transition-opacity z-10">
                    <img src="{{ asset('images/close.svg') }}" class="w-6 h-6" alt="Close">
                </button>
                <h3 class="absolute inset-0 flex items-center justify-center text-[18px] font-medium text-[#1e1d1d] pointer-events-none">
                    Are you sure?
                </h3>
                <div class="w-6"></div>
            </div>

            <div class="p-8">
                <h2 class="text-[24px] font-medium text-[#1e1d1d] mb-4 leading-[1.28]">
                    Do you want to skip the setup?
                </h2>
                <p class="text-[16px] text-[#464646] mb-10 leading-[1.5]">
                    You can complete your profile later, but some features will only be available once it’s set up.
                </p>

                {{-- Actions --}}
                <div class="space-y-4">
                    <button type="button" 
                            @click="window.location.href = skipUrl"
                            class="w-full h-[52px] border border-[#1447d4] text-[#1447d4] font-medium rounded-[8px] hover:bg-blue-50 transition-colors text-[16px]">
                        Skip setup
                    </button>
                    <button type="button" 
                            @click="show = false"
                            class="w-full h-[52px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px]">
                        Continue setup
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
