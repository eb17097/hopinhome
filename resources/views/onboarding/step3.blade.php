<x-main-layout title="Onboarding - HopinHome">
    <div class="flex h-screen overflow-hidden bg-white" x-data="{ isLoading: false, hasPhoto: {{ auth()->user()->profile_photo_url ? 'true' : 'false' }} }" @photo-updated="hasPhoto = $event.detail.hasPhoto">
        <!-- Left Side -->
        <div class="w-full lg:w-1/2 flex flex-col p-8 lg:p-16 overflow-y-auto">
            <!-- Logo & Back Button -->
            <div class="flex items-center gap-6 mb-12">
                <a href="{{ route('onboarding.back') }}" class="hover:opacity-70 transition-opacity">
                    <img src="{{ asset('images/arrow_left_blue.svg') }}" alt="Back" class="w-6 h-6">
                </a>
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopinHome" class="h-8">
                </a>
            </div>

            <!-- Progress Bar -->
            <div class="w-full max-w-[560px] mb-16">
                <div class="h-1.5 w-full bg-[#e8e8e7] rounded-full overflow-hidden">
                    <div class="h-full bg-[#1447d4] rounded-full" style="width: 75%"></div>
                </div>
            </div>

            <!-- Heading -->
            <div class="max-w-[560px] w-full mx-auto lg:mx-0">
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
                    <h1 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-2 leading-[1.28]">Upload a profile photo</h1>
                    <p class="text-[16px] text-[#464646] mb-8 leading-[1.5]">This photo is visible only to property managers and helps them recognize you better.</p>

                    <!-- Profile Picture Field -->
                    <x-onboarding.profile-photo-uploader :initialPhoto="auth()->user()->profile_photo_url ? auth()->user()->getProfilePhotoUrl() : null" />

                    <!-- Action Buttons -->
                    <div class="flex justify-between items-center gap-8">
                        <button type="button" @click="$dispatch('open-skip-setup-modal', { skipUrl: '{{ route('onboarding.index') }}' })"
                                class="text-[14px] text-[#464646] underline hover:text-[#1e1d1d] transition-colors">
                            Set up later
                        </button>
                        <button type="submit"
                        :disabled="isLoading || !hasPhoto"
                        class="w-full lg:w-44 bg-[#1447d4] text-white py-3.5 rounded-full font-medium text-[16px] tracking-[-0.48px] hover:bg-blue-800 transition-all flex justify-center items-center disabled:opacity-20">
                            <span x-show="!isLoading" x-text="hasPhoto ? 'Finish setup' : 'Next'">Next</span>
                            <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side (Blue) -->
        <div class="hidden lg:block w-1/2 bg-[#1447d4] relative overflow-hidden">
            <div style="bottom:-20%; right:-25%; width: 120%;" class="absolute opacity-10">
                <img src="{{ asset('images/hopinhome_symbol_white.svg') }}" alt="" class="w-full h-auto">
            </div>
        </div>
    </div>

    <x-modals.onboarding-profile-photo-modal
        :action="route('onboarding.step3')"
        :redirectTo="route('onboarding.index')"
    />
    <x-modals.skip-setup-modal />
</x-main-layout>
