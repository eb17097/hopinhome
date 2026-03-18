<x-modals.layout
    name="reset-password"
    title="Reset password"
    x-data="{
        show: false,
        isLoading: false,
        step: 'form',
        new_password: '',
        new_password_confirmation: '',
        showNewPassword: false,
        showConfirmPassword: false,
        errors: {},

        async handleReset() {
            this.isLoading = true;
            this.errors = {};

            try {
                const response = await fetch('{{ route('ajax.password.update') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        password: this.new_password,
                        password_confirmation: this.new_password_confirmation
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    this.step = 'success';
                    this.new_password = '';
                    this.new_password_confirmation = '';
                    this.$dispatch('show-toast', { message: 'Settings updated' });
                } else {
                    this.errors = data.errors || { message: data.message };
                }
            } catch (err) {
                console.error(err);
            } finally {
                this.isLoading = false;
            }
        },

        close() {
            this.show = false;
            setTimeout(() => {
                this.step = 'form';
                this.new_password = '';
                this.new_password_confirmation = '';
                this.errors = {};
            }, 300);
        }
     }"
>
    {{-- Form Step --}}
    <div x-show="step === 'form'">
        <h4 class="text-[20px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-[6px]">Set your new password</h4>
        <p class="text-[16px] text-[#464646] leading-[1.5] mb-[24px]">Enter a new password for your account.</p>

        <div>
            {{-- New Password --}}
            <div>
                <label class="block text-[14px] font-medium text-[#1e1d1d] mb-[6px]">New password</label>
                <div class="relative">
                    <input :type="showNewPassword ? 'text' : 'password'"
                           x-model="new_password"
                           class="w-full h-[52px] px-4 border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors text-[16px]"
                           placeholder="••••••••••••">
                    <button type="button" @click="showNewPassword = !showNewPassword" class="absolute inset-y-0 right-0 px-4 flex items-center">
                        <img x-show="!showNewPassword" src="{{ asset('images/pass_visibility_visible.svg') }}" class="w-5 h-5" alt="Show password">
                        <img x-show="showNewPassword" src="{{ asset('images/pass_visibility_off.svg') }}" class="w-5 h-5" alt="Hide password" style="display: none;">
                    </button>
                </div>
                <template x-if="errors.password">
                    <p class="mt-2 text-sm text-red-600" x-text="errors.password[0]"></p>
                </template>
            </div>

            {{-- Confirm Password --}}
            <div>
                <label class="block text-[14px] font-medium text-[#1e1d1d] mb-[6px] mt-[16px]">Confirm new password</label>
                <div class="relative">
                    <input :type="showConfirmPassword ? 'text' : 'password'"
                           x-model="new_password_confirmation"
                           class="w-full h-[52px] px-4 border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors text-[16px]"
                           placeholder="Enter new password again">
                    <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute inset-y-0 right-0 px-4 flex items-center">
                        <img x-show="!showConfirmPassword" src="{{ asset('images/pass_visibility_visible.svg') }}" class="w-5 h-5" alt="Show password">
                        <img x-show="showConfirmPassword" src="{{ asset('images/pass_visibility_off.svg') }}" class="w-5 h-5" alt="Hide password" style="display: none;">
                    </button>
                </div>
            </div>

            <button @click="handleReset"
                    :disabled="isLoading"
                    class="mt-[16px] w-full h-[52px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px] flex items-center justify-center disabled:opacity-70">
                <span x-show="!isLoading">Reset password</span>
                <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
        </div>
    </div>

    {{-- Success Step --}}
    <div x-show="step === 'success'" style="display: none;">
        <h4 class="text-[20px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-[6px]">Your new password is set</h4>
        <p class="text-[16px] text-[#464646] leading-[1.5] mb-[24px]">The new password is set for your account.</p>

        <button @click="close()" class="w-full h-[52px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px] flex items-center justify-center">
            Log In
        </button>
    </div>
</x-modals.layout>
