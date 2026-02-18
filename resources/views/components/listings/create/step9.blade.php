<div>
    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">How much will the property cost to rent?</h3>
    <p class="text-[16px] text-[#464646] mb-8">Fill in the information.</p>

    <input type="hidden" name="payment_option" x-model="formData.payment_option">
    <input type="hidden" name="utilities_option" x-model="formData.utilities_option">

    <div class="space-y-10">
        {{-- Payment option --}}
        <div>
            <label class="block text-[14px] font-medium text-[#1e1d1d] mb-4">Payment option</label>
            <div class="flex gap-3">
                @foreach(['Yearly', 'Monthly', 'Weekly'] as $option)
                    <button type="button" 
                            @click="formData.payment_option = '{{ $option }}'" 
                            :class="{ 'bg-[#1447d4] text-white border-[#1447d4] shadow-md': formData.payment_option === '{{ $option }}', 'bg-white text-[#1e1d1d] border-[#e8e8e7]': formData.payment_option !== '{{ $option }}' }" 
                            class="border rounded-full h-10 px-6 flex items-center justify-center text-[16px] font-medium transition-all hover:border-[#1447d4] min-w-[112px]">
                        {{ $option }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Utilities --}}
        <div>
            <label class="block text-[14px] font-medium text-[#1e1d1d] mb-4">Utilities</label>
            <div class="flex gap-3">
                @foreach(['Included', 'Excluded'] as $option)
                    <button type="button" 
                            @click="formData.utilities_option = '{{ $option }}'" 
                            :class="{ 'bg-[#1447d4] text-white border-[#1447d4] shadow-md': formData.utilities_option === '{{ $option }}', 'bg-white text-[#1e1d1d] border-[#e8e8e7]': formData.utilities_option !== '{{ $option }}' }" 
                            class="border rounded-full h-10 px-6 flex items-center justify-center text-[16px] font-medium transition-all hover:border-[#1447d4] min-w-[151px]">
                        {{ $option }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Price Input --}}
        <div>
            <label for="price" class="block text-[14px] font-medium text-[#1e1d1d] mb-2">Price per <span x-text="formData.payment_option.toLowerCase()">year</span></label>
            <div class="relative">
                <input 
                    type="number" 
                    name="price" 
                    id="price" 
                    x-model.number="formData.price" 
                    class="w-full px-4 py-3 border border-[#e8e8e7] rounded-[6px] focus:ring-2 focus:ring-[#1447d4] focus:border-transparent transition-all outline-none text-[16px]" 
                    placeholder="500,000"
                >
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-[#464646] text-[16px] font-medium">
                    AED
                </div>
            </div>
        </div>
    </div>
</div>