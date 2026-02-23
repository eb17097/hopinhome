<div x-data="{ 
        show: false,
        isLoading: false,
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
                    this.show = false;
                    this.new_password = '';
                    this.new_password_confirmation = '';
                    // Optional: show a success message or toast
                    alert('Password reset successfully');
                } else {
                    this.errors = data.errors || { message: data.message };
                }
            } catch (err) {
                console.error(err);
            } finally {
                this.isLoading = false;
            }
        }
     }" 
     @open-reset-password-modal.window="show = true"
     x-show="show" 
     class="fixed inset-0 z-[60] flex items-center justify-center" 
     style="display: none;">
    
    {{-- Background overlay --}}
    <div x-show="show" 
         x-transition:enter="ease-out duration-300" 
         x-transition:enter-start="opacity-0" 
         x-transition:enter-end="opacity-100" 
         x-transition:leave="ease-in duration-200" 
         x-transition:leave-start="opacity-100" 
         x-transition:leave-end="opacity-0" 
         @click="show = false"
         class="fixed inset-0 bg-black bg-opacity-40"></div>

    {{-- Modal panel --}}
    <div x-show="show" 
         x-transition:enter="ease-out duration-300" 
         x-transition:enter-start="opacity-0 scale-95" 
         x-transition:enter-end="opacity-100 scale-100" 
         x-transition:leave="ease-in duration-200" 
         x-transition:leave-start="opacity-100 scale-100" 
         x-transition:leave-end="opacity-0 scale-95" 
         class="inline-block w-full max-w-[560px] overflow-hidden text-left align-middle transition-all transform bg-white shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] rounded-[14px] relative z-10">
        
        {{-- Header --}}
        <div class="px-6 py-4 border-b border-[#e8e8e7] flex items-center justify-between relative">
            <button @click="show = false" class="text-[#1447d4] hover:opacity-70 transition-opacity z-10">
                <img src="{{ asset('images/close.svg') }}" class="w-6 h-6 brightness-0 [filter:invert(22%)_sepia(77%)_saturate(5734%)_hue-rotate(219deg)_brightness(85%)_contrast(95%)]" alt="Close">
            </button>
            <h3 class="absolute inset-0 flex items-center justify-center text-[18px] font-medium text-[#1e1d1d] pointer-events-none">
                Reset password
            </h3>
            <div class="w-6"></div>
        </div>

        <div class="p-8">
            <h4 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">Set your new password</h4>
            <p class="text-[16px] text-[#464646] leading-[1.5] mb-8">Enter a new password for your account.</p>
            
            <div class="space-y-6">
                {{-- New Password --}}
                <div>
                    <label class="block text-[16px] font-medium text-[#1e1d1d] mb-2">New password</label>
                    <div class="relative">
                        <input :type="showNewPassword ? 'text' : 'password'" 
                               x-model="new_password"
                               class="w-full h-[52px] px-4 border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors text-[16px]"
                               placeholder="••••••••••••">
                        <button type="button" @click="showNewPassword = !showNewPassword" class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-400 hover:text-gray-600">
                            <svg x-show="!showNewPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg x-show="showNewPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 .95-3.036 3.401-5.413 6.32-6.32m8.905 8.905a10.025 10.025 0 01-1.318 1.318M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21L3 3"></path></svg>
                        </button>
                    </div>
                    <template x-if="errors.password">
                        <p class="mt-2 text-sm text-red-600" x-text="errors.password[0]"></p>
                    </template>
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label class="block text-[16px] font-medium text-[#1e1d1d] mb-2">Confirm new password</label>
                    <div class="relative">
                        <input :type="showConfirmPassword ? 'text' : 'password'" 
                               x-model="new_password_confirmation"
                               class="w-full h-[52px] px-4 border border-[#e8e8e7] rounded-[8px] focus:border-[#1447d4] focus:ring-1 focus:ring-[#1447d4] outline-none transition-colors text-[16px]"
                               placeholder="Enter new password again">
                        <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute inset-y-0 right-0 px-4 flex items-center text-gray-400 hover:text-gray-600">
                            <svg x-show="!showConfirmPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg x-show="showConfirmPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7 .95-3.036 3.401-5.413 6.32-6.32m8.905 8.905a10.025 10.025 0 01-1.318 1.318M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21L3 3"></path></svg>
                        </button>
                    </div>
                </div>

                <button @click="handleReset" 
                        :disabled="isLoading"
                        class="w-full h-[52px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px] flex items-center justify-center disabled:opacity-70">
                    <span x-show="!isLoading">Reset password</span>
                    <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
