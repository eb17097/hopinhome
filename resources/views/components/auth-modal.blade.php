<div x-data="authModal"
     @open-auth-modal.window="showModal = true"
     @close-auth-modal.window="showModal = false; setTimeout(() => resetModal(), 300)"
     x-show="showModal"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60"
     style="display: none;">

    <div class="bg-white rounded-xl shadow-lg w-full max-w-md mx-auto relative overflow-hidden"
         x-show="showModal"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95">

        <!-- Steps -->
        <div x-show="step === 'email'">
            <x-auth.steps.email />
        </div>

        <div x-show="step === 'password'" style="display: none;">
            <x-auth.steps.password />
        </div>

        <div x-show="step === 'verify_email'" style="display: none;">
            <x-auth.steps.verify-otp type="signup" />
        </div>

        <div x-show="step === 'finish_signup'" style="display: none;">
            <x-auth.steps.finish-signup />
        </div>

        <div x-show="step === 'forgot_password_sent'" style="display: none;">
            <x-auth.steps.forgot-password-sent />
        </div>

        <div x-show="step === 'reset_password'" style="display: none;">
            <x-auth.steps.reset-password />
        </div>

        <div x-show="step === 'password_reset_success'" style="display: none;">
            <x-auth.steps.password-reset-success />
        </div>

        <div x-show="step === 'two_factor_verify'" style="display: none;">
            <x-auth.steps.verify-otp type="2fa" title="Verify your login" />
        </div>

    </div>
</div>
