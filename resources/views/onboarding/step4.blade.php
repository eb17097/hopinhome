<x-onboarding.layout step="4" :backUrl="route('onboarding.back')" x-data="onboardingStep()">
    <div class="flex items-center gap-[8px] mb-[12px]">
        <h1 class="text-[40px] font-medium text-[#1e1d1d] tracking-[-0.8px] leading-[1.28]">You’re all set</h1>
        <img src="{{ asset('images/smaller_white_checkmark_on_blue.svg') }}" alt="" class="relative top-[2px] w-[28px] h-[28px]">
    </div>
    <p class="text-[16px] text-[#464646] leading-[1.5]">Your profile is complete, and you can begin using the platform!</p>

    <x-slot:actions>
        <x-onboarding.step-button
            style="margin-left: auto;"
            width="w-[213px]"
            @click="submit('{{ route('onboarding.complete') }}')"
        >
            Start exploring
        </x-onboarding.step-button>
    </x-slot:actions>
</x-onboarding.layout>
