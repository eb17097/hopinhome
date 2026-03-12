<x-auth.step-layout title="Sign up" :showBack="true">
    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-[6px]">Set up your profile</h3>
    <p class="text-[16px] text-[#464646] mb-6 leading-[1.5]">Enter your details to get started</p>

    <form @submit.prevent="handleRegister" class="mb-0">
        <div class="space-y-4">
            <div class="flex gap-4">
                <div class="flex-1">
                    <label class="block text-[14px] font-medium text-[#1e1d1d] mb-[6px]">First name</label>
                    <input x-model="firstName" type="text" class="shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] h-[51px] w-full px-[18px] py-[14px] border border-[#e8e8e7] rounded-[6px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors" placeholder="John" @input="registerError = ''">
                </div>
                <div class="flex-1">
                    <label class="block text-[14px] font-medium text-[#1e1d1d] mb-[6px]">Last name</label>
                    <input x-model="lastName" type="text" class="shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] h-[51px] w-full px-[18px] py-[14px] border border-[#e8e8e7] rounded-[6px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors" placeholder="Your last name" @input="registerError = ''">
                </div>
            </div>

            <div>
                <label class="block text-[14px] font-medium text-[#1e1d1d] mb-[6px]">Email address</label>
                <input x-model="email" type="email" readonly class="shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] h-[51px] w-full px-[18px] py-[14px] border border-[#e8e8e7] bg-gray-50 rounded-[6px] text-gray-500 cursor-not-allowed outline-none">
            </div>

            <div>
                <label class="block text-[14px] font-medium text-[#1e1d1d] mb-[6px]">Password</label>
                <div class="relative">
                    <input x-model="password" :type="showRegisterPassword ? 'text' : 'password'" class="shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] h-[51px] w-full h-[52px] px-4 border border-[#e8e8e7] rounded-[6px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors text-[16px]" placeholder="••••••••••••" @input="registerError = ''">
                    <button type="button" @click="showRegisterPassword = !showRegisterPassword" class="absolute inset-y-0 right-0 px-4 flex items-center">
                        <img x-show="!showRegisterPassword" src="{{ asset('images/pass_visibility_visible.svg') }}" class="w-5 h-5" alt="Show password">
                        <img x-show="showRegisterPassword" src="{{ asset('images/pass_visibility_off.svg') }}" class="w-5 h-5" alt="Hide password" style="display: none;">
                    </button>
                </div>
            </div>

            <div>
                <label class="block text-[14px] font-medium text-[#1e1d1d] mb-[6px]">Country</label>
                <div class="relative">
                    <select x-model="country" class="shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] h-[51px] w-full px-[18px] py-[14px] pl-10 border border-[#e8e8e7] rounded-[6px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors appearance-none bg-white">
                        <option value="" disabled selected>Select a country</option>
                        <option value="United Arab Emirates">United Arab Emirates</option>
                        <option value="United States">United States</option>
                        <option value="United Kingdom">United Kingdom</option>
                        <option value="Saudi Arabia">Saudi Arabia</option>
                    </select>
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <img src="{{ asset('images/language_black.svg') }}" alt="Language" class="w-[22px]">
                    </div>
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-y-4">
                <div class="flex">
                    <label class="relative flex items-center justify-center w-5 h-5 mt-0.5">
                        <input type="checkbox" x-model="agreeTerms" class="peer sr-only">
                        <div class="w-5 h-5 border border-gray-300 rounded bg-white peer-checked:bg-[#1447d4] peer-checked:border-[#1447d4] transition-colors"></div>
                        <svg class="absolute w-3.5 h-3.5 text-white pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </label>
                    <span class="text-[14px] font-medium">I agree to the Terms of Service and Privacy Policy.</span>
                </div>
                <div class="flex">
                    <label class="relative flex items-center justify-center w-5 h-5 mt-0.5">
                        <input type="checkbox" x-model="receiveUpdates" class="peer sr-only">
                        <div class="w-5 h-5 border border-gray-300 rounded bg-white peer-checked:bg-[#1447d4] peer-checked:border-[#1447d4] transition-colors"></div>
                        <svg class="absolute w-3.5 h-3.5 text-white pointer-events-none opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </label>
                    <span class="text-[14px] font-medium">I want to receive updates and offers from HopInHome.</span>
                </div>
            </div>
        </div>

        <div x-show="registerError" x-text="registerError" class="text-red-500 text-sm mt-4"></div>

        <button type="submit" :disabled="isLoading" class="w-full bg-[#1447d4] text-white py-[14px] rounded-[8px] font-medium text-[16px] hover:bg-blue-800 transition-colors mt-6 flex justify-center items-center disabled:opacity-70">
            <span x-show="!isLoading">Create account</span>
            <template x-if="isLoading">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </template>
        </button>
    </form>
</x-auth.step-layout>
