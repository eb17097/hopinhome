<style>
    select {
        background-image: none !important;
    }
    [x-cloak] { display: none !important; }
    
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
<x-main-layout title="Hopinhome">

<x-header :is-landing="true" />

{{-- Hero Section --}}
<div class="relative w-full h-[785px] flex items-center justify-center">
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 scale-105"
             style="background-image: url('{{ asset('images/main_hero_image.png') }}');">
        </div>
    </div>

    <div class="relative z-10 w-full max-w-5xl px-4 text-center mt-16">
        <h1 class="text-[64px] font-medium leading-[1.22] tracking-[-1.92px] text-[#F9F9F8] mb-6 font-['PP_Formula','General_Sans',_sans-serif]">
            Find trusted rental<br>properties in the UAE
        </h1>

        <p class="text-[18px] font-light leading-[1.5] text-[#F9F9F8] mb-12 max-w-2xl mx-auto font-['General_Sans_Variable','General_Sans',_sans-serif]">
            HopInHome helps you find <span class="font-medium">trusted</span> rental properties in Dubai <span class="font-medium">with ease.</span><br>
            Explore listings and start renting with confidence.
        </p>

        {{-- Filters Section --}}
        <div x-data="{
            openFilter: null,
            location: '',
            selectedPropertyTypes: [],
            selectedBedrooms: [],
            minPrice: 100000,
            maxPrice: 1000000,
            minRange: 0,
            maxRange: 1000000,
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
                if (this.minPrice === this.minRange && !this.maxPrice) return 'Price';
                let min = this.minPrice ? this.minPrice.toLocaleString() : '0';
                let max = this.maxPrice ? this.maxPrice.toLocaleString() : 'Any';

                if (this.maxPrice) {
                    return `${min} - ${max} AED`;
                }
                return `From ${min} AED`;
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
        }" class="bg-[#FBFBFB]/90 backdrop-blur-[6.05px] p-[12px] rounded-[14px] shadow-sm mx-auto w-full max-w-[720px] text-left border border-white/20 relative z-20">
            <form action="#" method="GET" style="margin-bottom:0;" @submit.prevent>
                <div class="flex flex-col gap-[12px]">
                    {{-- Top Row --}}
                    <div class="grid grid-cols-3 gap-[12px] relative" :class="openFilter === 'location' ? 'z-50' : 'z-30'">
                        {{-- Location Input --}}
                        <div class="relative col-span-2">
                            {{-- Trigger Button --}}
                            <div 
                                @click.stop="openFilter = openFilter === 'location' ? null : 'location'"
                                class="relative z-20 w-full h-[48px] bg-white border border-[#E8E8E7] flex items-center px-[16px] gap-[12px] cursor-pointer transition-all duration-200 select-none rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]"
                            >
                                <img src="{{ asset('images/location_on.svg') }}" class="size-[20px] opacity-70" alt="Location">
                                <div class="flex items-center flex-grow overflow-hidden">
                                    <span x-show="location" class="text-[16px] text-[#1E1D1D] truncate font-normal" x-text="location"></span>
                                    <span x-show="!location" class="text-[16px] text-[#707070] truncate font-normal">Enter City or Location</span>
                                </div>
                            </div>

                            {{-- Simple Dropdown Panel --}}
                            <div x-show="openFilter === 'location'"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute top-full left-0 mt-2 w-full bg-white border border-[#E8E8E7] rounded-[10px] py-4 z-30 shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)]"
                                 @click.away="openFilter = null"
                                 x-cloak
                            >
                                <div class="px-4 space-y-2">
                                    <div class="flex items-center gap-3 p-3 hover:bg-[#F9F9F8] rounded-[8px] cursor-pointer transition-colors" @click="location = 'Dubai, UAE'; openFilter = null">
                                        <div class="bg-[#F9F9F8] p-2.5 rounded-[6px]">
                                            <img src="{{ asset('images/language_black.svg') }}" class="size-[20px]" alt="Global">
                                        </div>
                                        <div>
                                            <p class="text-[15px] font-medium text-[#1E1D1D]">Dubai, United Arab Emirates</p>
                                            <p class="text-[13px] text-[#707070]">All areas</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 p-3 hover:bg-[#F9F9F8] rounded-[8px] cursor-pointer transition-colors" @click="location = 'Downtown Dubai'; openFilter = null">
                                        <div class="bg-[#F9F9F8] p-2.5 rounded-[6px]">
                                            <img src="{{ asset('images/apartment.svg') }}" class="size-[20px]" alt="Apartment">
                                        </div>
                                        <div>
                                            <p class="text-[15px] font-medium text-[#1E1D1D]">Downtown Dubai</p>
                                            <p class="text-[13px] text-[#707070]">Dubai</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Search Button --}}
                        <button class="bg-[#1447D4] text-white h-[48px] rounded-[6px] font-medium text-[16px] flex items-center justify-center gap-2 hover:bg-[#0F36A9] transition-all w-full">
                            <img src="{{ asset('images/search.svg') }}" class="size-[18px] brightness-0 invert" alt="Search">
                            <span>Search properties</span>
                        </button>
                    </div>

                    {{-- Bottom Row --}}
                    <div class="grid grid-cols-3 gap-[12px] relative" :class="openFilter && openFilter !== 'location' ? 'z-40' : 'z-20'">
                        {{-- Property Type --}}
                        <div class="relative" :style="openFilter === 'propertyType' ? 'filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.06)) drop-shadow(0 2px 4px rgba(0,0,0,0.02))' : ''">
                            {{-- Trigger Button --}}
                            <div 
                                @click.stop="openFilter = openFilter === 'propertyType' ? null : 'propertyType'"
                                class="relative z-20 w-full h-[48px] bg-white border border-[#E8E8E7] flex items-center justify-between px-[16px] cursor-pointer transition-all duration-200 select-none"
                                :class="openFilter === 'propertyType' ? 'rounded-t-[6px] border-b-white shadow-none' : 'rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]'"
                            >
                                <span class="text-[16px] text-[#1E1D1D] truncate font-normal" x-text="selectedPropertyTypes.length > 0 ? selectedPropertyTypes.join(', ') : 'Property type'"></span>
                                <img src="{{ asset('images/chevron.svg') }}" 
                                     class="size-[16px] opacity-60 transition-transform duration-200" 
                                     :class="openFilter === 'propertyType' ? 'rotate-180' : ''" alt="">
                            </div>

                            <template x-if="openFilter === 'propertyType'">
                                <div class="absolute top-0 left-0 w-full">
                                    {{-- Stem --}}
                                    <div 
                                        class="absolute z-30 left-0 bg-white border-l border-r border-[#E8E8E7] w-full" 
                                        style="top: 45px; height: 16px;"
                                    >
                                        {{-- Flawless Inner Curve Fillet --}}
                                        <div class="absolute bottom-0 -right-[12px] size-[12px] overflow-hidden pointer-events-none">
                                            <div class="absolute top-0 left-0 size-full rounded-bl-[12px] border-b border-l border-[#E8E8E7] shadow-[0_0_0_20px_white]"></div>
                                        </div>
                                    </div>

                                    {{-- Dropdown Panel --}}
                                    <div 
                                        class="absolute z-10 top-[60px] left-0 bg-white border border-[#E8E8E7] rounded-b-[12px] rounded-tr-[12px] p-4 grid grid-cols-6 gap-3 w-[832px]"
                                        @click.away="openFilter = null"
                                    >
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
                                            <div class="flex flex-col items-center justify-center gap-3 p-4 border rounded-[10px] cursor-pointer transition-all relative group h-[120px]"
                                                 @click="togglePropertyType('{{ $type['name'] }}')"
                                                 :class="selectedPropertyTypes.includes('{{ $type['name'] }}') ? 'border-[#1447D4] bg-white' : 'border-[#E8E8E7] hover:border-[#1447D4]'">
                                                
                                                {{-- Selection Badge --}}
                                                <div x-show="selectedPropertyTypes.includes('{{ $type['name'] }}')" 
                                                     class="absolute -top-2 -right-2 size-6 bg-[#1447D4] rounded-full flex items-center justify-center shadow-sm z-10">
                                                    <img src="{{ asset('images/check.svg') }}" class="size-3 brightness-0 invert" alt="">
                                                </div>

                                                <div class="size-[48px] flex items-center justify-center">
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
                                                <span class="text-[14px] font-medium transition-colors text-center leading-tight"
                                                      :class="selectedPropertyTypes.includes('{{ $type['name'] }}') ? 'text-[#1447D4]' : 'text-[#1E1D1D]'">
                                                    {{ $type['name'] }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </template>
                        </div>

                        {{-- Bedrooms --}}
                        <div class="relative" :style="openFilter === 'bedrooms' ? 'filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.06)) drop-shadow(0 2px 4px rgba(0,0,0,0.02))' : ''">
                            {{-- Trigger Button --}}
                            <div
                                @click.stop="openFilter = openFilter === 'bedrooms' ? null : 'bedrooms'"
                                class="relative z-20 w-full h-[48px] bg-white border border-[#E8E8E7] flex items-center justify-between px-[16px] cursor-pointer transition-all duration-200 select-none"
                                :class="openFilter === 'bedrooms' ? 'rounded-t-[6px] border-b-white shadow-none' : 'rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]'"
                            >
                                <span class="text-[16px] text-[#1E1D1D] truncate font-normal" x-text="formattedBedrooms"></span>
                                <img src="{{ asset('images/chevron.svg') }}" 
                                     class="size-[16px] opacity-60 transition-transform duration-200" 
                                     :class="openFilter === 'bedrooms' ? 'rotate-180' : ''" alt="">
                            </div>

                            <template x-if="openFilter === 'bedrooms'">
                                <div class="absolute top-0 left-0 w-full">
                                    {{-- Stem --}}
                                    <div
                                        class="absolute z-30 left-0 bg-white border-l border-r border-[#E8E8E7] w-full"
                                        style="top: 45px; height: 16px;"
                                    >
                                        {{-- Flawless Inner Curve Fillet --}}
                                        <div class="absolute bottom-0 -right-[12px] size-[12px] overflow-hidden pointer-events-none">
                                            <div class="absolute top-0 left-0 size-full rounded-bl-[12px] border-b border-l border-[#E8E8E7] shadow-[0_0_0_20px_white]"></div>
                                        </div>
                                    </div>

                                    {{-- Dropdown Panel --}}
                                    <div
                                        class="absolute z-10 top-[60px] left-0 bg-white border border-[#E8E8E7] rounded-b-[10px] rounded-tr-[10px] p-4 pt-5 flex items-center gap-[12px] w-max"
                                        @click.away="openFilter = null"
                                    >
                                        @foreach(['Studio', '1', '2', '3', '4', '5+'] as $val)
                                            <button type="button"
                                                    @click="toggleBedroom('{{ $val }}')"
                                                    class="flex items-center justify-center transition-all duration-150 text-[16px] font-medium focus:outline-none {{ $val === 'Studio' ? 'px-5 py-[7px]' : 'w-[40px] h-[40px]' }} rounded-full"
                                                    :class="selectedBedrooms.includes('{{ $val }}') ? 'bg-[#1447D4] text-white shadow-sm' : 'bg-white border border-[#E2E2E2] text-[#222222] hover:border-[#222222] hover:bg-gray-50'">
                                                {{ $val }}
                                            </button>
                                        @endforeach
                                    </div>
                                </div>
                            </template>
                        </div>

                        {{-- Price --}}
                        <div class="relative" :style="openFilter === 'price' ? 'filter: drop-shadow(0 4px 12px rgba(0, 0, 0, 0.06)) drop-shadow(0 2px 4px rgba(0,0,0,0.02))' : ''">
                            {{-- Trigger Button --}}
                            <div 
                                @click.stop="openFilter = openFilter === 'price' ? null : 'price'"
                                class="relative z-20 w-full h-[48px] bg-white border border-[#E8E8E7] flex items-center justify-between px-[16px] cursor-pointer transition-all duration-200 select-none"
                                :class="openFilter === 'price' ? 'rounded-t-[6px] border-b-white shadow-none' : 'rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]'"
                            >
                                <span class="text-[16px] text-[#1E1D1D] truncate font-normal" x-text="formattedPrice"></span>
                                <img src="{{ asset('images/chevron.svg') }}" 
                                     class="size-[16px] opacity-60 transition-transform duration-200" 
                                     :class="openFilter === 'price' ? 'rotate-180' : ''" alt="">
                            </div>

                            <template x-if="openFilter === 'price'">
                                <div class="absolute top-0 left-0 w-full">
                                    {{-- Stem --}}
                                    <div class="absolute z-30 left-0 bg-white border-l border-r border-[#E8E8E7] w-full" style="top: 45px; height: 16px;">
                                        {{-- Fillet --}}
                                        <div class="absolute bottom-0 -right-[12px] size-[12px] overflow-hidden pointer-events-none">
                                            <div class="absolute top-0 left-0 size-full rounded-bl-[12px] border-b border-l border-[#E8E8E7] shadow-[0_0_0_20px_white]"></div>
                                        </div>
                                    </div>

                                    {{-- Dropdown Panel --}}
                                    <div class="absolute z-10 top-[60px] left-0 bg-white border border-[#E8E8E7] rounded-b-[10px] rounded-tr-[10px] p-6 w-[440px]" @click.away="openFilter = null">
                                        <div class="flex gap-4 mb-6">
                                            <div class="flex-1">
                                                <p class="text-[14px] text-[#1E1D1D] mb-2 font-medium">Minimum Price</p>
                                                <div class="relative">
                                                    <input type="number" 
                                                           x-model.number="minPrice" 
                                                           @input="if(minPrice > (maxPrice || maxRange)) minPrice = (maxPrice || maxRange)"
                                                           class="w-full border border-[#E8E8E7] rounded-[8px] px-4 py-3 text-[15px] font-medium text-[#1E1D1D] focus:ring-0 focus:border-[#1447D4] [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none">
                                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[#707070] text-[14px]">AED</span>
                                                </div>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-[14px] text-[#1E1D1D] mb-2 font-medium">Maximum Price</p>
                                                <div class="relative">
                                                    <input type="number" 
                                                           x-model.number="maxPrice" 
                                                           @input="if(maxPrice < minPrice) maxPrice = minPrice"
                                                           class="w-full border border-[#E8E8E7] rounded-[8px] px-4 py-3 text-[15px] font-medium text-[#1E1D1D] focus:ring-0 focus:border-[#1447D4] [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none" 
                                                           placeholder="Any">
                                                    <span class="absolute right-4 top-1/2 -translate-y-1/2 text-[#707070] text-[14px]">AED</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        {{-- Real Range Slider --}}
                                        <div class="relative h-1.5 bg-[#E8E8E7] rounded-full mb-2 mx-3">
                                            {{-- Track --}}
                                            <div class="absolute h-full bg-[#1447D4] rounded-full"
                                                 :style="`left: ${minPercent}%; right: ${100 - maxPercent}%`"
                                            ></div>
                                            
                                            {{-- Native range inputs with edge-fix geometry --}}
                                            <input type="range" 
                                                   x-model.number="minPrice" 
                                                   :min="minRange" :max="maxRange" step="1000"
                                                   class="absolute h-6 -top-2 opacity-0 cursor-pointer z-40 pointer-events-auto m-0 p-0"
                                                   style="width: calc(100% + 20px); left: -10px;"
                                                   @input="if(minPrice > (maxPrice || maxRange)) minPrice = (maxPrice || maxRange)">
                                            <input type="range" 
                                                   x-model.number="maxPrice" 
                                                   :min="minRange" :max="maxRange" step="1000"
                                                   class="absolute h-6 -top-2 opacity-0 cursor-pointer z-40 pointer-events-auto m-0 p-0"
                                                   style="width: calc(100% + 20px); left: -10px;"
                                                   @input="if(!maxPrice) maxPrice = maxRange; if(maxPrice < minPrice) maxPrice = minPrice">

                                            {{-- Visual Handles --}}
                                            <div class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 size-5 bg-white border-2 border-[#1447D4] rounded-full pointer-events-none shadow-sm transition-transform"
                                                 :class="minPrice > (maxRange/2) ? 'z-30' : 'z-20'"
                                                 :style="`left: ${minPercent}%`"
                                            ></div>
                                            <div class="absolute top-1/2 -translate-y-1/2 -translate-x-1/2 size-5 bg-white border-2 border-[#1447D4] rounded-full pointer-events-none shadow-sm transition-transform"
                                                 :class="minPrice > (maxRange/2) ? 'z-20' : 'z-30'"
                                                 :style="`left: ${maxPercent}%`"
                                            ></div>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>

{{-- Popular Cities Section --}}
<div class="bg-white py-[80px]">
    <div class="max-w-[1204px] mx-auto px-4 lg:px-0">
        <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.64px] text-[#1E1D1D] mb-8 font-['General_Sans',_sans-serif]">
            Popular cities in the UAE
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-[32px]">
            @php
                $cities = [
                    ['name' => 'Dubai', 'image' => 'https://images.unsplash.com/photo-1546412414-e1885259563a?q=80&w=800&auto=format&fit=crop'],
                    ['name' => 'Abu Dhabi', 'image' => 'https://images.unsplash.com/photo-1583997052301-0042b33fc598?q=80&w=800&auto=format&fit=crop'],
                    ['name' => 'Sharjah', 'image' => 'https://images.unsplash.com/photo-1578895210405-907db486c111?q=80&w=800&auto=format&fit=crop'],
                    ['name' => 'Al Ain', 'image' => 'https://images.unsplash.com/photo-1546412414-e1885259563a?q=80&w=800&auto=format&fit=crop'],
                ];
            @endphp

            @foreach($cities as $city)
                <a href="{{ route('listings.index', ['city' => $city['name']]) }}" class="group block">
                    <div class="overflow-hidden rounded-[6px] aspect-[277/172] mb-3">
                        <img src="{{ $city['image'] }}"
                             alt="{{ $city['name'] }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    </div>
                    <h3 class="text-center font-normal text-[#1E1D1D] text-[18px] leading-[1.5] font-['General_Sans',_sans-serif]">{{ $city['name'] }}</h3>
                </a>
            @endforeach
        </div>
    </div>
</div>

{{-- Property Types Section --}}
<div class="bg-white py-[40px]">
    <div class="max-w-[1204px] mx-auto px-4 lg:px-0">
        <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.64px] text-[#1E1D1D] mb-8 font-['General_Sans',_sans-serif]">
            Browse by property type
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-[32px]">
            @php
                $types = [
                    ['name' => 'Apartment', 'icon' => 'apartment_big.svg', 'count' => '800+ listings'],
                    ['name' => 'Villa', 'icon' => 'villa.svg', 'count' => '150+ listings'],
                    ['name' => 'House', 'icon' => 'house.svg', 'count' => '300+ listings'],
                    ['name' => 'Townhouse', 'icon' => 'townhouse.svg', 'count' => '100+ listings'],
                    ['name' => 'Hotel Apt', 'icon' => 'hotel_apartment.svg', 'count' => '100+ listings'],
                    ['name' => 'Penthouse', 'icon' => 'penthouse.svg', 'count' => '50+ listings'],
                ];
            @endphp

            @foreach($types as $type)
                <a href="#" class="group p-[20px] bg-white border border-[#E8E8E7] rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.06)] hover:shadow-lg transition flex flex-col items-center text-center">
                    <div class="size-[63px] mb-[18px]">
                        <img src="{{ asset('images/' . $type['icon']) }}" class="w-full h-full" alt="{{ $type['name'] }}">
                    </div>
                    <h3 class="font-medium text-[#1E1D1D] text-[18px] leading-[1.28] tracking-[-0.36px] font-['General_Sans',_sans-serif]">{{ $type['name'] }}</h3>
                    <p class="text-[14px] text-[#464646] mt-1 font-['General_Sans',_sans-serif] leading-[1.5]">{{ $type['count'] }}</p>
                </a>
            @endforeach
        </div>
    </div>
</div>

{{-- Popular Homes Section --}}
<x-listings.popular-listings :listings="$listings" />

{{-- Articles Section --}}
<div class="bg-[#F9F9F8] py-[80px]">
    <div class="max-w-[1204px] mx-auto px-4 lg:px-0">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-[40px] gap-4">
            <div>
                <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.64px] text-[#1E1D1D] font-['General_Sans',_sans-serif]">
                    Inside <span class="text-[#1447D4]">the UAE:</span> Tips, Insights & Living
                </h2>
            </div>

            <a href="#" class="inline-flex items-center justify-center px-[32px] py-[16px] border border-[#E8E8E7] rounded-[29.5px] text-[16px] font-medium text-[#1E1D1D] bg-white hover:bg-gray-50 transition tracking-[-0.48px] shadow-sm font-['General_Sans',_sans-serif]">
                View more articles
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-[32px]">
            @php
                $articles = [
                    ['title' => 'Best rental locations in Dubai for couples', 'tag' => 'Insights', 'image' => 'https://images.unsplash.com/photo-1516961642265-531546e84af2?q=80&w=800&auto=format&fit=crop'],
                    ['title' => 'What to expect when renting in the UAE for the first time', 'tag' => 'Community guide', 'image' => 'https://images.unsplash.com/photo-1518684079-3c830dcef090?q=80&w=800&auto=format&fit=crop'],
                    ['title' => 'Hidden Costs to Look Out For When Renting in the UAE', 'tag' => 'Community guide', 'image' => 'https://images.unsplash.com/photo-1516961642265-531546e84af2?q=80&w=800&auto=format&fit=crop'],
                    ['title' => 'UAE Cultural Norms Every New Resident Should Know', 'tag' => 'Insights', 'image' => 'https://images.unsplash.com/photo-1528702748617-c64d49f918af?q=80&w=800&auto=format&fit=crop'],
                ];
            @endphp

            @foreach($articles as $article)
                <a href="#" class="group block">
                    <div class="relative overflow-hidden rounded-[6px] aspect-[277/172] mb-4">
                        <img src="{{ $article['image'] }}"
                             alt="{{ $article['title'] }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                        <span class="absolute top-0 right-0 bg-[#1447D4] text-white text-[12px] font-medium px-[13px] py-[4px] rounded-bl-[6px] rounded-tr-[6px]">
                            {{ $article['tag'] }}
                        </span>
                    </div>
                    <h3 class="text-[18px] font-normal text-[#1E1D1D] leading-[1.3] group-hover:text-[#1447D4] transition font-['General_Sans',_sans-serif]">
                        {{ $article['title'] }}
                    </h3>
                </a>
            @endforeach
        </div>
    </div>
</div>

{{-- About Section --}}
<div class="bg-white py-[80px]">
    <div class="max-w-[1204px] mx-auto px-4 lg:px-0">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-[120px] items-center">
            <div class="relative rounded-[14px] overflow-hidden aspect-square shadow-sm">
                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=1000&auto=format&fit=crop"
                     alt="Cozy Living Room"
                     class="w-full h-full object-cover">
            </div>

            <div>
                <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.64px] text-[#1E1D1D] mb-6 font-['General_Sans',_sans-serif]">
                    About <span class="text-[#1447D4]">HopInHome</span>
                </h2>

                <div class="space-y-6 text-[18px] text-[#464646] leading-[1.5] font-['General_Sans',_sans-serif]">
                    <p>
                        At HopInHome our mission is to make renting <span class="font-medium text-[#1E1D1D]">easier and more transparent</span>.
                        We help renters navigate one of the most stressful parts of moving by providing verified listings,
                        straightforward guidance, and trusted insights from the community.
                    </p>

                    <p>
                        Our goal is to <span class="font-medium text-[#1E1D1D]">reduce surprises</span>, remove uncertainty, and
                        <span class="font-medium text-[#1E1D1D]">help people</span> make confident decisions - without pressure or hidden risks.
                    </p>
                </div>

                <div class="mt-8">
                    <a href="#" class="inline-flex items-center justify-center px-[32px] py-[16px] border border-[#1447D4] rounded-[29.5px] text-[16px] font-medium text-[#1447D4] hover:bg-blue-50 transition duration-300 font-['General_Sans',_sans-serif] tracking-[-0.48px]">
                        Learn more
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- CTA Section --}}
<div class="bg-white pb-[80px]">
    <div class="max-w-[1204px] mx-auto px-4 lg:px-0">
        <div class="relative bg-[#1447D4] rounded-[14px] px-[80px] py-[100px] overflow-hidden">
            {{-- Decorative pattern --}}
            <div class="absolute top-0 right-0 w-1/2 h-full opacity-10 pointer-events-none">
                <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full object-cover scale-150">
                    <circle cx="400" cy="200" r="200" fill="white"/>
                </svg>
            </div>

            <div class="relative z-10 max-w-[500px]">
                <h2 class="text-[64px] font-medium leading-[1.22] text-[#F9F9F8] mb-6 font-['PP_Formula','General_Sans',_sans-serif] tracking-[-1.92px]">
                    Reach the <br /> Right Renters
                </h2>

                <p class="text-[#F9F9F8] text-[18px] leading-[1.5] mb-10 font-['General_Sans',_sans-serif]">
                    Publish your listing and connect with people<br>who value clarity and honesty.
                </p>

                <a href="#" class="inline-flex items-center justify-center px-[32px] py-[16px] bg-white text-[#1E1D1D] text-[16px] font-medium rounded-[29.5px] hover:bg-gray-50 transition shadow-sm font-['General_Sans',_sans-serif] tracking-[-0.48px]">
                    Learn more
                </a>
            </div>
        </div>
    </div>
</div>

<x-footer />

</x-main-layout>