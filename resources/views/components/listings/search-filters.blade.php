<style>
    .form-select {
        background-image: none !important;
    }
</style>
<div class="bg-white py-4 pb-6 shadow-sm relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-lg font-medium text-gray-900 mb-4">Search & Filters</div>
        <div class="flex flex-wrap gap-3 items-center">
            <!-- Location Input -->
            <div class="relative flex items-center bg-white border border-gray-200 rounded-lg shadow-sm w-full md:w-auto min-w-[250px] h-[45px] px-3 py-2">
                <img src="{{ asset('images/location_on.svg') }}" alt="Location Icon" class="w-5 h-5 text-gray-400 mr-2">
                <div class="flex items-center space-x-2">
                    <span class="bg-gray-50 border border-gray-200 rounded-md px-2 py-1 text-sm text-gray-700 flex items-center">
                        Dubai
                        <img src="{{ asset('images/close.svg') }}" alt="Close Icon" class="w-4 h-4 ml-1 cursor-pointer">
                    </span>
                    <input type="text" placeholder="Enter City or Location" class="flex-grow border-none focus:ring-0 text-gray-700 placeholder-gray-500 text-sm p-0">
                </div>
            </div>

            <!-- Property Type Dropdown -->
            <div class="relative">
                <select class="form-select block w-[170px] h-[45px] py-2.5 px-4 bg-white border border-gray-200 rounded-lg shadow-sm text-sm text-gray-700 outline-none focus:ring-1 focus:ring-blue-500 appearance-none cursor-pointer">
                    <option>Property type</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <img src="{{ asset('images/chevron.svg') }}" alt="Dropdown Arrow" class="w-5 h-5 text-gray-500">
                </div>
            </div>

            <!-- Bedrooms Dropdown -->
            <div class="relative">
                <select class="form-select block w-[170px] h-[45px] py-2.5 px-4 bg-white border border-gray-200 rounded-lg shadow-sm text-sm text-gray-700 outline-none focus:ring-1 focus:ring-blue-500 appearance-none cursor-pointer">
                    <option>Bedrooms</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <img src="{{ asset('images/chevron.svg') }}" alt="Dropdown Arrow" class="w-5 h-5 text-gray-500">
                </div>
            </div>

            <!-- Price Dropdown -->
            <div class="relative">
                <select class="form-select block w-[170px] h-[45px] py-2.5 px-4 bg-white border border-gray-200 rounded-lg shadow-sm text-sm text-gray-700 outline-none focus:ring-1 focus:ring-blue-500 appearance-none cursor-pointer">
                    <option>Price</option>
                </select>
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                    <img src="{{ asset('images/chevron.svg') }}" alt="Dropdown Arrow" class="w-5 h-5 text-gray-500">
                </div>
            </div>

            <!-- More filters Button -->
            <button class="w-[170px] justify-center relative flex items-center gap-1.5 py-2.5 px-4 bg-off-white-blue border border-gray-200 rounded-lg text-base font-medium text-electric-blue hover:bg-gray-200 transition shadow-sm h-[45px]">
                <img src="{{ asset('images/tune.svg') }}" alt="Tune Icon" class="w-[18px] h-[18px]">
                More filters
                <span class="absolute top-[-10px] right-[-10px] bg-electric-blue text-white text-base w-6 h-6 flex items-center justify-center rounded-full">
                    3
                </span>
            </button>

            <!-- Search Button -->
            <button class="flex-1 bg-electric-blue text-white px-8 py-2.5 rounded-lg justify-center font-medium hover:bg-blue-700 transition shadow-sm flex items-center gap-2 h-[45px]">
                <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="w-4 h-4">
                Search
            </button>
        </div>
    </div>
</div>
