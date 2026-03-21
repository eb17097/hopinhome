<x-onboarding.layout step="3" :backUrl="route('onboarding.back')" x-data="{ isLoading: false, hasPhoto: {{ auth()->user()->profile_photo_url ? 'true' : 'false' }} }" @photo-updated="hasPhoto = $event.detail.hasPhoto">
    <form id="onboarding-photo-form" @submit.prevent="
        isLoading = true;
        const formData = new FormData($el);
        fetch('{{ route('onboarding.step3') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                window.location.href = data.redirect;
            }
        })
        .catch(() => { isLoading = false; });
    ">
        <h1 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-[12px] leading-[1.28]">Upload a profile photo</h1>
        <p class="text-[16px] text-[#464646] mb-[24px] leading-[1.5]">This photo is visible only to property managers and helps them recognize you better.</p>

        <!-- Profile Picture Field -->
        <x-onboarding.profile-photo-uploader :initialPhoto="auth()->user()->profile_photo_url ? auth()->user()->getProfilePhotoUrl() : null" />
    </form>

    <x-slot:actions>
        <div class="flex justify-between items-center gap-8">
            <button type="button" @click="$dispatch('open-skip-setup-modal', { skipUrl: '{{ route('onboarding.skip') }}' })"
                    class="text-[14px] leading-[1.5] text-[#464646] underline hover:text-[#1e1d1d] transition-colors">
                Set up later
            </button>
            <x-onboarding.step-button
                type="submit"
                form="onboarding-photo-form"
                width="w-full lg:w-44"
                disabled="!hasPhoto"
            >
                <span x-text="hasPhoto ? 'Finish setup' : 'Next'">Next</span>
            </x-onboarding.step-button>
        </div>
    </x-slot:actions>

    <x-modals.onboarding-profile-photo-modal
        :action="route('onboarding.step3')"
        :redirectTo="route('onboarding.index')"
    />
    <x-modals.skip-setup-modal />
</x-onboarding.layout>
