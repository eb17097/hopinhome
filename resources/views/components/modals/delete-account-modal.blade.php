<x-modals.layout
    name="delete-account"
    title="Delete account"
    x-data="{
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
>
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
</x-modals.layout>
