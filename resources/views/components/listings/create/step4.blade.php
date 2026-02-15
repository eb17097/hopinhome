<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">More property details</h3>
    <p class="text-base text-gray-600 mt-2">Fill in more information about your property.</p>

    <input type="hidden" name="bedrooms" x-model="formData.bedrooms">
    <input type="hidden" name="bathrooms" x-model="formData.bathrooms">

    <div class="mt-8">
        <label class="block text-sm font-medium text-gray-700">Bedrooms</label>
        <div class="flex space-x-2 mt-2">
            @foreach(['Studio', '1', '2', '3', '4', '5+'] as $option)
                <button type="button" @click="formData.bedrooms = '{{ $option }}'" :class="{ 'bg-electric-blue text-white border-electric-blue': formData.bedrooms === '{{ $option }}' }" class="bg-white border border-light-gray rounded-full px-4 py-2 text-sm font-medium text-black shadow-sm transition-colors">
                    {{ $option }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="mt-8">
        <label class="block text-sm font-medium text-gray-700">Bathrooms</label>
        <div class="flex space-x-2 mt-2">
            @foreach([1, 2, 3, 4, '5+'] as $option)
                <button type="button" @click="formData.bathrooms = {{ is_numeric($option) ? $option : 5 }}" :class="{ 'bg-electric-blue text-white border-electric-blue': formData.bathrooms == {{ is_numeric($option) ? $option : 5 }} }" class="bg-white border border-light-gray rounded-full px-4 py-2 text-sm font-medium text-black shadow-sm transition-colors">
                    {{ $option }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="mt-8">
        <label for="area" class="block text-sm font-medium text-gray-700">Area</label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <input type="number" name="area" id="area" x-model.number="formData.area" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Total area">
            <div class="absolute inset-y-0 right-0 flex items-center">
                <span class="text-gray-500 sm:text-sm mr-4">sqft</span>
            </div>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-2 gap-4">
        <div>
            <label for="floor-number" class="block text-sm font-medium text-gray-700">Floor number</label>
            <input type="number" name="floor_number" id="floor-number" x-model.number="formData.floor_number" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="#">
        </div>
        <div>
            <label for="total-floors" class="block text-sm font-medium text-gray-700">Total floors in building</label>
            <input type="number" name="total_floors" id="total-floors" x-model.number="formData.total_floors" class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="#">
        </div>
    </div>

    <div class="mt-8">
        <label for="construction-year" class="block text-sm font-medium text-gray-700">Building construction year</label>
        <div class="mt-1 flex items-center">
            <button type="button" @click="formData.construction_year--" class="bg-off-white p-3 rounded-md shadow-sm">
                <img src="{{ asset('images/remove.svg') }}" alt="Remove" class="h-5 w-5">
            </button>
            <input type="number" name="construction_year" id="construction-year" x-model.number="formData.construction_year" class="mx-2 text-center shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="2026">
            <button type="button" @click="formData.construction_year++" class="bg-off-white p-3 rounded-md shadow-sm">
                <img src="{{ asset('images/add_zoom.svg') }}" alt="Add" class="h-5 w-5">
            </button>
        </div>
    </div>
</div>
