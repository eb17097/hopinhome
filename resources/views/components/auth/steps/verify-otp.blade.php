@props(['title' => 'Verify your email', 'type' => 'signup'])

<x-auth.step-layout :title="$title" :showBack="true" :backStep="$type === '2fa' ? 'password' : 'email'">
    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-[6px]">{{ $title }}</h3>
    <p class="text-[16px] text-[#464646] mb-[24px] leading-[1.5]">
        We sent a 6-digit code to <span class="font-medium text-[#1e1d1d]" x-text="email"></span>.
    </p>

    <form @submit.prevent="{{ $type === '2fa' ? 'handleVerify2FA' : 'handleVerifyOtp' }}">
        <div>
            <label class="block text-[14px] font-medium text-[#1e1d1d] mb-[8px]">Verification code</label>
            <x-otp-input :name="$type === '2fa' ? 'otp-input-2fa' : 'otp-input-signup'" />
            
            <div x-show="otpError || otpSuccessMessage"
                 x-text="otpError || otpSuccessMessage"
                 class="text-sm mt-3 font-medium"
                 :class="otpError ? 'text-red-500' : 'text-green-600'"></div>
        </div>

        <button type="submit" :disabled="isLoading || isResending"
                class="w-full bg-[#1447d4] text-white py-[14px] rounded-[8px] font-medium text-[16px] hover:bg-blue-800 transition-colors mt-8 flex justify-center items-center disabled:opacity-70"
                :class="{'opacity-50 pointer-events-none': isResending}">
            <span x-show="!isLoading">{{ $type === '2fa' ? 'Verify' : 'Continue' }}</span>
            <template x-if="isLoading">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </template>
        </button>
    </form>

    <x-auth.resend-section :selector="$type === '2fa' ? '.otp-input-2fa' : '.otp-input-signup'" />
</x-auth.step-layout>
