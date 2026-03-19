@php
    $currentLocation = request()->route('location') ?: request('location', '');
    if ($currentLocation === 'all') {
        $currentLocation = '';
    } else {
        $currentLocation = str_replace('-', ' ', $currentLocation);
        $currentLocation = ucwords($currentLocation);
    }

    $currentPropertyTypes = request()->route('property_type') ? explode(',', request()->route('property_type')) : request('property_types', []);
    $currentPropertyTypes = array_filter($currentPropertyTypes, fn($t) => $t !== 'all');

    $currentBedrooms = request()->route('bedrooms') ? explode(',', request()->route('bedrooms')) : request('bedrooms', []);
    $currentBedrooms = array_filter($currentBedrooms, fn($b) => $b !== 'all');
@endphp

<style>
    .form-select { background-image: none !important; }
    input[type=range] { pointer-events: none; -webkit-appearance: none; appearance: none; background: none; }
    input[type=range]::-webkit-slider-thumb { pointer-events: auto; -webkit-appearance: none; appearance: none; width: 24px; height: 24px; border-radius: 50%; cursor: pointer; }
    input[type=range]::-moz-range-thumb { pointer-events: auto; width: 24px; height: 24px; border-radius: 50%; cursor: pointer; border: none; }
</style>

<div x-data="propertySearch({
    initialLocation: '{{ $currentLocation }}',
    selectedPropertyTypes: @js($currentPropertyTypes),
    selectedBedrooms: @js($currentBedrooms),
    minPrice: {{ request('min_price', 0) }},
    maxPrice: {{ request('max_price', 1000000) }},
    icons: {
        world: '{{ asset('images/world_one.svg') }}',
        downtown: '{{ asset('images/downtown_loc.svg') }}',
        location: '{{ asset('images/location_loc.svg') }}',
        street: '{{ asset('images/street_loc.svg') }}'
    }
})" class="bg-white py-[32px] shadow-sm relative z-[30]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-lg font-medium text-gray-900 mb-[16px]">Search & Filters</div>
        <div class="flex flex-wrap gap-3 items-center">

            <!-- Location Input -->
            <div class="relative w-full md:w-auto min-w-[320px] max-w-[320px]">
                <div
                    class="relative flex items-center bg-white border rounded-lg shadow-sm h-[45px] px-3 py-2 transition-all duration-200 gap-2"
                    :class="openFilter === 'location' ? 'border-gray-200 rounded-b-none shadow-none z-30' : 'border-gray-200'"
                    @click.stop="$refs.locationInput.focus()"
                >
                    <img src="{{ asset('images/location_on.svg') }}" alt="Location Icon" class="w-[23px] h-[23px] text-gray-400 shrink-0">
                    <div class="flex items-center gap-2 flex-grow overflow-hidden">
                        <span x-show="location" x-cloak class="bg-gray-50 border border-gray-200 rounded-md px-2 py-1 text-[16px] text-gray-700 flex items-center shrink-0 max-w-[200px]">
                            <span x-text="location" class="truncate leading-[1.2]" :title="location"></span>
                            <img src="{{ asset('images/close.svg') }}" @click.stop="location = ''; locationQuery = ''" alt="Close Icon" class="w-4 h-4 ml-1 cursor-pointer shrink-0">
                        </span>
                        <input
                            x-ref="locationInput"
                            type="text"
                            x-model="locationQuery"
                            @focus="openFilter = 'location'"
                            placeholder="Enter City or Location"
                            class="flex-grow border-none focus:ring-0 text-gray-700 placeholder-[#464646] placeholder-opacity-100 text-[16px] leading-[1.3] p-0 bg-transparent min-w-0 text-[#464646]"
                        >
                    </div>
                </div>

                <!-- Location Dropdown Panel -->
                <div x-show="openFilter === 'location'"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="absolute top-full left-0 w-full bg-white overflow-hidden border border-[#E8E8E7] rounded-b-[10px] z-20 shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)]"
                     @click.stop
                     @click.away="openFilter = null"
                     x-cloak
                >
                    <div class="max-h-[400px] overflow-y-auto py-2">
                        <template x-for="(loc, index) in filteredLocations" :key="index">
                            <div class="flex items-center py-2 px-3 gap-3 hover:bg-[#F9F9F8] cursor-pointer transition-colors"
                                 @click="selectLocation(loc)">
                                <div class="shrink-0">
                                    <img :src="loc.icon" class="size-[36px]" alt="">
                                </div>
                                <div>
                                    <p class="text-[14px] font-medium text-[#1E1D1D]" x-text="loc.name"></p>
                                    <p class="text-[12px] text-[#707070]" x-text="loc.area"></p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>

            <!-- Property Type Dropdown -->
            <div class="relative">
                <div @click.stop="openFilter = openFilter === 'propertyType' ? null : 'propertyType'"
                    class="relative block w-[170px] h-[45px] py-[11px] px-4 bg-white border rounded-lg shadow-sm text-sm text-gray-700 cursor-pointer select-none transition-all duration-200"
                    :class="openFilter === 'propertyType' ? 'border-gray-200 border-b-white rounded-b-none z-30' : 'border-gray-200'">
                    <span class="leading-[1.3] text-[16px] truncate pr-4 block" x-text="displayPropertyTypes"></span>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <img src="{{ asset('images/chevron.svg') }}" alt="Dropdown Arrow" class="w-[23px] h-[23px] text-gray-500 transition-transform" :class="openFilter === 'propertyType' ? 'rotate-180' : ''">
                    </div>
                </div>
                <template x-if="openFilter === 'propertyType'">
                    <div class="absolute top-0 left-0 w-full">
                        <div class="absolute z-30 left-0 bg-white border-l border-r border-[#E8E8E7] w-full" style="top: 44px; height: 12px;">
                            <div class="absolute bottom-0 -right-[12px] size-[12px] overflow-hidden pointer-events-none">
                                <div class="absolute top-0 left-0 size-full rounded-bl-[12px] border-b border-l border-[#E8E8E7] shadow-[0_0_0_20px_white]"></div>
                            </div>
                        </div>
                        <div class="absolute z-10 top-[55px] left-0 bg-white border border-[#E8E8E7] rounded-b-[12px] rounded-tr-[12px] p-4 grid grid-cols-3 gap-3 w-[480px] shadow-lg" @click.away="openFilter = null">
                            @foreach([['name'=>'Apartment','icon'=>'apartment_big.svg'],['name'=>'Villa','icon'=>'villa.svg'],['name'=>'House','icon'=>'house.svg'],['name'=>'Townhouse','icon'=>'townhouse.svg'],['name'=>'Hotel Apartment','icon'=>'hotel_apartment.svg'],['name'=>'Penthouse','icon'=>'penthouse.svg']] as $type)
                                <div class="flex flex-col items-center justify-center gap-2 p-3 border rounded-[8px] cursor-pointer transition-all relative group h-[100px]"
                                     @click="togglePropertyType('{{ $type['name'] }}')"
                                     :class="selectedPropertyTypes.includes(slugify('{{ $type['name'] }}')) ? 'border-[#1447D4] bg-blue-50/30' : 'border-gray-100 hover:border-[#1447D4]'">
                                    <div x-show="selectedPropertyTypes.includes(slugify('{{ $type['name'] }}'))" class="absolute -top-1.5 -right-1.5 size-5 bg-[#1447D4] rounded-full flex items-center justify-center shadow-sm z-10">
                                        <img src="{{ asset('images/check.svg') }}" class="size-2.5 brightness-0 invert" alt="">
                                    </div>
                                    <div class="size-[32px] flex items-center justify-center">
                                        <div class="w-full h-full transition-colors duration-200" :style="{'mask-image': 'url({{ asset('images/') }}/{{ $type['icon'] }})','-webkit-mask-image': 'url({{ asset('images/') }}/{{ $type['icon'] }})','mask-size': 'contain','-webkit-mask-size': 'contain','mask-repeat': 'no-repeat','-webkit-mask-repeat': 'no-repeat','mask-position': 'center','-webkit-mask-position': 'center','background-color': selectedPropertyTypes.includes(slugify('{{ $type['name'] }}')) ? '#1447D4' : '#04247B'}"></div>
                                    </div>
                                    <span class="text-[13px] font-medium text-center leading-tight" :class="selectedPropertyTypes.includes(slugify('{{ $type['name'] }}')) ? 'text-[#1447D4]' : 'text-gray-700'">{{ $type['name'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </template>
            </div>

            <!-- Bedrooms Dropdown -->
            <div class="relative">
                <div @click.stop="openFilter = openFilter === 'bedrooms' ? null : 'bedrooms'"
                    class="relative block w-[170px] h-[45px] py-[11px] px-4 bg-white border rounded-lg shadow-sm text-sm text-gray-700 cursor-pointer select-none transition-all duration-200"
                    :class="openFilter === 'bedrooms' ? 'border-gray-200 border-b-white rounded-b-none z-30' : 'border-gray-200'">
                    <span class="leading-[1.3] text-[16px] truncate pr-4 block" x-text="formattedBedrooms"></span>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <img src="{{ asset('images/chevron.svg') }}" alt="Dropdown Arrow" class="w-[23px] h-[23px] text-gray-500 transition-transform" :class="openFilter === 'bedrooms' ? 'rotate-180' : ''">
                    </div>
                </div>
                <template x-if="openFilter === 'bedrooms'">
                    <div class="absolute top-0 left-0 w-full">
                        <div class="absolute z-30 left-0 bg-white border-l border-r border-[#E8E8E7] w-full" style="top: 44px; height: 12px;">
                            <div class="absolute bottom-0 -right-[12px] size-[12px] overflow-hidden pointer-events-none">
                                <div class="absolute top-0 left-0 size-full rounded-bl-[12px] border-b border-l border-[#E8E8E7] shadow-[0_0_0_20px_white]"></div>
                            </div>
                        </div>
                        <div class="absolute z-10 top-[55px] left-0 bg-white border border-[#E8E8E7] rounded-b-[10px] rounded-tr-[10px] p-4 flex items-center gap-3 w-max shadow-lg" @click.away="openFilter = null">
                            @foreach(['Studio', '1', '2', '3', '4', '5+'] as $val)
                                <button type="button" @click="toggleBedroom('{{ $val }}')" class="flex items-center justify-center transition-all duration-150 text-sm font-medium focus:outline-none {{ $val === 'Studio' ? 'px-4 py-2' : 'size-[36px]' }} rounded-full" :class="selectedBedrooms.includes('{{ $val }}') ? 'bg-[#1447D4] text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-700 hover:border-[#1447D4] hover:bg-gray-50'">{{ $val }}</button>
                            @endforeach
                        </div>
                    </div>
                </template>
            </div>

            <!-- Price Dropdown -->
            <div class="relative">
                <div @click.stop="openFilter = openFilter === 'price' ? null : 'price'"
                    class="relative block w-[170px] h-[45px] py-[11px] px-4 bg-white border rounded-lg shadow-sm text-sm text-gray-700 cursor-pointer select-none transition-all duration-200"
                    :class="openFilter === 'price' ? 'border-gray-200 border-b-white rounded-b-none z-30' : 'border-gray-200'">
                    <span class="leading-[1.3] text-[16px] truncate pr-4 block" x-text="formattedPrice"></span>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <img src="{{ asset('images/chevron.svg') }}" alt="Dropdown Arrow" class="w-[23px] h-[23px] text-gray-500 transition-transform" :class="openFilter === 'price' ? 'rotate-180' : ''">
                    </div>
                </div>
                <template x-if="openFilter === 'price'">
                    <div class="absolute top-0 left-0 w-full">
                        <div class="absolute z-30 left-0 bg-white border-l border-r border-[#E8E8E7] w-full" style="top: 40px; height: 16px;">
                            <div class="absolute bottom-0 -right-[12px] size-[12px] overflow-hidden pointer-events-none">
                                <div class="absolute top-0 left-0 size-full rounded-bl-[12px] border-b border-l border-[#E8E8E7] shadow-[0_0_0_20px_white]"></div>
                            </div>
                        </div>
                        <div class="absolute z-10 top-[55px] left-0 bg-white border border-[#E8E8E7] rounded-b-[10px] rounded-tr-[10px] p-5 w-[380px] shadow-lg" @click.away="openFilter = null">
                            <div class="flex gap-3 mb-6">
                                <div class="flex-1">
                                    <p class="text-[12px] text-gray-700 mb-1.5 font-medium">Min Price</p>
                                    <div class="relative">
                                        <input type="number" x-model.number="minPrice" min="0" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm font-medium text-gray-900 focus:ring-0 focus:border-[#1447D4] [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-[12px]">AED</span>
                                    </div>
                                </div>
                                <div class="flex-1">
                                    <p class="text-[12px] text-gray-700 mb-1.5 font-medium">Max Price</p>
                                    <div class="relative">
                                        <input type="number" x-model.number="maxPrice" min="0" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm font-medium text-gray-900 focus:ring-0 focus:border-[#1447D4] [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" placeholder="Any">
                                        <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 text-[12px]">AED</span>
                                    </div>
                                </div>
                            </div>
                            <div class="relative h-1 bg-gray-100 rounded-full mb-2 mx-2">
                                <div class="absolute h-full bg-[#1447D4] rounded-full" :style="`left: ${minPercent}%; right: ${100 - maxPercent}%`"></div>
                                <input type="range" x-model.number="minPrice" :min="minRange" :max="maxRange" step="1000" class="absolute h-4 -top-1.5 opacity-0 cursor-pointer z-40 w-full" @input="if(minPrice > (maxPrice || maxRange)) minPrice = (maxPrice || maxRange)">
                                <input type="range" x-model.number="maxPrice" :min="minRange" :max="maxRange" step="1000" class="absolute h-4 -top-1.5 opacity-0 cursor-pointer z-40 w-full" @input="if(!maxPrice) maxPrice = maxRange; if(maxPrice < minPrice) maxPrice = minPrice">
                                <div class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 size-4 bg-white border-2 border-[#1447D4] rounded-full pointer-events-none shadow-sm" :style="`left: ${minPercent}%`"></div>
                                <div class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 size-4 bg-white border-2 border-[#1447D4] rounded-full pointer-events-none shadow-sm" :style="`left: ${maxPercent}%`"></div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>

            <!-- More filters Button -->
            <button @click="isModalOpen = true" type="button" class="w-[170px] justify-center relative flex items-center gap-1.5 py-2.5 px-4 bg-[#F9F9F8] border border-gray-200 rounded-lg text-[16px] font-medium text-[#1447D4] hover:bg-gray-100 transition shadow-sm h-[45px]">
                <img src="{{ asset('images/tune.svg') }}" alt="Tune Icon" class="w-[18px] h-[18px]">
                More filters
                <span class="absolute top-[-10px] right-[-10px] bg-[#1447D4] text-white text-[12px] w-6 h-6 flex items-center justify-center rounded-full border-2 border-white">3</span>
            </button>

            <!-- Search Button -->
            <button @click="performSearch" class="text-[16px] flex-1 bg-[#1447D4] text-white px-8 py-2.5 rounded-lg justify-center font-medium hover:bg-blue-700 transition shadow-sm flex items-center gap-2 h-[45px]">
                <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="w-4 h-4 brightness-0 invert">
                Search
            </button>
        </div>
    </div>
    
    <!-- More Filters Modal -->
    <x-listings.filters-modal />
</div>
