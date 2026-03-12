<x-auth.step-layout title="Reset password" :onClose="'showModal = false; setTimeout(() => resetModal(), 300)'">
    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-1">Set your new password</h3>
    <p class="text-[16px] text-[#464646] mb-6 leading-[1.5]">Enter a new password for your account.</p>

    <form @submit.prevent="handleResetPassword">
        <div class="space-y-4">
            <div>
                <label class="block text-[14px] font-medium text-[#1e1d1d] mb-1.5">New password</label>
                <div class="relative">
                    <input x-model="password" :type="showPassword ? 'text' : 'password'" class="w-full h-[52px] px-4 border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors text-[16px]" placeholder="••••••••••••" @input="error = ''">
                    <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 px-4 flex items-center">
                        <img x-show="!showPassword" src="{{ asset('images/pass_visibility_visible.svg') }}" class="w-5 h-5" alt="Show password">
                        <img x-show="showPassword" src="{{ asset('images/pass_visibility_off.svg') }}" class="w-5 h-5" alt="Hide password" style="display: none;">
                    </button>
                </div>
            </div>

            <div>
                <label class="block text-[14px] font-medium text-[#1e1d1d] mb-1.5">Confirm new password</label>
                <div class="relative">
                    <input x-model="passwordConfirmation" :type="showRegisterPassword ? 'text' : 'password'" class="w-full h-[52px] px-4 border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors text-[16px]" placeholder="••••••••••••" @input="error = ''">
                    <button type="button" @click="showRegisterPassword = !showRegisterPassword" class="absolute inset-y-0 right-0 px-4 flex items-center">
                        <img x-show="!showRegisterPassword" src="{{ asset('images/pass_visibility_visible.svg') }}" class="w-5 h-5" alt="Show password">
                        <img x-show="showRegisterPassword" src="{{ asset('images/pass_visibility_off.svg') }}" class="w-5 h-5" alt="Hide password" style="display: none;">
                    </button>
                </div>
            </div>
        </div>

        <div x-show="error" x-text="error" class="text-red-500 text-sm mt-4"></div>

        <button type="submit" :disabled="isLoading" class="w-full bg-[#1447d4] text-white py-[14px] rounded-[8px] font-medium text-[16px] hover:bg-blue-800 transition-colors mt-6 flex justify-center items-center disabled:opacity-70">
            <span x-show="!isLoading">Reset password</span>
            <template x-if="isLoading">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </template>
        </button>
    </form>
</x-auth.step-layout>
