@php
    $user = auth()->user();
@endphp

<x-modals.layout
    name="regional-preferences"
    title="Regional preferences"
    x-data="{
        show: false,
        loading: false,
        region: '{{ $user?->region ?? 'United Arab Emirates' }}',
        language: '{{ $user?->language ?? 'English' }}',
        currency: '{{ $user?->currency ?? 'AED - United Arab Emirates Dirham' }}',
        unit: '{{ $user?->measurement_unit ?? 'm2' }}',

        async saveRegionalPreferences() {
            this.loading = true;
            try {
                const response = await fetch('{{ route('regional-preferences.update') }}', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        region: this.region,
                        language: this.language,
                        currency: this.currency,
                        measurement_unit: this.unit
                    })
                });

                if (response.ok) {
                    window.dispatchEvent(new CustomEvent('show-toast', {
                        detail: { message: 'Settings updated' }
                    }));
                    this.show = false;
                } else {
                    console.error('Failed to save regional preferences');
                }
            } catch (error) {
                console.error('Error saving regional preferences:', error);
            } finally {
                this.loading = false;
            }
        },

        close() {
            this.show = false;
        }
     }"
>
    {{-- Region --}}
    <div class="mb-[28px]">
        <label class="block text-[16px] font-medium text-[#1e1d1d] mb-[12px]">Region</label>
        <div class="relative">
            <select x-model="region" class="w-full h-[52px] pl-4 pr-10 py-2 bg-white border border-[#e8e8e7] rounded-[8px] appearance-none focus:outline-none focus:ring-0 text-[16px] text-[#1e1d1d]">
                <option>United Arab Emirates</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                <img src="{{ asset('images/keyboard_arrow_down.svg') }}" class="w-5 h-5 opacity-60" alt="">
            </div>
        </div>
    </div>

    {{-- Language --}}
    <div class="mb-[28px]">
        <label class="block text-[16px] font-medium text-[#1e1d1d] mb-2">Language</label>
        <div class="relative">
            <select x-model="language" class="w-full h-[52px] pl-4 pr-10 py-2 bg-white border border-[#e8e8e7] rounded-[8px] appearance-none focus:outline-none focus:ring-0 text-[16px] text-[#1e1d1d]">
                <option>English</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                <img src="{{ asset('images/keyboard_arrow_down.svg') }}" class="w-5 h-5 opacity-60" alt="">
            </div>
        </div>
    </div>

    {{-- Currency --}}
    <div class="mb-[28px]">
        <label class="block text-[16px] font-medium text-[#1e1d1d] mb-2">Currency</label>
        <div class="relative">
            <select x-model="currency" class="w-full h-[52px] pl-4 pr-10 py-2 bg-white border border-[#e8e8e7] rounded-[8px] appearance-none focus:outline-none focus:ring-0 text-[16px] text-[#1e1d1d]">
                <option>AED - United Arab Emirates Dirham</option>
            </select>
            <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none">
                <img src="{{ asset('images/keyboard_arrow_down.svg') }}" class="w-5 h-5 opacity-60" alt="">
            </div>
        </div>
    </div>

    {{-- Measurement Units --}}
    <div class="mb-[40px]">
        <label class="block text-[16px] font-medium text-[#1e1d1d] mb-[12px]">Measurement units</label>
        <div class="grid grid-cols-2 gap-[16px]">
            <button @click="unit = 'm2'"
                    :class="unit === 'm2' ? 'border-[#1447d4] bg-white' : 'border-[#e8e8e7] bg-white'"
                    class="flex flex-col items-start p-[18px] border rounded-[8px] text-left transition-all relative">
                <span class="text-[18px] font-medium text-[#1e1d1d]">m²</span>
                <span class="text-[14px] text-[#464646]">Square meters</span>
                <div x-show="unit === 'm2'" class="absolute top-1/2 -translate-y-1/2 right-[22px]">
                    <img src="{{ asset('images/white_checkmark_on_blue.svg') }}" class="w-[24px] h-[24px]" alt="selected">
                </div>
                <div x-show="unit !== 'm2'" class="absolute top-1/2 -translate-y-1/2 right-[22px] w-[24px] h-[24px] rounded-full border border-[#e8e8e7]"></div>
            </button>
            <button @click="unit = 'sqft'"
                    :class="unit === 'sqft' ? 'border-[#1447d4] bg-white' : 'border-[#e8e8e7] bg-white'"
                    class="flex flex-col items-start p-[18px] border rounded-[8px] text-left transition-all relative">
                <span class="text-[18px] font-medium text-[#1e1d1d]">sq ft</span>
                <span class="text-[14px] text-[#464646]">Square feet</span>
                <div x-show="unit === 'sqft'" class="absolute top-1/2 -translate-y-1/2 right-[22px]">
                    <img src="{{ asset('images/white_checkmark_on_blue.svg') }}" class="w-[24px] h-[24px]" alt="selected">
                </div>
                <div x-show="unit !== 'sqft'" class="absolute top-1/2 -translate-y-1/2 right-[22px] w-[24px] h-[24px] rounded-full border border-[#e8e8e7]"></div>
            </button>
        </div>
    </div>

    <div>
        <button @click="saveRegionalPreferences()"
                :disabled="loading"
                class="leading-[1.18] tracking-[-0.48px] w-full h-[51px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px] flex items-center justify-center disabled:opacity-70">
            <span x-show="!loading">Save changes</span>
            <svg x-show="loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </button>
    </div>
</x-modals.layout>
