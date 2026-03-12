<x-auth.step-layout title="Forgot password?">
    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">Check your email</h3>
    <p class="text-[16px] text-[#464646] mb-8 leading-[1.5]">We've sent a reset link to your email.</p>

    <button @click="step = 'password'" class="w-full bg-[#1447d4] text-white py-[14px] rounded-[8px] font-medium text-[16px] hover:bg-blue-800 transition-colors mt-4">
        Log In
    </button>
</x-auth.step-layout>
