<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">Where is your property located?</h3>
    <p class="text-base text-gray-600 mt-2">Fill in the details</p>

    <div class="mt-8">
        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <input type="text" name="address" id="address" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Enter full address">
            <div class="absolute inset-y-0 right-0 flex items-center">
                <img src="{{ asset('images/zoom_out.svg') }}" alt="Zoom out" class="h-5 w-5 mr-3">
            </div>
        </div>
    </div>

    <div class="mt-8">
        <img src="{{ asset('images/map.png') }}" alt="Map" class="w-full h-auto rounded-md">
        <div class="flex justify-end space-x-2 mt-2">
            <button class="bg-white p-2 rounded-md shadow-md">
                <img src="{{ asset('images/add_zoom.svg') }}" alt="Add zoom" class="h-5 w-5">
            </button>
            <button class="bg-white p-2 rounded-md shadow-md">
                <img src="{{ asset('images/remove.svg') }}" alt="Remove" class="h-5 w-5">
            </button>
        </div>
    </div>
</div>
