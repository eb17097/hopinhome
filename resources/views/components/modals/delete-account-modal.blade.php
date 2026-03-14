<div x-data="{
        show: false,
        isLoading: false,
        confirmation: '',
        errors: {},

        async handleDelete() {
            this.isLoading = true;
            this.errors = {};

            try {
                const response = await fetch('{{ route('profile.destroy') }}', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        confirmation: this.confirmation
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    window.location.href = data.redirect || '/';
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
                this.confirmation = '';
                this.errors = {};
            }, 300);
        }
     }"
     @open-delete-account-modal.window="show = true"
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
         @click="close()"
         class="fixed inset-0 bg-black bg-opacity-40"></div>

    {{-- Modal panel --}}
    <div x-show="show"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95"
         class="inline-block w-full max-w-[444px] overflow-hidden text-left align-middle transition-all transform bg-white shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] rounded-[14px] relative z-10">

        {{-- Header --}}
        <div class="px-6 py-4 border-b border-[#e8e8e7] flex items-center justify-between relative">
            <button @click="close()" class="text-[#1447d4] hover:opacity-70 transition-opacity z-10">
                <img src="{{ asset('images/close_blue.svg') }}" class="w-[25px] h-[25px]" alt="Close">
            </button>
            <h3 class="absolute inset-0 flex items-center justify-center text-[18px] font-medium text-[#1e1d1d] pointer-events-none">
                Delete account
            </h3>
            <div class="w-6"></div>
        </div>

        {{-- Form --}}
        <div class="pt-[32px] pb-[40px] px-[24px]">
            <h4 class="text-[20px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-[6px]">Are you sure?</h4>
            <p class="text-[16px] text-[#464646] leading-[1.5] mb-[24px]">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please type <strong class="text-[#ed0707]">Delete my account</strong> to confirm.
            </p>

            <div>
                {{-- Confirmation Input --}}
                <div>
                    <label class="block text-[14px] font-medium text-[#1e1d1d] mb-[6px]">Confirmation</label>
                    <div class="relative">
                        <input type="text"
                               x-model="confirmation"
                               @keyup.enter="handleDelete"
                               class="w-full h-[52px] px-4 border border-[#e8e8e7] rounded-[8px] focus:border-[#ed0707] focus:ring-1 focus:ring-[#ed0707] outline-none transition-colors text-[16px]"
                               placeholder="Delete my account">
                    </div>
                    <template x-if="errors.confirmation">
                        <p class="mt-2 text-sm text-[#ed0707]" x-text="errors.confirmation[0]"></p>
                    </template>
                </div>

                <button @click="handleDelete"
                        :disabled="isLoading"
                        class="mt-[24px] w-full h-[52px] bg-[#ed0707] hover:bg-[#c40606] text-white font-medium rounded-[8px] transition-all text-[16px] flex items-center justify-center disabled:opacity-70">
                    <span x-show="!isLoading">Delete Account</span>
                    <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>
