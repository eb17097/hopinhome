@php
    $currentLocation = request()->route('location') ?: request('location', 'Dubai');
    $currentPropertyTypes = request()->route('property_type') ? explode(',', request()->route('property_type')) : request('property_types', []);
    $currentBedrooms = request()->route('bedrooms') ? explode(',', request()->route('bedrooms')) : request('bedrooms', []);
@endphp

<style>
    .form-select {
        background-image: none !important;
    }
    /* Enable dual range slider handles */
    input[type=range] {
        pointer-events: none;
        -webkit-appearance: none;
        appearance: none;
        background: none;
    }
    input[type=range]::-webkit-slider-thumb {
        pointer-events: auto;
        -webkit-appearance: none;
        appearance: none;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        cursor: pointer;
    }
    input[type=range]::-moz-range-thumb {
        pointer-events: auto;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        cursor: pointer;
        border: none;
    }
</style>

<div x-data="{
    openFilter: null,
    location: '{{ $currentLocation }}',
    locationQuery: '',
    locations: [
        { name: 'Dubai, United Arab Emirates', area: '', icon: '{{ asset('images/world_one.svg') }}' },
        { name: 'Downtown Dubai', area: 'Dubai', icon: '{{ asset('images/downtown_loc.svg') }}' },
        { name: 'Burj Khalifa', area: 'Dubai', icon: '{{ asset('images/location_loc.svg') }}' },
        { name: 'Palm Jumeirah', area: 'Dubai', icon: '{{ asset('images/street_loc.svg') }}' },
        { name: 'Abu Dhabi', area: 'United Arab Emirates', icon: '{{ asset('images/location_loc.svg') }}' }
    ],
    get filteredLocations() {
        if (!this.locationQuery) return this.locations.slice(0, 5);
        return this.locations
            .filter(loc => loc.name.toLowerCase().includes(this.locationQuery.toLowerCase()))
            .slice(0, 5);
    },
    get isLocationDropdownOpen() {
        return this.openFilter === 'location' && (this.locationQuery.length > 0 || !this.location);
    },
    selectedPropertyTypes: @js($currentPropertyTypes),
    selectedBedrooms: @js($currentBedrooms),
    minPrice: {{ request('min_price', 0) }},
    maxPrice: {{ request('max_price', 1000000) }},
    minRange: 0,
    maxRange: 1000000,

    slugify(text) {
        if (!text) return 'all';
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    },

    performSearch() {
        let locSlug = this.slugify(this.location);
        let typeSlug = this.selectedPropertyTypes.length > 0 ? this.selectedPropertyTypes.map(t => this.slugify(t)).join(',') : 'all';
        let bedSlug = this.selectedBedrooms.length > 0 ? this.selectedBedrooms.join(',') : 'all';

        let url = `/listings/search/${locSlug}/${typeSlug}/${bedSlug}`;
        
        // Append prices as query params
        let params = new URLSearchParams();
        if (this.minPrice > this.minRange) params.append('min_price', this.minPrice);
        if (this.maxPrice < this.maxRange) params.append('max_price', this.maxPrice);
        
        let queryString = params.toString();
        if (queryString) {
            url += '?' + queryString;
        }

        window.location.href = url;
    },

    get formattedBedrooms() {
        if (this.selectedBedrooms.length === 0) return 'Bedrooms';
        let sorted = [...this.selectedBedrooms].sort((a, b) => {
            if (a === 'Studio') return -1;
            if (b === 'Studio') return 1;
            return parseInt(a) - parseInt(b);
        });
        let studio = sorted.filter(v => v === 'Studio');
        let numbers = sorted.filter(v => v !== 'Studio');
        let result = [];
        if (studio.length > 0) result.push('Studio');
        if (numbers.length > 0) {
            let suffix = (numbers.length === 1 && numbers[0] === '1') ? ' bedroom' : ' bedrooms';
            result.push(numbers.join(', ') + suffix);
        }
        return result.join(', ');
    },
    get formattedPrice() {
        const min = this.minPrice || 0;
        const max = this.maxPrice || this.maxRange;
        if (min === this.minRange && max === this.maxRange) return 'Price';
        if (max === this.maxRange) return `From ${min.toLocaleString()} AED`;
        return `${min.toLocaleString()} - ${max.toLocaleString()} AED`;
    },
    get minPercent() {
        return ((this.minPrice - this.minRange) / (this.maxRange - this.minRange)) * 100;
    },
    get maxPercent() {
        return (((this.maxPrice || this.maxRange) - this.minRange) / (this.maxRange - this.minRange)) * 100;
    },
    togglePropertyType(type) {
        if (this.selectedPropertyTypes.includes(type)) {
            this.selectedPropertyTypes = this.selectedPropertyTypes.filter(t => t !== type);
        } else {
            this.selectedPropertyTypes.push(type);
        }
    },
    toggleBedroom(val) {
        if (this.selectedBedrooms.includes(val)) {
            this.selectedBedrooms = this.selectedBedrooms.filter(b => b !== val);
        } else {
            this.selectedBedrooms.push(val);
        }
    }
}" class="bg-white py-[32px] shadow-sm relative z-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-lg font-medium text-gray-900 mb-[16px]">Search & Filters</div>
        <div class="flex flex-wrap gap-3 items-center">

            <!-- Location Input -->
            <div class="relative w-full md:w-auto min-w-[320px] max-w-[320px]">
                <div
                    class="relative flex items-center bg-white border rounded-lg shadow-sm h-[45px] px-3 py-2 transition-all duration-200"
                    :class="isLocationDropdownOpen ? 'border-gray-200 rounded-b-none shadow-none z-30' : (openFilter === 'location' ? 'border-gray-200 shadow-none' : 'border-gray-200')"
                    @click.stop="$refs.locationInput.focus()"
                >
                    <img src="{{ asset('images/location_on.svg') }}" alt="Location Icon" class="w-5 h-5 text-gray-400 mr-2">
                    <div class="flex items-center space-x-2 flex-grow overflow-hidden">
                        <template x-if="location">
                            <span class="bg-gray-50 border border-gray-200 rounded-md px-2 py-1 text-[16px] text-gray-700 flex items-center shrink-0">
                                <span x-text="location"></span>
                                <img src="{{ asset('images/close.svg') }}" @click.stop="location = ''; locationQuery = ''" alt="Close Icon" class="w-4 h-4 ml-1 cursor-pointer opacity-60 hover:opacity-100">
                            </span>
                        </template>
                        <input
                            x-ref="locationInput"
                            type="text"
                            x-model="locationQuery"
                            @focus="openFilter = 'location'"
                            placeholder="Enter City or Location"
                            class="flex-grow border-none focus:ring-0 text-gray-700 placeholder-gray-500 text-[16px] p-0 bg-transparent"
                        >
                    </div>
                </div>

                <!-- Location Dropdown Panel -->
                <div x-show="isLocationDropdownOpen"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="absolute top-full left-0 w-full bg-white overflow-hidden border border-[#E8E8E7] rounded-b-[10px] z-20 shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)]"
                     @click.stop
                     @click.away="openFilter = null"
                     x-cloak
                >
                    <div class="max-h-[300px] overflow-y-auto">
                        <template x-for="loc in filteredLocations" :key="loc.name">
                            <div class="flex items-center py-2 px-3 gap-3 hover:bg-[#F9F9F8] cursor-pointer transition-colors"
                                 @click="location = loc.name; locationQuery = ''; openFilter = null">
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
                <div
                    @click.stop="openFilter = openFilter === 'propertyType' ? null : 'propertyType'"
                    class="relative block w-[170px] h-[45px] py-[11px] px-4 bg-white border rounded-lg shadow-sm text-sm text-gray-700 cursor-pointer select-none transition-all duration-200"
                    :class="openFilter === 'propertyType' ? 'border-gray-200 border-b-white rounded-b-none z-30' : 'border-gray-200'"
                >
                    <span class="leading-[1.3] text-[16px] truncate pr-4 block" x-text="selectedPropertyTypes.length > 0 ? selectedPropertyTypes.join(', ') : 'Property type'"></span>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <img src="{{ asset('images/chevron.svg') }}" alt="Dropdown Arrow" class="w-4 h-4 text-gray-500 transition-transform" :class="openFilter === 'propertyType' ? 'rotate-180' : ''">
                    </div>
                </div>

                <template x-if="openFilter === 'propertyType'">
                    <div class="absolute top-0 left-0 w-full">
                        <!-- Stem -->
                        <div class="absolute z-30 left-0 bg-white border-l border-r border-[#E8E8E7] w-full" style="top: 44px; height: 12px;">
                            <!-- Fillet -->
                            <div class="absolute bottom-0 -right-[12px] size-[12px] overflow-hidden pointer-events-none">
                                <div class="absolute top-0 left-0 size-full rounded-bl-[12px] border-b border-l border-[#E8E8E7] shadow-[0_0_0_20px_white]"></div>
                            </div>
                        </div>

                        <!-- Dropdown Panel -->
                        <div class="absolute z-10 top-[55px] left-0 bg-white border border-[#E8E8E7] rounded-b-[12px] rounded-tr-[12px] p-4 grid grid-cols-3 gap-3 w-[480px] shadow-lg" @click.away="openFilter = null">
                            @php
                                $types = [
                                    ['name' => 'Apartment', 'icon' => 'apartment_big.svg'],
                                    ['name' => 'Villa', 'icon' => 'villa.svg'],
                                    ['name' => 'House', 'icon' => 'house.svg'],
                                    ['name' => 'Townhouse', 'icon' => 'townhouse.svg'],
                                    ['name' => 'Hotel Apartment', 'icon' => 'hotel_apartment.svg'],
                                    ['name' => 'Penthouse', 'icon' => 'penthouse.svg'],
                                ];
                            @endphp
                            @foreach($types as $type)
                                <div class="flex flex-col items-center justify-center gap-2 p-3 border rounded-[8px] cursor-pointer transition-all relative group h-[100px]"
                                     @click="togglePropertyType('{{ $type['name'] }}')"
                                     :class="selectedPropertyTypes.includes('{{ $type['name'] }}') ? 'border-[#1447D4] bg-blue-50/30' : 'border-gray-100 hover:border-[#1447D4]'">

                                    <div x-show="selectedPropertyTypes.includes('{{ $type['name'] }}')" class="absolute -top-1.5 -right-1.5 size-5 bg-[#1447D4] rounded-full flex items-center justify-center shadow-sm z-10">
                                        <img src="{{ asset('images/check.svg') }}" class="size-2.5 brightness-0 invert" alt="">
                                    </div>

                                    <div class="size-[32px] flex items-center justify-center">
                                        <div class="w-full h-full transition-colors duration-200"
                                             :style="{
                                                'mask-image': 'url({{ asset('images/') }}/' + '{{ $type['icon'] }}' + ')',
                                                '-webkit-mask-image': 'url({{ asset('images/') }}/' + '{{ $type['icon'] }}' + ')',
                                                'mask-size': 'contain',
                                                '-webkit-mask-size': 'contain',
                                                'mask-repeat': 'no-repeat',
                                                '-webkit-mask-repeat': 'no-repeat',
                                                'mask-position': 'center',
                                                '-webkit-mask-position': 'center',
                                                'background-color': selectedPropertyTypes.includes('{{ $type['name'] }}') ? '#1447D4' : '#04247B'
                                             }">
                                        </div>
                                    </div>
                                    <span class="text-[13px] font-medium text-center leading-tight" :class="selectedPropertyTypes.includes('{{ $type['name'] }}') ? 'text-[#1447D4]' : 'text-gray-700'">
                                        {{ $type['name'] }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </template>
            </div>

            <!-- Bedrooms Dropdown -->
            <div class="relative">
                <div
                    @click.stop="openFilter = openFilter === 'bedrooms' ? null : 'bedrooms'"
                    class="relative block w-[170px] h-[45px] py-[11px] px-4 bg-white border rounded-lg shadow-sm text-sm text-gray-700 cursor-pointer select-none transition-all duration-200"
                    :class="openFilter === 'bedrooms' ? 'border-gray-200 border-b-white rounded-b-none z-30' : 'border-gray-200'"
                >
                    <span class="leading-[1.3] text-[16px] truncate pr-4 block" x-text="formattedBedrooms"></span>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <img src="{{ asset('images/chevron.svg') }}" alt="Dropdown Arrow" class="w-4 h-4 text-gray-500 transition-transform" :class="openFilter === 'bedrooms' ? 'rotate-180' : ''">
                    </div>
                </div>

                <template x-if="openFilter === 'bedrooms'">
                    <div class="absolute top-0 left-0 w-full">
                        <!-- Stem -->
                        <div class="absolute z-30 left-0 bg-white border-l border-r border-[#E8E8E7] w-full" style="top: 44px; height: 12px;">
                            <!-- Fillet -->
                            <div class="absolute bottom-0 -right-[12px] size-[12px] overflow-hidden pointer-events-none">
                                <div class="absolute top-0 left-0 size-full rounded-bl-[12px] border-b border-l border-[#E8E8E7] shadow-[0_0_0_20px_white]"></div>
                            </div>
                        </div>

                        <!-- Dropdown Panel -->
                        <div class="absolute z-10 top-[55px] left-0 bg-white border border-[#E8E8E7] rounded-b-[10px] rounded-tr-[10px] p-4 flex items-center gap-3 w-max shadow-lg" @click.away="openFilter = null">
                            @foreach(['Studio', '1', '2', '3', '4', '5+'] as $val)
                                <button type="button"
                                        @click="toggleBedroom('{{ $val }}')"
                                        class="flex items-center justify-center transition-all duration-150 text-sm font-medium focus:outline-none {{ $val === 'Studio' ? 'px-4 py-2' : 'size-[36px]' }} rounded-full"
                                        :class="selectedBedrooms.includes('{{ $val }}') ? 'bg-[#1447D4] text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-700 hover:border-[#1447D4] hover:bg-gray-50'">
                                    {{ $val }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </template>
            </div>

            <!-- Price Dropdown -->
            <div class="relative">
                <div
                    @click.stop="openFilter = openFilter === 'price' ? null : 'price'"
                    class="relative block w-[170px] h-[45px] py-[11px] px-4 bg-white border rounded-lg shadow-sm text-sm text-gray-700 cursor-pointer select-none transition-all duration-200"
                    :class="openFilter === 'price' ? 'border-gray-200 border-b-white rounded-b-none z-30' : 'border-gray-200'"
                >
                    <span class="leading-[1.3] text-[16px] truncate pr-4 block" x-text="formattedPrice"></span>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <img src="{{ asset('images/chevron.svg') }}" alt="Dropdown Arrow" class="w-4 h-4 text-gray-500 transition-transform" :class="openFilter === 'price' ? 'rotate-180' : ''">
                    </div>
                </div>

                <template x-if="openFilter === 'price'">
                    <div class="absolute top-0 left-0 w-full">
                        <!-- Stem -->
                        <div class="absolute z-30 left-0 bg-white border-l border-r border-[#E8E8E7] w-full" style="top: 44px; height: 12px;">
                            <!-- Fillet -->
                            <div class="absolute bottom-0 -right-[12px] size-[12px] overflow-hidden pointer-events-none">
                                <div class="absolute top-0 left-0 size-full rounded-bl-[12px] border-b border-l border-[#E8E8E7] shadow-[0_0_0_20px_white]"></div>
                            </div>
                        </div>

                        <!-- Dropdown Panel -->
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
            <button type="button" class="w-[170px] justify-center relative flex items-center gap-1.5 py-2.5 px-4 bg-[#F9F9F8] border border-gray-200 rounded-lg text-[16px] font-medium text-[#1447D4] hover:bg-gray-100 transition shadow-sm h-[45px]">
                <img src="{{ asset('images/tune.svg') }}" alt="Tune Icon" class="w-[18px] h-[18px]">
                More filters
                <span class="absolute top-[-10px] right-[-10px] bg-[#1447D4] text-white text-[12px] w-6 h-6 flex items-center justify-center rounded-full border-2 border-white">
                    3
                </span>
            </button>

            <!-- Search Button -->
            <button @click="performSearch" class="text-[16px] flex-1 bg-[#1447D4] text-white px-8 py-2.5 rounded-lg justify-center font-medium hover:bg-blue-700 transition shadow-sm flex items-center gap-2 h-[45px]">
                <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="w-4 h-4 brightness-0 invert">
                Search
            </button>
        </div>
    </div>
</div>
