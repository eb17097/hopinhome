<x-onboarding.layout step="2" :backUrl="route('onboarding.back')" x-data="{ bio: {{ json_encode(auth()->user()->bio ?? '') }}, isLoading: false, maxChars: 500 }">
    <h1 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-2 leading-[1.28]">Tell us about yourself</h1>
    <p class="text-[16px] text-[#464646] mb-8 leading-[1.5]">This information is visible only to property managers and helps them get to know you better.</p>

    <!-- Bio Input Area -->
    <div class="mb-6">
        <div class="flex justify-between items-center mb-1.5">
            <label class="text-[14px] font-medium text-[#1e1d1d]">Bio</label>
            <span class="text-[14px] text-[#464646]" x-text="(maxChars - bio.length) + ' characters remaining'"></span>
        </div>
        <textarea
            x-model="bio"
            maxlength="500"
            placeholder="Write your bio here"
            class="w-full h-[204px] p-4 border border-[#e8e8e7] rounded-lg focus:border-[#1447d4] focus:ring-0 resize-none transition-all placeholder:text-[#464646] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] text-[16px] text-[#1e1d1d]"
        ></textarea>
    </div>

    <!-- Suggestion Box -->
    <div class="flex items-start gap-4 p-5 bg-[#f9f9f8] rounded-lg mb-12">
        <img src="{{ asset('images/contact_support_blue.svg') }}" alt="" class="w-7 h-7 shrink-0">
        <p class="text-[14px] leading-[1.5] text-[#464646]">
            <span class="font-medium text-[#1e1d1d]">Suggestion:</span>
            Share a bit about yourself—where you’re from, whether you have any pets, and what you do for a living.
        </p>
    </div>

    <x-slot:actions>
        <div class="flex justify-between items-center gap-6">
            <button @click="$dispatch('open-skip-setup-modal', { skipUrl: '{{ route('onboarding.skip') }}' })"
                    class="text-[14px] text-[#464646] underline hover:text-[#1e1d1d] transition-colors">
                Set up later
            </button>
            <x-onboarding.step-button
                @click="
                    isLoading = true;
                    fetch('{{ route('onboarding.step2') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ bio: bio })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            window.location.href = data.redirect;
                        }
                    })
                    .catch(err => {
                        isLoading = false;
                        console.error(err);
                    })
                "
                disabled="!bio.trim()"
            >
                Next
            </x-onboarding.step-button>
        </div>
    </x-slot:actions>

    <x-modals.skip-setup-modal />
</x-onboarding.layout>
