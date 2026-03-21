<x-onboarding.layout step="1" x-data="onboardingStep({ role_intent: '' })">
    <h1 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-[12px] leading-[1.28]">Let’s get started</h1>
    <p class="text-[16px] text-[#464646] mb-[24px] leading-[1.5]">What do you plan to do?</p>

    <!-- Options -->
    <div class="space-y-4">
        <x-onboarding.role-card 
            value="renter" 
            title="I am looking to" 
            highlight="rent" 
            description="I want to find rental properties." 
        />

        <x-onboarding.role-card 
            value="agent" 
            title="I am a real estate" 
            highlight="agent" 
            description="I want to post property listings as a self employed agent." 
        />

        <x-onboarding.role-card 
            value="brokerage" 
            title="I have a real estate" 
            highlight="brokerage" 
            description="I want my agents to post property listings on behalf of the business." 
        />

        <x-onboarding.role-card 
            value="owner" 
            title="I am a property" 
            highlight="owner" 
            description="I want to rent out my own property." 
        />
    </div>

    <x-slot:actions>
        <x-onboarding.step-button
            style="margin-left: auto;"
            @click="submit('{{ route('onboarding.step1') }}')"
            disabled="!data.role_intent"
        >
            Next
        </x-onboarding.step-button>
    </x-slot:actions>
</x-onboarding.layout>
