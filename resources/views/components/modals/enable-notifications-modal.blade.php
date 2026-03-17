<x-modals.layout
    name="notifications"
    title="Enable notifications"
    x-data="{
        show: false,
        close() {
            this.show = false;
        }
    }"
>
    <h4 class="text-[20px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-[6px]">Stay up to date</h4>
    <p class="text-[16px] text-[#464646] leading-[1.5] mb-[8px]">Turn on notifications to receive messages, updates, and important alerts.</p>

    <div class="bg-[#f9f9f8] rounded-[6px] h-[53px] flex items-center px-[14px] mb-[32px]">
        <div class="flex-shrink-0 mr-3">
            <img src="{{ asset('images/contact_support_blue.svg') }}" class="w-[28px] h-[28px]" alt="Support">
        </div>
        <p class="text-[15px] text-[#464646]">You can change your preferences at any time.</p>
    </div>

    <div class="space-y-4">
        <button @click="show = false; $dispatch('open-notification-preferences-modal')"
                class="w-full h-[52px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px]">
            Go to notification preferences
        </button>
    </div>
</x-modals.layout>
