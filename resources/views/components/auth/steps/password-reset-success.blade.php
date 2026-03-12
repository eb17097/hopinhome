<x-auth.step-layout title="Reset password">
    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">Your new password is set</h3>
    <p class="text-[16px] text-[#464646] mb-8 leading-[1.5]">The new password is set for your account.</p>

    <button @click="step = 'password'" class="w-full bg-[#1447d4] text-white py-[14px] rounded-[8px] font-medium text-[16px] hover:bg-blue-800 transition-colors mt-4">
        Log In
    </button>
</x-auth.step-layout>
