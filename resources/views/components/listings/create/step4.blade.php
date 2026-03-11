<div>
    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">More property details</h3>
    <p class="text-[16px] text-[#464646] mb-8">Fill in more information about your property.</p>

    <input type="hidden" name="bedrooms" x-model="formData.bedrooms">
    <input type="hidden" name="bathrooms" x-model="formData.bathrooms">

    <div class="flex flex-wrap gap-x-[32px]">
        {{-- Bedrooms --}}
        <div class="w-[348px]">
            <label class="block text-[14px] font-medium text-[#1e1d1d] mb-[12px]">Bedrooms</label>
            <div class="flex justify-between pr-[6px]">
                @foreach(['Studio', '1', '2', '3', '4', '5+'] as $option)
                    <button type="button"
                            @click="formData.bedrooms = '{{ $option }}'"
                            :class="{ 'bg-[#1447d4] text-white border-[#1447d4] shadow-md': formData.bedrooms === '{{ $option }}', 'bg-white text-[#1e1d1d] border-[#e8e8e7]': formData.bedrooms !== '{{ $option }}' }"
                            class="shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] border rounded-full h-10 min-w-[40px] {{ $option === 'Studio' ? 'px-[16px]' : 'px-[10px]' }} flex items-center justify-center text-[16px] font-medium transition-all hover:border-[#1447d4]">
                        {{ $option }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Bathrooms --}}
        <div class="w-[244px]">
            <label class="block text-[14px] font-medium text-[#1e1d1d] mb-[12px]">Bathrooms</label>
            <div class="flex justify-between">
                @foreach([1, 2, 3, 4, '5+'] as $option)
                    @php $val = is_numeric($option) ? $option : 5 @endphp
                    <button type="button"
                            @click="formData.bathrooms = {{ $val }}"
                            :class="{ 'bg-[#1447d4] text-white border-[#1447d4] shadow-md': formData.bathrooms == {{ $val }}, 'bg-white text-[#1e1d1d] border-[#e8e8e7]': formData.bathrooms != {{ $val }} }"
                            class="shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] border rounded-full h-10 w-10 flex items-center justify-center text-[16px] font-medium transition-all hover:border-[#1447d4]">
                        {{ $option }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="flex mt-[34px] space-x-[32px]">
        {{-- Area --}}
        <div class="w-[348px]">
            <label for="area" class="block text-[14px] font-medium text-[#1e1d1d] mb-[6px]">Area</label>
            <div class="relative">
                <input type="number" name="area" id="area" x-model.number="formData.area" min="0"
                       class="h-[51px] leading-[1.3] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] w-full px-[18px] py-[14px] border border-[#e8e8e7] rounded-[6px] focus:ring-2 focus:ring-[#1447d4] focus:border-transparent transition-all outline-none text-[16px]"
                       placeholder="500">
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-[#464646] text-[16px]">
                    sqft
                </div>
            </div>
        </div>

        {{-- Floor number --}}
        <div class="w-[158px]">
            <label for="floor-number" class="block text-[14px] font-medium text-[#1e1d1d] mb-[6px]">Floor number</label>
            <input type="number" name="floor_number" id="floor-number" x-model.number="formData.floor_number" min="0"
                   class="h-[51px] leading-[1.3] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] w-full px-[18px] py-[14px] border border-[#e8e8e7] rounded-[6px] focus:ring-2 focus:ring-[#1447d4] focus:border-transparent transition-all outline-none text-[16px]"
                   placeholder="3">
        </div>

        {{-- Total floors --}}
        <div class="w-[158px]">
            <label for="total-floors" class="block text-[14px] font-medium text-[#1e1d1d] mb-[6px]">Total floors</label>
            <input type="number" name="total_floors" id="total-floors" x-model.number="formData.total_floors" min="0"
                   class="h-[51px] leading-[1.3] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] w-full px-[18px] py-[14px] border border-[#e8e8e7] rounded-[6px] focus:ring-2 focus:ring-[#1447d4] focus:border-transparent transition-all outline-none text-[16px]"
                   placeholder="5">
        </div>
    </div>

    {{-- Construction Year --}}
    <div class="mt-[32px]">
        <label for="construction-year" class="block text-[14px] font-medium text-[#1e1d1d] mb-[8px]">Building construction year (optional)</label>
        <div class="flex items-center gap-[12px]">
            <button type="button" @click="formData.construction_year = Math.max(0, formData.construction_year - 1)"
                    class="w-[51px] h-[51px] bg-[#f9f9f8] rounded-[6px] flex items-center justify-center hover:bg-gray-100 transition-colors">
                <img src="{{ asset('images/minus_black.svg') }}" alt="Decrease" class="w-[51px] h-[51px]">
            </button>

            <div class="flex-1 relative">
                <input type="number" name="construction_year" id="construction-year" x-model.number="formData.construction_year" min="0"
                       class="w-full h-[51px] text-center border border-[#e8e8e7] rounded-[6px] focus:ring-2 focus:ring-[#1447d4] focus:border-transparent transition-all outline-none text-[18px] font-medium"
                       placeholder="2026">
            </div>

            <button type="button" @click="formData.construction_year++"
                    class="w-[51px] h-[51px] bg-[#f9f9f8] rounded-[6px] flex items-center justify-center hover:bg-gray-100 transition-colors">
                <img src="{{ asset('images/plus_black.svg') }}" alt="Increase" class="w-[51px] h-[51px]">
            </button>
        </div>
    </div>
</div>
