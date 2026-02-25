<x-main-layout title="Onboarding - HopinHome">
    <div class="flex h-screen overflow-hidden bg-white" x-data="{ isLoading: false }">
        <!-- Left Side -->
        <div class="w-full lg:w-1/2 flex flex-col p-8 lg:p-16 overflow-y-auto">
            <!-- Logo -->
            <div class="mb-12">
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
                <h1 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-2 leading-[1.28]">Upload a profile photo</h1>
                <p class="text-[16px] text-[#464646] mb-8 leading-[1.5]">This photo is visible only to property managers and helps them recognize you better.</p>

                <!-- Profile Picture Trigger -->
                <div class="mb-6">
                    <label class="text-[14px] font-medium text-[#1e1d1d] block mb-2">Profile picture</label>
                    
                    <button @click="$dispatch('open-profile-photo-modal')" class="bg-white border border-[#e8e8e7] rounded-[6px] px-6 py-[26px] flex justify-between items-center w-full hover:bg-gray-50 transition-colors shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]">
                        <div class="flex items-center gap-4">
                            @if(auth()->user()->profile_photo_url)
                                <img src="{{ Storage::url(auth()->user()->profile_photo_url) }}" alt="Profile" class="w-12 h-12 rounded-full object-cover">
                                <span class="text-[16px] font-medium text-[#1e1d1d]">Change profile picture</span>
                            @else
                                <div class="w-12 h-12 bg-[#f9f9f8] rounded-full flex items-center justify-center">
                                    <img src="{{ asset('images/account_circle.svg') }}" alt="" class="w-6 h-6 opacity-40">
                                </div>
                                <span class="text-[16px] font-medium text-[#1e1d1d]">Add profile picture</span>
                            @endif
                        </div>
                        <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
                    </button>
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
                <div class="flex flex-col lg:flex-row items-center gap-8">
                    @if(auth()->user()->profile_photo_url)
                        <button @click="
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
                        "
                        :disabled="isLoading"
                        class="w-full lg:w-40 bg-[#1447d4] text-white py-3.5 rounded-full font-medium text-[16px] tracking-[-0.48px] hover:bg-blue-800 transition-all flex justify-center items-center disabled:opacity-20">
                            <span x-show="!isLoading">Next</span>
                            <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    @else
                        <button disabled class="w-full lg:w-40 bg-[#1447d4] text-white py-3.5 rounded-full font-medium text-[16px] tracking-[-0.48px] opacity-20 cursor-not-allowed">
                            Next
                        </button>
                    @endif

                    <button @click="
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
                    " class="text-[14px] text-[#464646] underline hover:text-[#1e1d1d] transition-colors">
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

    {{-- Modal Inclusion --}}
    <x-modals.change-profile-photo-modal 
        :action="route('onboarding.step3')" 
        :redirectTo="route('onboarding.index')" 
    />
</x-main-layout>
