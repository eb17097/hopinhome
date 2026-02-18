<div>
    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">More property details</h3>
    <p class="text-[16px] text-[#464646] mb-8">Choose the property type.</p>

    <input type="hidden" name="bedrooms" x-model="formData.bedrooms">
    <input type="hidden" name="bathrooms" x-model="formData.bathrooms">

    <div class="flex flex-wrap gap-x-12 gap-y-8">
        {{-- Bedrooms --}}
        <div class="flex-1 min-w-[300px]">
            <label class="block text-[14px] font-medium text-[#1e1d1d] mb-4">Bedrooms</label>
            <div class="flex flex-wrap gap-2">
                @foreach(['Studio', '1', '2', '3', '4', '5+'] as $option)
                    <button type="button" 
                            @click="formData.bedrooms = '{{ $option }}'" 
                            :class="{ 'bg-[#1447d4] text-white border-[#1447d4] shadow-md': formData.bedrooms === '{{ $option }}', 'bg-white text-[#1e1d1d] border-[#e8e8e7]': formData.bedrooms !== '{{ $option }}' }" 
                            class="border rounded-full h-10 min-w-[40px] px-4 flex items-center justify-center text-[16px] font-medium transition-all hover:border-[#1447d4]">
                        {{ $option }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Bathrooms --}}
        <div class="w-[244px]">
            <label class="block text-[14px] font-medium text-[#1e1d1d] mb-4">Bathrooms</label>
            <div class="flex flex-wrap gap-2">
                @foreach([1, 2, 3, 4, '5+'] as $option)
                    @php $val = is_numeric($option) ? $option : 5 @endphp
                    <button type="button" 
                            @click="formData.bathrooms = {{ $val }}" 
                            :class="{ 'bg-[#1447d4] text-white border-[#1447d4] shadow-md': formData.bathrooms == {{ $val }}, 'bg-white text-[#1e1d1d] border-[#e8e8e7]': formData.bathrooms != {{ $val }} }" 
                            class="border rounded-full h-10 w-10 flex items-center justify-center text-[16px] font-medium transition-all hover:border-[#1447d4]">
                        {{ $option }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-12 gap-x-8 gap-y-8 mt-10">
        {{-- Area --}}
        <div class="md:col-span-6">
            <label for="area" class="block text-[14px] font-medium text-[#1e1d1d] mb-2">Area</label>
            <div class="relative">
                <input type="number" name="area" id="area" x-model.number="formData.area" 
                       class="w-full px-4 py-3 border border-[#e8e8e7] rounded-[6px] focus:ring-2 focus:ring-[#1447d4] focus:border-transparent transition-all outline-none text-[16px]" 
                       placeholder="500">
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-[#464646] text-[16px]">
                    sqft
                </div>
            </div>
        </div>

        {{-- Floor number --}}
        <div class="md:col-span-3">
            <label for="floor-number" class="block text-[14px] font-medium text-[#1e1d1d] mb-2">Floor number</label>
            <input type="number" name="floor_number" id="floor-number" x-model.number="formData.floor_number" 
                   class="w-full px-4 py-3 border border-[#e8e8e7] rounded-[6px] focus:ring-2 focus:ring-[#1447d4] focus:border-transparent transition-all outline-none text-[16px]" 
                   placeholder="3">
        </div>

        {{-- Total floors --}}
        <div class="md:col-span-3">
            <label for="total-floors" class="block text-[14px] font-medium text-[#1e1d1d] mb-2">Total floors</label>
            <input type="number" name="total_floors" id="total-floors" x-model.number="formData.total_floors" 
                   class="w-full px-4 py-3 border border-[#e8e8e7] rounded-[6px] focus:ring-2 focus:ring-[#1447d4] focus:border-transparent transition-all outline-none text-[16px]" 
                   placeholder="5">
        </div>
    </div>

    {{-- Construction Year --}}
    <div class="mt-10">
        <label for="construction-year" class="block text-[14px] font-medium text-[#1e1d1d] mb-4">Building construction year</label>
        <div class="flex items-center gap-4">
            <button type="button" @click="formData.construction_year--" 
                    class="w-[51px] h-[51px] bg-[#f9f9f8] rounded-[6px] flex items-center justify-center border border-[#e8e8e7] hover:bg-gray-100 transition-colors">
                <img src="{{ asset('images/remove.svg') }}" alt="Decrease" class="w-4 h-4 opacity-70">
            </button>
            
            <div class="flex-1 relative">
                <input type="number" name="construction_year" id="construction-year" x-model.number="formData.construction_year" 
                       class="w-full h-[51px] text-center border border-[#e8e8e7] rounded-[6px] focus:ring-2 focus:ring-[#1447d4] focus:border-transparent transition-all outline-none text-[18px] font-medium" 
                       placeholder="2026">
            </div>

            <button type="button" @click="formData.construction_year++" 
                    class="w-[51px] h-[51px] bg-[#f9f9f8] rounded-[6px] flex items-center justify-center border border-[#e8e8e7] hover:bg-gray-100 transition-colors">
                <img src="{{ asset('images/add.svg') }}" alt="Increase" class="w-4 h-4 opacity-70">
            </button>
        </div>
    </div>
</div>