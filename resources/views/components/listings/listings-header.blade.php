<div class="flex justify-between items-center mb-[24px]">
    <span class="text-gray-600 text-sm">859 properties</span>
    <div class="flex items-center gap-2">
        <span class="text-[14px] text-gray-600">Sort by:</span>
        <div class="relative">
            <select class="leading-[1.3] form-select block w-[150px] h-[39px] py-[9px] px-4 bg-white border border-gray-200 rounded-[4px] shadow-sm text-[16px] text-gray-700 outline-none focus:ring-1 focus:ring-blue-500 appearance-none cursor-pointer">
                <option>Most popular</option>
                <option>Price: Low to High</option>
                <option>Newest</option>
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <img src="{{ asset('images/chevron.svg') }}" alt="Dropdown arrow" class="w-[19px] w-[19px] relative top-[1px]">
            </div>
        </div>
    </div>
</div>
