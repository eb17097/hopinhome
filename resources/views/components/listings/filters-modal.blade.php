@props(['allFeatures' => collect(), 'allAmenities' => collect()])
<template x-teleport="body">
    <div
        x-show="isModalOpen"
        x-cloak
        @keydown.escape.window="isModalOpen = false"
        class="fixed inset-0 z-[100] overflow-y-auto"
        aria-labelledby="modal-title"
        role="dialog"
        aria-modal="true"
    >
        <style>
            .range-input {
                -webkit-appearance: none;
                appearance: none;
                width: calc(100% + 36px);
                height: 36px;
                background: transparent;
                pointer-events: none;
                position: absolute;
                left: -18px;
                margin: 0;
                padding: 0;
            }
            .range-input::-webkit-slider-thumb {
                -webkit-appearance: none;
                appearance: none;
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background-color: rgba(0,0,0,0.01);
                pointer-events: auto;
                cursor: grab;
            }
            .range-input::-moz-range-thumb {
                width: 36px;
                height: 36px;
                border-radius: 50%;
                background-color: rgba(0,0,0,0.01);
                pointer-events: auto;
                cursor: grab;
                border: none;
            }
            .range-input:active::-webkit-slider-thumb {
                cursor: grabbing;
            }
        </style>
        <!-- Overlay -->        <div
            x-show="isModalOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="isModalOpen = false"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
        ></div>

        <!-- Modal Panel -->
        <div class="flex min-h-full items-end justify-center text-center sm:items-center">
            <div
                x-show="isModalOpen"
                x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="h-[calc(100vh-144px)] relative transform overflow-hidden rounded-[14px] bg-white text-left shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] transition-all w-[792px]"
            >
                <!-- Header -->
                <div class="h-[65px] px-[24px] py-[20px] border-b border-[#E8E8E7] flex items-center justify-between sticky top-0 bg-white z-10">
                    <button @click="isModalOpen = false" class="text-[#1447D4] hover:text-blue-700 transition-colors">
                        <img src="{{ asset('images/arrow_left_blue.svg') }}" alt="Back" class="w-[25px] h-[25px]">
                    </button>
                    <h3 class="text-[18px] font-medium text-[#1E1D1D] flex items-center gap-2 relative">
                        Search & Filters
                        <span x-show="totalFiltersCount > 0" x-cloak x-text="totalFiltersCount" class="absolute -right-[28px] bg-[#1447D4] text-white text-[14px] w-[20px] h-[20px] font-medium leading-[1] flex items-center justify-center rounded-full"></span>
                    </h3>
                    <button @click="clearAll()" class="text-[16px] text-[#464646] leading-[1.3]">Clear all</button>
                </div>

                <!-- Content -->
                <div class="px-[24px] py-[40px] space-y-[48px] max-h-[calc(100%-170px)] overflow-y-auto">
                    <!-- Location Section -->
                    <section>
                        <h4 class="text-[18px] font-medium text-[#1E1D1D] leading-[1.28] tracking-[-0.36px] mb-[12px]">Location</h4>
                        <div class="relative w-full">
                            <div
                                class="relative flex items-center bg-white border border-gray-200 rounded-lg h-[45px] px-4 py-2 transition-all duration-200 gap-[8px] shadow-[0px_2px_16px_0px_rgba(0,0,0,0.06)]"
                                :class="openFilter === 'locationModal' ? 'border-gray-200 rounded-b-none shadow-none z-30' : 'border-gray-200'"
                                @click.stop="$refs.locationInputModal.focus()"
                            >
                                <img src="{{ asset('images/location_on.svg') }}" alt="Location" class="w-6 h-6 text-gray-400">
                                <div class="flex items-center gap-2 flex-grow overflow-hidden">
                                    <span x-show="location" x-cloak class="leading-[1.2] bg-[#F9F9F8] border border-gray-200 rounded-md px-[10px] py-[6px] text-[16px] text-gray-700 flex items-center shrink-0">
                                        <span x-text="location"></span>
                                        <img src="{{ asset('images/close.svg') }}" @click.stop="location = ''; locationQuery = ''" alt="Remove" class="w-4 h-4 ml-2 cursor-pointer">
                                    </span>
                                    <input
                                        x-ref="locationInputModal"
                                        type="text"
                                        x-model="locationQuery"
                                        @focus="openFilter = 'locationModal'"
                                        placeholder="Enter City or Location"
                                        class="flex-grow border-none focus:ring-0 text-gray-700 placeholder-[#464646] leading-[1.3] text-[16px] p-0 bg-transparent"
                                    >
                                </div>
                            </div>

                            <!-- Location Dropdown Panel -->
                            <div x-show="openFilter === 'locationModal'"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute top-full left-0 w-full bg-white overflow-hidden border border-[#E8E8E7] rounded-b-[10px] z-50 shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)]"
                                 @click.stop
                                 @click.away="openFilter = null"
                                 x-cloak
                            >
                                <div class="max-h-[300px] overflow-y-auto py-2">
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
                    </section>

                    <!-- Property Type Section -->
                    <section>
                        <h4 class="text-[18px] font-medium text-[#1E1D1D] leading-[1.28] tracking-[-0.36px] mb-[12px]">Property type</h4>
                        <div class="flex flex-wrap gap-4">
                            @foreach([
                                ['name' => 'Apartment', 'icon' => 'apartment_big.svg'],
                                ['name' => 'Villa', 'icon' => 'villa.svg'],
                                ['name' => 'House', 'icon' => 'house.svg'],
                                ['name' => 'Townhouse', 'icon' => 'townhouse.svg'],
                                ['name' => 'Hotel apartment', 'icon' => 'hotel_apartment.svg'],
                                ['name' => 'Penthouse', 'icon' => 'penthouse.svg'],
                            ] as $type)
                                <div @click="togglePropertyType('{{ $type['name'] }}')"
                                     class="flex flex-col items-center justify-center gap-[18px] px-[17px] py-[19px] border rounded-[8px] cursor-pointer transition-all relative h-[170px] w-[170px] shadow-[0px_2px_10px_0px_rgba(0,0,0,0.1)]"
                                     :class="selectedPropertyTypes.includes(slugify('{{ $type['name'] }}')) ? 'border-[#1447D4] bg-blue-50/30' : 'border-gray-100 hover:border-[#1447D4]'">
                                    <template x-if="selectedPropertyTypes.includes(slugify('{{ $type['name'] }}'))">
                                        <div class="absolute -top-1.5 -right-1.5 size-6 bg-[#1447D4] rounded-full flex items-center justify-center shadow-sm z-10">
                                            <img src="{{ asset('images/check.svg') }}" class="size-3 brightness-0 invert" alt="">
                                        </div>
                                    </template>
                                    <div class="size-[48px] flex items-center justify-center">
                                        <div class="w-full h-full transition-colors duration-200"
                                             :style="{'mask-image': 'url({{ asset('images/') }}/{{ $type['icon'] }})','-webkit-mask-image': 'url({{ asset('images/') }}/{{ $type['icon'] }})','mask-size': 'contain','-webkit-mask-size': 'contain','mask-repeat': 'no-repeat','-webkit-mask-repeat': 'no-repeat','mask-position': 'center','-webkit-mask-position': 'center','background-color': selectedPropertyTypes.includes(slugify('{{ $type['name'] }}')) ? '#1447D4' : '#04247B'}"></div>
                                    </div>
                                    <span class="leading-[1.3] text-[16px] font-medium text-center" :class="selectedPropertyTypes.includes(slugify('{{ $type['name'] }}')) ? 'text-[#1447D4]' : 'text-[#1E1D1D]'">{{ $type['name'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </section>

                    <!-- Utilities Section -->
                    <section>
                        <h4 class="text-[18px] font-medium text-[#1E1D1D] leading-[1.28] tracking-[-0.36px] mb-[12px]">Utilities</h4>
                        <div class="flex gap-4">
                            @foreach(['Included', 'Excluded'] as $option)
                                <button @click="utilities = '{{ $option }}'"
                                        class="h-[45px] px-6 rounded-full text-[16px] font-medium transition-all shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] border"
                                        :class="utilities === '{{ $option }}' ? 'bg-[#1447D4] text-white border-[#1447D4]' : 'bg-white text-[#1E1D1D] border-gray-100 hover:border-[#1447D4]'">
                                    {{ $option }}
                                </button>
                            @endforeach
                        </div>
                    </section>

                    <!-- Rental Period Section -->
                    <section>
                        <h4 class="text-[18px] font-medium text-[#1E1D1D] leading-[1.28] tracking-[-0.36px] mb-[12px]">Rental period</h4>
                        <div class="flex gap-4">
                            @foreach(['Weekly', 'Monthly', 'Yearly'] as $option)
                                <button @click="rentalPeriod = '{{ $option }}'"
                                        class="h-[45px] px-6 rounded-full text-[16px] font-medium transition-all shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] border"
                                        :class="rentalPeriod === '{{ $option }}' ? 'bg-[#1447D4] text-white border-[#1447D4]' : 'bg-white text-[#1E1D1D] border-gray-100 hover:border-[#1447D4]'">
                                    {{ $option }}
                                </button>
                            @endforeach
                        </div>
                    </section>

                    <!-- Price Section -->
                    <section>
                        <h4 class="text-[18px] font-medium text-[#1E1D1D] leading-[1.28] tracking-[-0.36px] mb-[12px]">Price</h4>
                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div>
                                <p class="text-[16px] text-gray-500 mb-2">Minimum Price</p>
                                <div class="relative flex items-center bg-white border border-gray-200 rounded-lg h-[45px] px-4 shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]">
                                    <input type="number" x-model.number="minPrice" class="w-full border-none focus:ring-0 p-0 text-[16px] font-medium text-[#1E1D1D] [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <span class="text-gray-400 text-[16px] ml-2">AED</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-[16px] text-gray-500 mb-2">Maximum Price</p>
                                <div class="relative flex items-center bg-white border border-gray-200 rounded-lg h-[45px] px-4 shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]">
                                    <input type="number" x-model.number="maxPrice" placeholder="Any" class="w-full border-none focus:ring-0 p-0 text-[16px] font-medium text-[#1E1D1D] [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <span class="text-gray-400 text-[16px] ml-2">AED</span>
                                </div>
                            </div>
                        </div>
                        <div class="relative h-[36px] flex items-center mx-2 mt-4 mb-4"
                             @mousemove="getNearestPriceThumb($event)"
                             @mousedown="getNearestPriceThumb($event)"
                             @touchstart="getNearestPriceThumb($event)">
                            <!-- Visual Track Background -->
                            <div class="absolute w-full h-1.5 bg-gray-200 rounded-full"></div>

                            <!-- Visual Track Active -->
                            <div class="absolute h-1.5 bg-[#1447D4] rounded-full z-[39]" :style="`left: ${minPercent}%; right: ${100 - maxPercent}%`"></div>

                            <!-- Invisible Range Inputs -->
                            <input type="range" x-model.number="minPrice" :min="minRange" :max="maxRange" step="1"
                                class="range-input opacity-0"
                                :class="priceLastMoved === 'min' ? 'z-[41]' : 'z-[40]'"
                                @input="if(minPrice > (maxPrice || maxRange)) minPrice = (maxPrice || maxRange)">

                            <input type="range" x-model.number="maxPrice" :min="minRange" :max="maxRange" step="1"
                                class="range-input opacity-0"
                                :class="priceLastMoved === 'max' ? 'z-[41]' : 'z-[40]'"
                                @input="if(!maxPrice) maxPrice = maxRange; if(maxPrice < minPrice) maxPrice = minPrice">

                            <!-- Visual Thumbs -->
                            <div class="absolute -translate-x-1/2 size-6 bg-white border-2 border-[#1447D4] rounded-full pointer-events-none shadow-sm z-[42]" :style="`left: ${minPercent}%`"></div>
                            <div class="absolute -translate-x-1/2 size-6 bg-white border-2 border-[#1447D4] rounded-full pointer-events-none shadow-sm z-[42]" :style="`left: ${maxPercent}%`"></div>
                        </div>
                    </section>

                    <!-- Bedrooms Section -->
                    <section>
                        <h4 class="text-[18px] font-medium text-[#1E1D1D] leading-[1.28] tracking-[-0.36px] mb-[12px]">Bedrooms</h4>
                        <div class="flex flex-wrap gap-3">
                            @foreach(['Studio', '1', '2', '3', '4', '5+'] as $val)
                                <button @click="toggleBedroom('{{ $val }}')"
                                        class="flex items-center justify-center transition-all duration-150 text-[16px] font-medium focus:outline-none {{ $val === 'Studio' ? 'px-6' : 'size-[45px]' }} rounded-full shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] border"
                                        :class="selectedBedrooms.includes('{{ $val }}') ? 'bg-[#1447D4] text-white border-[#1447D4]' : 'bg-white text-[#1E1D1D] border-gray-100 hover:border-[#1447D4]'">
                                    {{ $val }}
                                </button>
                            @endforeach
                        </div>
                    </section>

                    <!-- Bathrooms Section -->
                    <section>
                        <h4 class="text-[18px] font-medium text-[#1E1D1D] leading-[1.28] tracking-[-0.36px] mb-[12px]">Bathrooms</h4>
                        <div class="flex flex-wrap gap-3">
                            @foreach(['1', '2', '3', '4', '5+'] as $val)
                                <button @click="toggleBathroom('{{ $val }}')"
                                        class="flex items-center justify-center transition-all duration-150 text-[16px] font-medium focus:outline-none size-[45px] rounded-full shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] border"
                                        :class="selectedBathrooms.includes('{{ $val }}') ? 'bg-[#1447D4] text-white border-[#1447D4]' : 'bg-white text-[#1E1D1D] border-gray-100 hover:border-[#1447D4]'">
                                    {{ $val }}
                                </button>
                            @endforeach
                        </div>
                    </section>

                    <!-- Area Section -->
                    <section>
                        <h4 class="text-[18px] font-medium text-[#1E1D1D] leading-[1.28] tracking-[-0.36px] mb-[12px]">Area</h4>
                        <div class="grid grid-cols-2 gap-8 mb-8">
                            <div>
                                <p class="text-[16px] text-gray-500 mb-2">Minimum Area</p>
                                <div class="relative flex items-center bg-white border border-gray-200 rounded-lg h-[45px] px-4 shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]">
                                    <input type="number" x-model.number="minArea" class="w-full border-none focus:ring-0 p-0 text-[16px] font-medium text-[#1E1D1D] [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <span class="text-gray-400 text-[16px] ml-2">sqft</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-[16px] text-gray-500 mb-2">Maximum Area</p>
                                <div class="relative flex items-center bg-white border border-gray-200 rounded-lg h-[45px] px-4 shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]">
                                    <input type="number" x-model.number="maxArea" placeholder="Any" class="w-full border-none focus:ring-0 p-0 text-[16px] font-medium text-[#1E1D1D] [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                    <span class="text-gray-400 text-[16px] ml-2">sqft</span>
                                </div>
                            </div>
                        </div>
                        <div class="relative h-[36px] flex items-center mx-2 mt-4 mb-4"
                             @mousemove="getNearestAreaThumb($event)"
                             @mousedown="getNearestAreaThumb($event)"
                             @touchstart="getNearestAreaThumb($event)">
                            <!-- Visual Track Background -->
                            <div class="absolute w-full h-1.5 bg-gray-200 rounded-full"></div>

                            <!-- Visual Track Active -->
                            <div class="absolute h-1.5 bg-[#1447D4] rounded-full z-[39]" :style="`left: ${minAreaPercent}%; right: ${100 - maxAreaPercent}%`"></div>

                            <!-- Invisible Range Inputs -->
                            <input type="range" x-model.number="minArea" :min="minAreaRange" :max="maxAreaRange" step="1"
                                class="range-input opacity-0"
                                :class="areaLastMoved === 'min' ? 'z-[41]' : 'z-[40]'"
                                @input="if(minArea > (maxArea || maxAreaRange)) minArea = (maxArea || maxAreaRange)">

                            <input type="range" x-model.number="maxArea" :min="minAreaRange" :max="maxAreaRange" step="1"
                                class="range-input opacity-0"
                                :class="areaLastMoved === 'max' ? 'z-[41]' : 'z-[40]'"
                                @input="if(!maxArea) maxArea = maxAreaRange; if(maxArea < minArea) maxArea = minArea">

                            <!-- Visual Thumbs -->
                            <div class="absolute -translate-x-1/2 size-6 bg-white border-2 border-[#1447D4] rounded-full pointer-events-none shadow-sm z-[42]" :style="`left: ${minAreaPercent}%`"></div>
                            <div class="absolute -translate-x-1/2 size-6 bg-white border-2 border-[#1447D4] rounded-full pointer-events-none shadow-sm z-[42]" :style="`left: ${maxAreaPercent}%`"></div>
                        </div>
                    </section>

                    <!-- Floor Section -->
                    <section>
                        <h4 class="text-[18px] font-medium text-[#1E1D1D] leading-[1.28] tracking-[-0.36px] mb-[12px]">Floor</h4>
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <p class="text-[16px] text-gray-500 mb-2">Minimum Floor</p>
                                <div class="flex items-center justify-between bg-white border border-gray-200 rounded-lg h-[45px] px-4 shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]">
                                    <button @click="if(minFloor > 0) minFloor--" class="text-[#1447D4]"><img src="{{ asset('images/gray_minus.svg') }}" class="size-6" alt="-"></button>
                                    <span x-text="minFloor || 'Any'" class="text-[16px] font-medium" :class="minFloor ? 'text-[#1E1D1D]' : 'text-[#464646]'"></span>
                                    <button @click="minFloor++" class="text-[#1447D4]"><img src="{{ asset('images/gray_plus.svg') }}" class="size-6" alt="+"></button>
                                </div>
                            </div>
                            <div>
                                <p class="text-[16px] text-gray-500 mb-2">Maximum Floor</p>
                                <div class="flex items-center justify-between bg-white border border-gray-200 rounded-lg h-[45px] px-4 shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]">
                                    <button @click="if(maxFloor > (minFloor || 0)) maxFloor--" class="text-[#1447D4]"><img src="{{ asset('images/gray_minus.svg') }}" class="size-6" alt="-"></button>
                                    <span x-text="maxFloor || 'Any'" class="text-[16px] font-medium" :class="maxFloor ? 'text-[#1E1D1D]' : 'text-[#464646]'"></span>
                                    <button @click="if(!maxFloor) maxFloor = minFloor + 1; else maxFloor++" class="text-[#1447D4]"><img src="{{ asset('images/gray_plus.svg') }}" class="size-6" alt="+"></button>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Features Section -->
                    <section>
                        <div class="flex items-center gap-2 mb-4">
                            <h4 class="text-[18px] font-medium text-[#1E1D1D] leading-[1.28] tracking-[-0.36px] mb-[12px]">Features</h4>
                            <span x-show="selectedFeatures.length > 0" x-text="selectedFeatures.length" class="bg-[#F9F9F8] border border-gray-200 rounded-full px-2 py-0.5 text-[14px] font-medium text-[#1E1D1D]"></span>
                        </div>
                        <div class="grid grid-cols-3 gap-y-4">
                            @foreach($allFeatures as $feature)
                                @php $fSlug = strtolower(str_replace([' ', '/'], '-', $feature->name)); @endphp
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative size-6 border-2 rounded transition-colors"
                                         :class="selectedFeatures.includes('{{ $fSlug }}') ? 'bg-[#1447D4] border-[#1447D4]' : 'bg-white border-gray-200 group-hover:border-[#1447D4]'">
                                        <template x-if="selectedFeatures.includes('{{ $fSlug }}')">
                                            <img src="{{ asset('images/check.svg') }}" class="absolute inset-0 m-auto size-3.5 brightness-0 invert" alt="">
                                        </template>
                                        <input type="checkbox" @change="toggleFeature('{{ $fSlug }}')" :checked="selectedFeatures.includes('{{ $fSlug }}')" class="sr-only">
                                    </div>
                                    <span class="text-[14px] font-medium" :class="selectedFeatures.includes('{{ $fSlug }}') ? 'text-[#1E1D1D]' : 'text-gray-500'">{{ $feature->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>

                    <!-- Building Amenities Section -->
                    <section>
                        <div class="flex items-center gap-2 mb-4">
                            <h4 class="text-[18px] font-medium text-[#1E1D1D] leading-[1.28] tracking-[-0.36px] mb-[12px]">Building amenities</h4>
                            <span x-show="selectedAmenities.length > 0" x-text="selectedAmenities.length" class="bg-[#F9F9F8] border border-gray-200 rounded-full px-2 py-0.5 text-[14px] font-medium text-[#1E1D1D]"></span>
                        </div>
                        <div class="grid grid-cols-3 gap-y-4">
                            @foreach($allAmenities as $amenity)
                                @php $aSlug = strtolower(str_replace([' ', '/'], '-', $amenity->name)); @endphp
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <div class="relative size-6 border-2 rounded transition-colors"
                                         :class="selectedAmenities.includes('{{ $aSlug }}') ? 'bg-[#1447D4] border-[#1447D4]' : 'bg-white border-gray-200 group-hover:border-[#1447D4]'">
                                        <template x-if="selectedAmenities.includes('{{ $aSlug }}')">
                                            <img src="{{ asset('images/check.svg') }}" class="absolute inset-0 m-auto size-3.5 brightness-0 invert" alt="">
                                        </template>
                                        <input type="checkbox" @change="toggleAmenity('{{ $aSlug }}')" :checked="selectedAmenities.includes('{{ $aSlug }}')" class="sr-only">
                                    </div>
                                    <span class="text-[14px] font-medium" :class="selectedAmenities.includes('{{ $aSlug }}') ? 'text-[#1E1D1D]' : 'text-gray-500'">{{ $amenity->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </section>
                </div>

                <!-- Footer -->
                <div class="p-[24px] border-t border-gray-100 flex justify-center sticky bottom-0 bg-white z-[99]">
                    <button @click="performSearch" class="h-[57px] w-full bg-[#1447D4] text-white rounded-[50px] flex items-center justify-center gap-[6px] text-[18px] leading-[1.18] tracking-[-0.54px] font-medium hover:bg-blue-700 transition-colors">
                        <img src="{{ asset('images/search.svg') }}" alt="Search" class="w-[18px] h-[18px]">
                        Show properties
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
