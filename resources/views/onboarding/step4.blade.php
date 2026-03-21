<x-onboarding.layout step="4" :backUrl="route('onboarding.back')" x-data="onboardingStep()">
    <div class="flex items-center gap-4 mb-4">
        <h1 class="text-[40px] font-medium text-[#1e1d1d] tracking-[-0.8px] leading-[1.28]">You’re all set</h1>
        <img src="{{ asset('images/checkmark.svg') }}" alt="" class="w-7 h-7">
    </div>
    <p class="text-[16px] text-[#464646] mb-12 leading-[1.5]">Your profile is complete, and you can begin using the platform at your own pace. If you’d like, you can also take a quick walkthrough.</p>

    <!-- Tour Box -->
    <div class="flex items-start gap-4 p-8 bg-[#f9f9f8] rounded-lg mb-12">
        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center shrink-0 shadow-sm">
            <img src="{{ asset('images/contact_support_blue.svg') }}" alt="" class="w-6 h-6">
        </div>
        <div>
            <h3 class="text-[20px] font-medium text-[#1e1d1d] tracking-[-0.4px] mb-2">Get started with a tour</h3>
            <p class="text-[16px] text-[#464646] mb-4 leading-[1.5]">Learn the basics in just a few steps and make the most of all the features.</p>
            <a href="#" class="text-[16px] font-medium text-[#1447d4] underline hover:text-blue-800 transition-colors">Learn how it works</a>
        </div>
    </div>

    <x-slot:actions>
        <x-onboarding.step-button
            style="margin-left: auto;"
            width="w-full lg:w-56"
            @click="submit('{{ route('onboarding.complete') }}')"
        >
            Start exploring
        </x-onboarding.step-button>
    </x-slot:actions>
</x-onboarding.layout>
