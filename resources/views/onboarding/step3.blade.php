<x-main-layout title="Onboarding - HopinHome">
    <div class="flex h-screen overflow-hidden bg-white" x-data="{ isLoading: false }">
        <!-- Left Side -->
        <div class="w-full lg:w-1/2 flex flex-col p-8 lg:p-16 overflow-y-auto">
            <!-- Back Arrow & Logo -->
            <div class="flex items-center gap-6 mb-12">
                <a href="#" onclick="window.history.back()" class="hover:opacity-70 transition-opacity">
                    <img src="{{ asset('images/arrow_left_white_notail.svg') }}" alt="Back" class="w-6 h-6 brightness-0">
                </a>
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopinHome" class="h-6">
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
                <h1 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-2 leading-[1.28]">Upload a profile photo</h1>
                <p class="text-[16px] text-[#464646] mb-8 leading-[1.5]">This photo is visible only to property managers and helps them recognize you better.</p>

                <!-- Profile Picture Field -->
                <div class="mb-6">
                    <label class="text-[14px] font-medium text-[#1e1d1d] block mb-2">Profile picture</label>
                    
                    <div @click="$dispatch('open-profile-photo-modal')" 
                        class="w-full h-[204px] border border-[#1447d4] border-dashed rounded-lg flex flex-col items-center justify-center cursor-pointer hover:bg-blue-50 transition-all overflow-hidden bg-white">
                        
                        @if(auth()->user()->profile_photo_url)
                            <div class="relative w-full h-full flex items-center justify-center bg-gray-50">
                                <img src="{{ auth()->user()->getProfilePhotoUrl() }}" alt="Profile" class="h-full w-auto object-contain">
                                <div class="absolute inset-0 bg-black/40 opacity-0 hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <p class="text-white font-medium">Change photo</p>
                                </div>
                            </div>
                        @else
                            <div class="flex flex-col items-center">
                                <div class="w-[54px] h-[54px] mb-4">
                                    <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="54" height="54" rx="27" fill="#F0F4FF"/>
                                        <path d="M27 31V23M27 23L24 26M27 23L30 26M19 31.5V32.2C19 33.8802 19 34.7202 19.327 35.362C19.6146 35.9265 20.0735 36.3854 20.638 36.673C21.2798 37 22.1198 37 23.8 37H30.2C31.8802 37 32.7202 37 33.362 36.673C33.9265 36.3854 34.3854 35.9265 34.673 35.362C35 34.7202 35 33.8802 35 32.2V31.5M31 20.5C31 22.7091 29.2091 24.5 27 24.5C24.7909 24.5 23 22.7091 23 20.5C23 18.2909 24.7909 16.5 27 16.5C29.2091 16.5 31 18.2909 31 20.5Z" stroke="#1447D4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <p class="text-[16px] font-medium text-[#1e1d1d] mb-1">Tap to upload your photo</p>
                                <p class="text-[14px] text-[#464646]">Or simply drag your file here</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Suggestion Box -->
                <div class="flex items-start gap-4 p-5 bg-[#f9f9f8] rounded-lg mb-12">
                    <img src="{{ asset('images/contact_support_blue.svg') }}" alt="" class="w-7 h-7 shrink-0">
                    <p class="text-[14px] leading-[1.5] text-[#464646]">
                        <span class="font-medium text-[#1e1d1d]">Suggestion:</span>
                        Use an image where you are the only one in the frame so property managers can easily recognize you.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col items-center lg:items-start gap-8">
                    <button @click="
                        @if(auth()->user()->profile_photo_url)
                            isLoading = true;
                            fetch('{{ route('onboarding.step3') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
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
                        @else
                            $dispatch('open-profile-photo-modal')
                        @endif
                    "
                    :disabled="isLoading"
                    class="w-full lg:w-40 bg-[#1447d4] text-white py-3.5 rounded-full font-medium text-[16px] tracking-[-0.48px] hover:bg-blue-800 transition-all flex justify-center items-center disabled:opacity-20 {{ !auth()->user()->profile_photo_url ? 'opacity-20' : '' }}">
                        <span x-show="!isLoading">Next</span>
                        <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>

                    <button @click="$dispatch('open-skip-setup-modal', { skipUrl: '{{ route('onboarding.index') }}' })" 
                            class="text-[14px] text-[#464646] underline hover:text-[#1e1d1d] transition-colors">
                        Set up later
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Side (Blue) -->
        <div class="hidden lg:block w-1/2 bg-[#1447d4] relative">
            <div class="absolute inset-0 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('images/hopinhome_logo_white.svg') }}" alt="" class="w-full opacity-10 transform scale-150 rotate-[-15deg]">
            </div>
        </div>
    </div>

    <x-modals.change-profile-photo-modal 
        :action="route('onboarding.step3')" 
        :redirectTo="route('onboarding.index')" 
    />
    <x-modals.skip-setup-modal />
</x-main-layout>
