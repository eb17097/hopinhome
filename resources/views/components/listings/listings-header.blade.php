<div class="flex justify-between items-center mb-6">
    <span class="text-gray-500 text-sm">859 properties</span>
    <div class="flex items-center gap-2">
        <span class="text-sm text-gray-500">Sort by:</span>
        <div class="relative">
            <select class="form-select block w-[170px] h-[45px] py-2.5 px-4 bg-white border border-gray-200 rounded-lg shadow-sm text-sm text-gray-700 outline-none focus:ring-1 focus:ring-blue-500 appearance-none cursor-pointer">
                <option>Most popular</option>
                <option>Price: Low to High</option>
                <option>Newest</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <img src="{{ asset('images/chevron.svg') }}" alt="Dropdown arrow" class="w-5 h-5">
            </div>
        </div>
    </div>
</div>
