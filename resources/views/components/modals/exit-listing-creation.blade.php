<x-modals.layout
    name="exit-listing-creation"
    title="Exit listing creation"
    closeIcon="images/close.svg"
    x-data="{
        show: false,
        nextUrl: null,
        close() {
            this.show = false;
            this.nextUrl = null;
        }
    }"
    @open-exit-listing-creation-modal.window="show = true; nextUrl = $event.detail.nextUrl;"
>
    {{-- Body --}}
    <div>
        <h4 class="text-[20px] font-medium text-[#1e1d1d] tracking-[-0.4px] mb-2.5">Are you sure?</h4>
        <p class="text-[16px] text-[#464646] leading-[1.5]">
            This will move your listing to <span class="font-medium text-[#1e1d1d]">drafts.</span>
            <br>
            You can continue anytime.
        </p>
    </div>

    {{-- Footer/Actions --}}
    <div class="mt-6 space-y-4">
        <button type="button" @click="$dispatch('save-as-draft'); close()" class="w-full h-[51px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[6px] transition-colors text-[16px] tracking-[-0.48px] flex items-center justify-center">
            Save as draft
        </button>

        <button type="button" @click="window.location.href = nextUrl || '{{ route('property_manager.index') }}'" class="w-full h-[51px] border border-[#e8e8e7] hover:bg-gray-50 text-[#1e1d1d] font-medium rounded-[6px] transition-colors text-[16px] tracking-[-0.48px] flex items-center justify-center">
            Discard and exit
        </button>

        <button type="button" @click="close()" class="w-full text-center text-[14px] text-[#464646] underline decoration-solid leading-[1.5]">
            Cancel
        </button>
    </div>
</x-modals.layout>
