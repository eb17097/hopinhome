@props(['selector'])

<p class="text-[14px] text-[#464646] text-center mt-[16px]">
    Didn't receive a code?
    <button @click="resendOtp('{{ $selector }}')"
            :disabled="resendTimer > 0 || isResending"
            class="underline decoration-solid transition-colors relative"
            :class="{'text-gray-400 cursor-not-allowed': resendTimer > 0 || isResending, 'text-[#464646] hover:text-black': resendTimer === 0 && !isResending}">
        <span :class="{'opacity-0': isResending && resendTimer === 0}">Resend <span x-show="resendTimer > 0" x-text="`in 0:${resendTimer < 10 ? '0' : ''}${resendTimer}`"></span></span>
        <div x-show="isResending && resendTimer === 0" class="absolute inset-0 flex items-center justify-center">
            <svg class="animate-spin h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </div>
    </button>
</p>
