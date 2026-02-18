<div>
    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">What type of listing are you adding?</h3>
    <p class="text-[16px] text-[#464646] mb-8">Choose the property type.</p>

    <input type="hidden" name="property_type" x-model="formData.property_type">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @foreach($propertyTypes as $type)
            <div
                @click="formData.property_type = '{{ $type }}'"
                :class="{
                    'border-[#1447d4] shadow-[0px_2px_10px_0px_rgba(0,0,0,0.1)]': formData.property_type === '{{ $type }}',
                    'border-[#e8e8e7]': formData.property_type !== '{{ $type }}'
                }"
                class="border rounded-[6px] p-6 flex items-center justify-between cursor-pointer transition-all bg-white group hover:border-[#1447d4]">
                <div class="flex items-center space-x-4">
                    <div class="w-12 h-12 shrink-0 flex items-center justify-center">
                        @switch($type)
                            @case('Apartment') <img src="{{ asset('images/apartment_big.svg') }}" class="w-full h-full"> @break
                            @case('Villa') <img src="{{ asset('images/house.svg') }}" class="w-full h-full"> @break
                            @case('House') <img src="{{ asset('images/house.svg') }}" class="w-full h-full"> @break
                            @case('Townhouse') <img src="{{ asset('images/house.svg') }}" class="w-full h-full"> @break
                            @case('Hotel apartment') <img src="{{ asset('images/hotel_apartment.svg') }}" class="w-full h-full"> @break
                            @case('Penthouse') <img src="{{ asset('images/penthouse.svg') }}" class="w-full h-full"> @break
                            @default <img src="{{ asset('images/apartment.svg') }}" class="w-full h-full">
                        @endswitch
                    </div>
                    <div>
                        <h4 class="text-[16px] font-medium text-[#1e1d1d]">{{ $type }}</h4>
                        <p class="text-[14px] text-[#464646]">
                            @switch($type)
                                @case('Apartment') Self-contained residential unit @break
                                @case('Villa') Spacious luxury residence @break
                                @case('House') Standalone residential property @break
                                @case('Townhouse') Multi-level attached home @break
                                @case('Hotel apartment') Serviced long-term unit @break
                                @case('Penthouse') Top-floor luxury unit @break
                            @endswitch
                        </p>
                    </div>
                </div>
                <div class="relative w-6 h-6 shrink-0">
                    <div x-show="formData.property_type !== '{{ $type }}'" class="w-6 h-6 rounded-full border border-[#e8e8e7]"></div>
                    <img x-show="formData.property_type === '{{ $type }}'" src="{{ asset('images/white_checkmark_on_blue.svg') }}" class="w-6 h-6" alt="Selected">
                </div>
            </div>
        @endforeach
    </div>
</div>
