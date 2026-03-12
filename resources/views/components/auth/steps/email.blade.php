<x-auth.step-layout title="Log in or sign up" :onClose="'showModal = false; setTimeout(() => resetModal(), 300)'">
    <div class="space-y-[16px]">
        <a href="{{ route('auth.google') }}" class="h-[52px] w-full flex items-center justify-center gap-[6px] px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 font-medium hover:bg-gray-50 transition-colors">
            <img src="{{ asset('images/google.svg') }}" alt="Google icon" class="h-[17px] w-[17px]">
            Continue with Google
        </a>
        <button class="h-[52px] w-full flex items-center justify-center gap-3 px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 font-medium opacity-50 pointer-events-none cursor-not-allowed transition-colors">
            <img src="{{ asset('images/facebook.svg') }}" alt="Facebook icon" class="h-[17px] w-[17px]">
            Continue with Facebook
        </button>
        <button class="h-[52px] w-full flex items-center justify-center gap-3 px-4 py-2.5 border border-gray-200 rounded-lg text-gray-700 font-medium opacity-50 pointer-events-none cursor-not-allowed transition-colors">
            <img src="{{ asset('images/apple.svg') }}" alt="Apple icon" class="h-[17px] w-[17px]">
            Continue with Apple
        </button>
    </div>

    <div class="flex items-center my-10">
        <hr class="flex-grow border-gray-200">
        <span class="px-[8px] text-gray-400 text-[14px]">or</span>
        <hr class="flex-grow border-gray-200">
    </div>

    <form @submit.prevent="handleEmailContinue">
        <div>
            <label for="email-phone" class="block text-sm font-medium text-[#1E1D1D] mb-[6px]">Email address or phone number</label>
            <input x-model="email" @input="emailError = ''" type="text" id="email-phone" class="h-[51px] w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors" placeholder="Enter your email or phone">
            <div x-show="emailError" x-text="emailError" class="text-red-500 text-sm mt-2"></div>
        </div>
        <button type="submit" :disabled="isLoading" class="h-[51px] w-full bg-electric-blue text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors mt-3 flex justify-center items-center disabled:opacity-70">
            <span x-show="!isLoading">Continue</span>
            <template x-if="isLoading">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </template>
        </button>
    </form>
    <p class="text-[14px] text-gray-600 text-center mt-6">By continuing, you agree to our <a href="#" class="underline">Terms</a> & <a href="#" class="underline">Privacy Policy</a>.</p>
</x-auth.step-layout>
