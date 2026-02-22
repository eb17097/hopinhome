@php
    $user = auth()->user();
@endphp

<div x-data="{ 
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
                    this.show = false;
                } else {
                    console.error('Failed to save regional preferences');
                }
            } catch (error) {
                console.error('Error saving regional preferences:', error);
            } finally {
                this.loading = false;
            }
        }
     }" 
     @open-regional-preferences-modal.window="show = true"
     x-show="show" 
     class="fixed inset-0 z-[60] overflow-y-auto" 
     style="display: none;">
    
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        {{-- Background overlay --}}
        <div x-show="show" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             @click="show = false"
             class="fixed inset-0 transition-opacity bg-black bg-opacity-40"></div>

        {{-- Modal panel --}}
        <div x-show="show" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             class="inline-block w-full max-w-[444px] my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] rounded-[14px]">
            
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-[#e8e8e7] flex items-center justify-between relative">
                <button @click="show = false" class="text-[#1447d4] hover:opacity-70 transition-opacity z-10">
                    <img src="{{ asset('images/close.svg') }}" class="w-6 h-6 brightness-0 [filter:invert(22%)_sepia(77%)_saturate(5734%)_hue-rotate(219deg)_brightness(85%)_contrast(95%)]" alt="Close">
                </button>
                <h3 class="absolute inset-0 flex items-center justify-center text-[18px] font-medium text-[#1e1d1d] pointer-events-none">
                    Regional preferences
                </h3>
                <div class="w-6"></div>
            </div>

            <div class="p-8">
                {{-- Region --}}
                <div class="mb-6">
                    <label class="block text-[16px] font-medium text-[#1e1d1d] mb-2">Region</label>
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
                <div class="mb-6">
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
                <div class="mb-6">
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
                <div class="mb-10">
                    <label class="block text-[16px] font-medium text-[#1e1d1d] mb-4">Measurement units</label>
                    <div class="grid grid-cols-2 gap-4">
                        <button @click="unit = 'm2'" 
                                :class="unit === 'm2' ? 'border-[#1447d4] bg-white' : 'border-[#e8e8e7] bg-white'"
                                class="flex flex-col items-start p-4 border rounded-[8px] text-left transition-all relative">
                            <span class="text-[18px] font-medium text-[#1e1d1d]">m²</span>
                            <span class="text-[14px] text-[#464646]">Square meters</span>
                            <div x-show="unit === 'm2'" class="absolute top-4 right-4">
                                <img src="{{ asset('images/white_checkmark_on_blue.svg') }}" class="w-5 h-5" alt="selected">
                            </div>
                            <div x-show="unit !== 'm2'" class="absolute top-4 right-4 w-5 h-5 rounded-full border border-[#e8e8e7]"></div>
                        </button>
                        <button @click="unit = 'sqft'" 
                                :class="unit === 'sqft' ? 'border-[#1447d4] bg-white' : 'border-[#e8e8e7] bg-white'"
                                class="flex flex-col items-start p-4 border rounded-[8px] text-left transition-all relative">
                            <span class="text-[18px] font-medium text-[#1e1d1d]">sq ft</span>
                            <span class="text-[14px] text-[#464646]">Square feet</span>
                            <div x-show="unit === 'sqft'" class="absolute top-4 right-4">
                                <img src="{{ asset('images/white_checkmark_on_blue.svg') }}" class="w-5 h-5" alt="selected">
                            </div>
                            <div x-show="unit !== 'sqft'" class="absolute top-4 right-4 w-5 h-5 rounded-full border border-[#e8e8e7]"></div>
                        </button>
                    </div>
                </div>

                <div class="mt-8">
                    <button @click="saveRegionalPreferences()" 
                            :disabled="loading"
                            class="w-full h-[52px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px] flex items-center justify-center disabled:opacity-70">
                        <span x-show="!loading">Save changes</span>
                        <svg x-show="loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
