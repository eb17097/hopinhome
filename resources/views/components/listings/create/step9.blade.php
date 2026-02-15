<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">How much will the property cost to rent?</h3>
    <p class="text-base text-gray-600 mt-2">Fill in the information</p>

    <div class="mt-8">
        <label class="block text-sm font-medium text-gray-700">Payment option</label>
        <div class="flex space-x-2 mt-2">
            @foreach(['Yearly', 'Monthly', 'Weekly'] as $option)
                <button type="button" @click="formData.payment_option = '{{ $option }}'" :class="{ 'bg-electric-blue text-white border-electric-blue': formData.payment_option === '{{ $option }}' }" class="bg-white border border-light-gray rounded-full px-4 py-2 text-sm font-medium text-black shadow-sm transition-colors">
                    {{ $option }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="mt-8">
        <label class="block text-sm font-medium text-gray-700">Utilities</label>
        <div class="flex space-x-2 mt-2">
            @foreach(['Included', 'Excluded'] as $option)
                <button type="button" @click="formData.utilities_option = '{{ $option }}'" :class="{ 'bg-electric-blue text-white border-electric-blue': formData.utilities_option === '{{ $option }}' }" class="bg-white border border-light-gray rounded-full px-4 py-2 text-sm font-medium text-black shadow-sm transition-colors">
                    {{ $option }}
                </button>
            @endforeach
        </div>
    </div>

    <div class="mt-8">
        <label for="price" class="block text-sm font-medium text-gray-700">Price per year</label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <input type="number" name="price" id="price" x-model.number="formData.price" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-4 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="Price">
            <div class="absolute inset-y-0 right-0 flex items-center">
                <span class="text-gray-500 sm:text-sm mr-4">AED</span>
            </div>
        </div>
    </div>
</div>
