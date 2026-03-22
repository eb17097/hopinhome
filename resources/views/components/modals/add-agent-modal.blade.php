@props(['name' => 'add-agent'])

<x-modals.layout
    :name="$name"
    title="Add an agent"
    maxWidth="444px"
    paddingClass="pt-[24px] pb-[32px] px-[24px]"
    x-data="{
        show: false,
        isLoading: false,
        successMessage: '',
        errors: {},

        fullName: '',
        email: '',
        licenseNumber: '',
        listingLimit: '50',
        boostLimit: '10',

        async handleInvite() {
            this.isLoading = true;
            this.errors = {};
            this.successMessage = '';

            try {
                const response = await fetch('{{ route('business_owner.agents.invite') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        fullName: this.fullName,
                        email: this.email,
                        licenseNumber: this.licenseNumber,
                        listingLimit: this.listingLimit,
                        boostLimit: this.boostLimit
                    })
                });

                const data = await response.json();

                if (response.ok) {
                    this.successMessage = data.message;
                    // Reset form
                    this.fullName = '';
                    this.email = '';
                    this.licenseNumber = '';

                    // Close after delay or show success state
                    setTimeout(() => {
                        this.close();
                        window.location.reload(); // Refresh to see the new agent (as invited)
                    }, 2000);
                } else {
                    this.errors = data.errors || { message: data.message };
                }
            } catch (err) {
                console.error(err);
                this.errors = { message: 'An unexpected error occurred.' };
            } finally {
                this.isLoading = false;
            }
        },

        close() {
            this.show = false;
            this.successMessage = '';
            this.errors = {};
        }
    }"
>
    <div>
        {{-- Success Message --}}
        <template x-if="successMessage">
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-[6px] flex items-center space-x-2">
                <img src="{{ asset('images/check.svg') }}" class="w-5 h-5 brightness-0" style="filter: invert(33%) sepia(87%) saturate(451%) hue-rotate(85deg) brightness(93%) contrast(85%);" alt="">
                <span x-text="successMessage"></span>
            </div>
        </template>

        {{-- Available Seats --}}
        <div class="bg-[#f9f9f8] rounded-[6px] p-[14px] flex justify-between items-center mb-[24px]">
            <span class="text-[16px] text-[#1e1d1d] font-normal">Available seats</span>
            <div class="flex items-center space-x-1.5">
                <span class="text-[20px] font-medium text-[#1e1d1d]">5</span>
                <img src="{{ asset('images/group.svg') }}" class="w-5 h-5 brightness-0" alt="">
            </div>
        </div>

        {{-- Form Fields --}}
        <div class="space-y-[16px] mb-[24px]">
            <div>
                <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px]">Full name</label>
                <input type="text" x-model="fullName" placeholder="Enter agent's full name"
                       :class="errors.fullName ? 'border-red-500 focus:ring-red-500' : 'border-light-gray focus:ring-electric-blue'"
                       class="w-full h-[44px] px-[14px] border rounded-[6px] text-[15px] focus:outline-none focus:ring-1 placeholder:text-[#464646]">
                <template x-if="errors.fullName">
                    <p class="mt-1 text-xs text-red-500" x-text="errors.fullName[0]"></p>
                </template>
            </div>

            <div>
                <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px]">Email address</label>
                <input type="email" x-model="email" placeholder="agent@example.com"
                       :class="errors.email ? 'border-red-500 focus:ring-red-500' : 'border-light-gray focus:ring-electric-blue'"
                       class="w-full h-[44px] px-[14px] border rounded-[6px] text-[15px] focus:outline-none focus:ring-1 placeholder:text-[#464646]">
                <template x-if="errors.email">
                    <p class="mt-1 text-xs text-red-500" x-text="errors.email[0]"></p>
                </template>
            </div>

            <div>
                <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px]">Agent license number</label>
                <input type="text" x-model="licenseNumber" placeholder="Enter license number"
                       class="w-full h-[44px] px-[14px] border border-light-gray rounded-[6px] text-[15px] focus:outline-none focus:ring-1 focus:ring-electric-blue placeholder:text-[#464646]">
            </div>

            <div class="flex gap-[16px]">
                <div class="flex-1">
                    <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px]">Listing credit limit</label>
                    <input type="number" x-model="listingLimit" class="w-full h-[44px] px-[14px] border border-light-gray rounded-[6px] text-[15px] focus:outline-none focus:ring-1 focus:ring-electric-blue">
                </div>
                <div class="flex-1">
                    <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px]">Boost credit limit</label>
                    <input type="number" x-model="boostLimit" class="w-full h-[44px] px-[14px] border border-light-gray rounded-[6px] text-[15px] focus:outline-none focus:ring-1 focus:ring-electric-blue">
                </div>
            </div>
        </div>

        {{-- Info Box --}}
        <div class="bg-[#f9f9f8] rounded-[6px] p-[14px] flex items-start space-x-3 mb-[24px]">
            <img src="{{ asset('images/contact_support_blue.svg') }}" class="w-5 h-5 mt-0.5 shrink-0" alt="">
            <p class="text-[14px] leading-[1.5] text-[#464646]">
                Credit limits <span class="font-bold text-[#1e1d1d]">reset</span> every billing cycle. Unused credits do not roll over to the next month
            </p>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col space-y-4">
            <button @click="handleInvite" :disabled="isLoading"
                    class="w-full h-[51px] bg-electric-blue text-white rounded-[50px] text-[16px] font-medium hover:opacity-90 transition-opacity flex items-center justify-center">
                <span x-show="!isLoading">Send invite</span>
                <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
            <button @click="close()" :disabled="isLoading" class="text-[15px] text-[#464646] font-medium hover:text-[#1e1d1d] transition-colors">
                Cancel
            </button>
        </div>
    </div>
</x-modals.layout>
