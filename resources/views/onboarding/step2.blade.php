<x-onboarding.layout step="2" :backUrl="route('onboarding.back')" x-data="onboardingStep({ bio: {{ json_encode(auth()->user()->bio ?? '') }}, maxChars: 500 })">
    <h1 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-[12px] leading-[1.28]">Tell us about yourself</h1>
    <p class="text-[16px] text-[#464646] mb-[24px] leading-[1.5]">This information is visible only to property managers and helps them get to know you better.</p>

    <!-- Bio Input Area -->
    <div class="mb-[16px]">
        <div class="flex justify-between items-center mb-1.5">
            <label class="text-[14px] font-medium text-[#1e1d1d] leading-[1.5]">Bio (optional)</label>
            <span class="text-[14px] text-[#464646] leading-[1.5]" x-text="(data.maxChars - data.bio.length) + ' characters remaining'"></span>
        </div>
        <textarea
            x-model="data.bio"
            maxlength="500"
            placeholder="Write your bio here"
            class="w-full h-[204px] p-[18px] border border-[#e8e8e7] rounded-[6px] focus:border-[#1447d4] focus:ring-0 resize-none transition-all placeholder:text-[#464646] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] text-[16px] text-[#1e1d1d]"
        ></textarea>
    </div>

    <!-- Suggestion Box -->
    <div class="flex items-start gap-[8px] px-[14px] py-[16px] bg-[#f9f9f8] rounded-[6px]">
        <img src="{{ asset('images/contact_support_blue.svg') }}" alt="" class="w-7 h-7 shrink-0">
        <p class="text-[14px] leading-[1.5] text-[#464646]">
            <span class="font-medium text-[#1e1d1d]">Suggestion:</span>
            Share a bit about yourself—where you’re from, whether you have any pets, and what you do for a living.
        </p>
    </div>

    <x-slot:actions>
        <div class="flex justify-between items-center gap-6">
            <button @click="$dispatch('open-skip-setup-modal', { skipUrl: '{{ route('onboarding.skip') }}' })"
                    class="text-[14px] text-[#464646] leading-[1.5] underline hover:text-[#1e1d1d] transition-colors">
                Set up later
            </button>
            <x-onboarding.step-button
                @click="submit('{{ route('onboarding.step2') }}')"
                disabled="!data.bio.trim()"
            >
                Next
            </x-onboarding.step-button>
        </div>
    </x-slot:actions>

    <x-modals.skip-setup-modal />
</x-onboarding.layout>
