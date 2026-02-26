<x-main-layout title="Onboarding - HopinHome">
    <div class="flex h-screen overflow-hidden bg-white" x-data="{ bio: {{ json_encode(auth()->user()->bio ?? '') }}, isLoading: false, maxChars: 500 }">
        <!-- Left Side -->
        <div class="w-full lg:w-1/2 flex flex-col p-8 lg:p-16 overflow-y-auto">
            <!-- Logo & Back Button -->
            <div class="flex items-center gap-6 mb-12">
                <a href="#" onclick="window.history.back()" class="hover:opacity-70 transition-opacity">
                    <img src="{{ asset('images/arrow_left_white_notail.svg') }}" alt="Back" class="w-6 h-6 brightness-0">
                </a>
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopinHome" class="h-8">
                </a>
            </div>

            <!-- Progress Bar -->
            <div class="w-full max-w-[560px] mb-16">
                <div class="h-1.5 w-full bg-[#e8e8e7] rounded-full overflow-hidden">
                    <div class="h-full bg-[#1447d4] rounded-full" style="width: 50%"></div>
                </div>
            </div>

            <!-- Heading -->
            <div class="max-w-[560px] w-full mx-auto lg:mx-0">
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

                <!-- Action Buttons -->
                <div class="mt-auto pt-8 flex flex-col gap-6">
                    <div class="flex justify-center lg:justify-start">
                        <button @click="
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
                        :disabled="!bio.trim() || isLoading"
                        class="w-full lg:w-40 bg-[#1447d4] text-white py-3.5 rounded-full font-medium text-[16px] tracking-[-0.48px] hover:bg-blue-800 transition-all flex justify-center items-center disabled:opacity-20 disabled:cursor-not-allowed">
                            <span x-show="!isLoading">Next</span>
                            <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex justify-center lg:justify-start">
                        <button @click="$dispatch('open-skip-setup-modal', { skipUrl: '{{ route('onboarding.index') }}' })" 
                                class="text-[14px] text-[#464646] underline hover:text-[#1e1d1d] transition-colors">
                            Set up later
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side (Blue) -->
        <div class="hidden lg:block w-1/2 bg-[#1447d4] relative overflow-hidden">
            <div class="absolute -bottom-[20%] left-1/2 -translate-x-1/2 w-[120%] opacity-10">
                <img src="{{ asset('images/hopinhome_symbol_white.svg') }}" alt="" class="w-full h-auto">
            </div>
        </div>
    </div>

    <x-modals.skip-setup-modal />
</x-main-layout>
