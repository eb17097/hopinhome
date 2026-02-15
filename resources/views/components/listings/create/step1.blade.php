<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">What type of listing are you adding?</h3>
    <p class="text-base text-gray-600 mt-2">Choose the property type.</p>

    <input type="hidden" name="property_type" x-model="formData.property_type">

    <div class="space-y-4 mt-8">
        @foreach($propertyTypes as $type)
            <div 
                @click="formData.property_type = '{{ $type }}'"
                :class="{ 'border-electric-blue bg-blue-50': formData.property_type === '{{ $type }}' }"
                class="border border-light-gray rounded-md p-4 flex items-center justify-between hover:bg-gray-50 cursor-pointer transition-colors">
                <div class="flex items-center space-x-4">
                    {{-- Placeholder for icon --}}
                    <div class="w-12 h-12 bg-gray-200 rounded-md"></div>
                    <div>
                        <h4 class="text-base font-medium text-black">{{ $type }}</h4>
                        <p class="text-sm text-gray-600">
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
                <div :class="{ 'border-electric-blue': formData.property_type === '{{ $type }}' }" class="w-6 h-6 rounded-full border border-light-gray flex items-center justify-center">
                    <div :class="{ 'bg-electric-blue': formData.property_type === '{{ $type }}' }" class="w-3 h-3 rounded-full"></div>
                </div>
            </div>
        @endforeach
    </div>
</div>
