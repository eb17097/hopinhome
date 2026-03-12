@props(['show' => false])

<div
    x-show="{{ $show }}"
    class="fixed inset-0 z-[60] overflow-y-auto"
    style="display: none;"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @close-modal.window="if ($event.detail == 'exit-listing-creation') { {{ $show }} = false; nextUrl = null; }"
>
    {{-- Overlay --}}
    <div class="fixed inset-0 bg-[#00000040] transition-opacity" @click="{{ $show }} = false; nextUrl = null;"></div>

    <div class="flex min-h-full items-center justify-center p-4">
        <div
            class="relative bg-white rounded-[14px] shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] w-full max-w-[444px] overflow-hidden"
            @click.away="{{ $show }} = false; nextUrl = null;"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        >
            {{-- Header --}}
            <div class="flex items-center px-6 py-[20px] border-b border-[#e8e8e7]">
                <button @click="{{ $show }} = false; nextUrl = null;" class="shrink-0">
                    <img src="{{ asset('images/close.svg') }}" alt="Close" class="w-6 h-6">
                </button>
                <h3 class="flex-1 text-center text-[18px] font-medium text-[#1e1d1d] tracking-[-0.36px]">Exit listing creation</h3>
                <div class="w-6"></div> {{-- Spacer to balance the close button --}}
            </div>

            {{-- Body --}}
            <div class="p-6">
                <h4 class="text-[20px] font-medium text-[#1e1d1d] tracking-[-0.4px] mb-2.5">Are you sure?</h4>
                <p class="text-[16px] text-[#464646] leading-[1.5]">
                    This will move your listing to <span class="font-medium text-[#1e1d1d]">drafts.</span>
                    <br>
                    You can continue anytime.
                </p>
            </div>

            {{-- Footer/Actions --}}
            <div class="px-6 pb-10 space-y-4">
                <button type="button" @click="$dispatch('save-as-draft'); {{ $show }} = false" class="w-full h-[51px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[6px] transition-colors text-[16px] tracking-[-0.48px] flex items-center justify-center">
                    Save as draft
                </button>

                <button type="button" @click="window.location.href = nextUrl || '{{ route('property_manager.index') }}'" class="w-full h-[51px] border border-[#e8e8e7] hover:bg-gray-50 text-[#1e1d1d] font-medium rounded-[6px] transition-colors text-[16px] tracking-[-0.48px] flex items-center justify-center">
                    Discard and exit
                </button>
                
                <button type="button" @click="{{ $show }} = false; nextUrl = null;" class="w-full text-center text-[14px] text-[#464646] underline decoration-solid leading-[1.5]">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>
