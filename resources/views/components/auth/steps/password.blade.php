<x-auth.step-layout title="Log in" :showBack="true">
    <p class="text-[20px] font-medium leading-[1.28] tracking-[-0.4px] text-[#464646] mb-[24px]">Enter your password to continue</p>
    
    <form @submit.prevent="handleLogin">
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1.5">Password</label>
            <div class="relative">
                <input x-model="password" :type="showPassword ? 'text' : 'password'" id="password"
                       class="w-full h-[52px] px-4 border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors text-[16px]"
                       placeholder="••••••••••••" @input="passwordError = ''">
                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 px-4 flex items-center">
                    <img x-show="!showPassword" src="{{ asset('images/pass_visibility_visible.svg') }}" class="w-5 h-5" alt="Show password">
                    <img x-show="showPassword" src="{{ asset('images/pass_visibility_off.svg') }}" class="w-5 h-5" alt="Hide password" style="display: none;">
                </button>
            </div>
        </div>
        
        <div x-show="passwordError" x-text="passwordError" class="text-red-500 text-sm mt-2"></div>
        <div x-show="error && !passwordError" x-text="error" class="text-red-500 text-sm mt-2"></div>
        
        <button type="submit" :disabled="isLoading"
                class="w-full bg-electric-blue text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors mt-[16px] flex justify-center items-center disabled:opacity-70">
            <span x-show="!isLoading">Log in</span>
            <template x-if="isLoading">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </template>
        </button>
        
        <button type="button" @click="handleForgotPassword" class="block w-full text-center text-sm underline mt-[16px]">
            Forgot password?
        </button>
    </form>
</x-auth.step-layout>
