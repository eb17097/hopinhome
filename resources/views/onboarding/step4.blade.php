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
                    <div class="h-full bg-[#1447d4] rounded-full" style="width: 100%"></div>
                </div>
            </div>

            <!-- Heading -->
            <div class="max-w-[560px] w-full mx-auto lg:mx-0">
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

                <!-- Action Button -->
                <button @click="
                    isLoading = true;
                    fetch('{{ route('onboarding.complete') }}', {
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
                class="w-full lg:w-56 bg-[#1447d4] text-white py-4 rounded-full font-medium text-[16px] tracking-[-0.48px] hover:bg-blue-800 transition-all flex justify-center items-center disabled:opacity-20">
                    <span x-show="!isLoading">Start exploring</span>
                    <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Right Side (Blue) -->
        <div class="hidden lg:block w-1/2 bg-[#1447d4] relative">
            <div class="absolute inset-0 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('images/hopinhome_logo_white.svg') }}" alt="" class="w-full opacity-10 transform scale-150 rotate-[-15deg]">
            </div>
        </div>
    </div>
</x-main-layout>
