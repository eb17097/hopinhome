<x-modals.layout
    name="skip-setup"
    title="Are you sure?"
    maxWidth="480px"
    closeIcon="images/close.svg"
    x-data="{
        show: false,
        skipUrl: '',
        close() {
            this.show = false;
        }
    }"
    @open-skip-setup-modal.window="show = true; skipUrl = $event.detail.skipUrl"
>
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
                @click="close()"
                class="w-full h-[52px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px]">
            Continue setup
        </button>
    </div>
</x-modals.layout>
