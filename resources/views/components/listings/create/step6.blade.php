<div>
    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">What amenities does the building have?</h3>
    <p class="text-[16px] text-[#464646] mb-8">Select all that apply.</p>

    <div class="mt-8">
        <div class="flex items-center gap-2 mb-6">
            <h4 class="text-[18px] font-medium text-[#1e1d1d]">Building amenities</h4>
            <div class="w-5 h-5 bg-[#1447d4] rounded-full flex items-center justify-center">
                <span class="text-[12px] font-medium text-white" x-text="formData.amenities.length">0</span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-6 gap-x-12">
            @foreach($amenities as $amenity)
                <div class="flex items-center">
                    <input type="checkbox" :id="'amenity_' + {{ $amenity->id }}" :value="{{ $amenity->id }}" x-model="formData.amenities" class="hidden">
                    <div @click="formData.amenities.includes({{ $amenity->id }}) ? formData.amenities = formData.amenities.filter(id => id !== {{ $amenity->id }}) : formData.amenities.push({{ $amenity->id }})" 
                         :class="{
                            'bg-[#1447d4] border-[#1447d4]': formData.amenities.includes({{ $amenity->id }}),
                            'bg-white border-[#e8e8e7]': !formData.amenities.includes({{ $amenity->id }})
                         }"
                         class="w-6 h-6 rounded-[4px] border flex items-center justify-center mr-3 cursor-pointer transition-all hover:border-[#1447d4]">
                        <img src="{{ asset('images/check.svg') }}" alt="Check" class="w-4 h-4 brightness-0 invert" x-show="formData.amenities.includes({{ $amenity->id }})">
                    </div>
                    <label @click="formData.amenities.includes({{ $amenity->id }}) ? formData.amenities = formData.amenities.filter(id => id !== {{ $amenity->id }}) : formData.amenities.push({{ $amenity->id }})" 
                           class="text-[16px] text-[#464646] cursor-pointer hover:text-[#1e1d1d] transition-colors">
                        {{ $amenity->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>