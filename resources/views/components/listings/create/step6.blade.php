<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">What amenities does the building have?</h3>
    <p class="text-base text-gray-600 mt-2">Select all that apply</p>

    <div class="mt-8">
        <h4 class="text-lg font-medium text-black">Building amenities</h4>
        <div class="grid grid-cols-2 gap-4 mt-4">
            @foreach($amenities as $amenity)
                <div class="flex items-center">
                    <input type="checkbox" :id="'amenity_' + {{ $amenity->id }}" :value="{{ $amenity->id }}" x-model="formData.amenities" class="hidden">
                    <div @click="formData.amenities.includes({{ $amenity->id }}) ? formData.amenities = formData.amenities.filter(id => id !== {{ $amenity->id }}) : formData.amenities.push({{ $amenity->id }})"
                         :class="{'bg-electric-blue border-electric-blue': formData.amenities.includes({{ $amenity->id }})}"
                         class="w-6 h-6 rounded-md border border-light-gray flex items-center justify-center mr-3 cursor-pointer transition-colors">
                        <img src="{{ asset('images/check.svg') }}" alt="Check" class="h-4 w-4" x-show="formData.amenities.includes({{ $amenity->id }})">
                    </div>
                    <label :for="'amenity_' + {{ $amenity->id }}" class="text-sm font-medium text-gray-700 cursor-pointer">{{ $amenity->name }}</label>
                </div>
            @endforeach
        </div>
    </div>
</div>
