<style>
    select {
        background-image: none !important;
    }
    [x-cloak] { display: none !important; }
</style>
<x-main-layout title="Hopinhome">

<x-header :is-landing="true" />

{{-- Hero Section --}}
<div class="relative w-full h-[785px] flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 scale-105"
         style="background-image: url('{{ asset('images/main_hero_image.png') }}');">
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
            location: 'Dubai',
            propertyType: 'Property type',
            bedrooms: 'Bedrooms',
            price: 'Price'
        }" class="bg-[#FBFBFB]/90 backdrop-blur-[6.05px] p-[20px] rounded-[14px] shadow-sm mx-auto w-full max-w-[800px] text-left border border-white/20 relative z-20">
            <form action="#" method="GET" style="margin-bottom:0;" @submit.prevent>
                <div class="flex flex-col gap-[16px]">
                    {{-- Top Row --}}
                    <div class="flex items-center gap-[16px]">
                        {{-- Location Input --}}
                        <div class="relative flex-grow">
                            <div class="bg-white border border-[#E8E8E7] h-[45px] rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] flex items-center px-[12px] gap-[8px] cursor-pointer"
                                 @click="openFilter = openFilter === 'location' ? null : 'location'">
                                <img src="{{ asset('images/location_on.svg') }}" class="size-[23px]" alt="Location">
                                <div class="flex items-center gap-[8px] flex-grow">
                                    <div x-show="location" class="bg-[#F9F9F8] border border-[#E8E8E7] px-[10px] py-[6px] rounded-[4px] flex items-center gap-[8px]">
                                        <span class="text-[16px] text-[#464646]" x-text="location"></span>
                                        <img src="{{ asset('images/close.svg') }}" class="size-[16px]" alt="Remove" @click.stop="location = ''">
                                    </div>
                                    <span x-show="!location" class="text-[16px] text-[#464646] opacity-50">Enter City or Location</span>
                                </div>
                            </div>

                            {{-- Location Dropdown --}}
                            <div x-show="openFilter === 'location'" 
                                 x-transition 
                                 @click.away="openFilter = null"
                                 class="absolute top-full left-0 mt-2 w-full bg-white rounded-[6px] shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] border border-[#E8E8E7] z-30 py-4 overflow-hidden"
                                 x-cloak>
                                <div class="px-4 space-y-4">
                                    <div class="flex items-center gap-3 p-2 hover:bg-[#F9F9F8] rounded-[6px] cursor-pointer" @click="location = 'Dubai, United Arab Emirates'; openFilter = null">
                                        <div class="bg-[#F9F9F8] p-2.5 rounded-[6px]">
                                            <img src="{{ asset('images/language_black.svg') }}" class="size-[24px]" alt="Global">
                                        </div>
                                        <span class="text-[16px] font-medium text-[#1E1D1D]">Dubai, United Arab Emirates</span>
                                    </div>
                                    <div class="flex items-center gap-3 p-2 hover:bg-[#F9F9F8] rounded-[6px] cursor-pointer" @click="location = 'Downtown Dubai'; openFilter = null">
                                        <div class="bg-[#F9F9F8] p-2.5 rounded-[6px]">
                                            <img src="{{ asset('images/apartment.svg') }}" class="size-[24px]" alt="Apartment">
                                        </div>
                                        <div>
                                            <p class="text-[15px] font-medium text-[#1E1D1D]">Downtown Dubai</p>
                                            <p class="text-[14px] text-[#707070]">Dubai</p>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 p-2 hover:bg-[#F9F9F8] rounded-[6px] cursor-pointer" @click="location = 'Burj Khalifa'; openFilter = null">
                                        <div class="bg-[#F9F9F8] p-2.5 rounded-[6px]">
                                            <img src="{{ asset('images/location_on.svg') }}" class="size-[24px]" alt="Location">
                                        </div>
                                        <div>
                                            <p class="text-[15px] font-medium text-[#1E1D1D]">Burj Khalifa</p>
                                            <p class="text-[14px] text-[#707070]">Dubai</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Search Button --}}
                        <button class="bg-[#1447D4] text-[#F9F9F8] px-[32px] h-[45px] rounded-[6px] font-medium text-[16px] tracking-[-0.48px] flex items-center gap-2 hover:opacity-90 transition-all">
                            <img src="{{ asset('images/search.svg') }}" class="size-[18px] brightness-0 invert" alt="Search">
                            Search properties
                        </button>
                    </div>

                    {{-- Bottom Row --}}
                    <div class="flex items-center gap-[16px]">
                        {{-- Property Type --}}
                        <div class="relative flex-1">
                            <div class="bg-white border border-[#E8E8E7] h-[45px] rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] flex items-center justify-between px-[14px] cursor-pointer"
                                 @click="openFilter = openFilter === 'propertyType' ? null : 'propertyType'">
                                <span class="text-[16px] text-[#464646]" x-text="propertyType"></span>
                                <img src="{{ asset('images/chevron.svg') }}" class="size-[23px] transition-transform" :class="openFilter === 'propertyType' ? 'rotate-180' : ''" alt="">
                            </div>

                            {{-- Property Type Dropdown --}}
                            <div x-show="openFilter === 'propertyType'" 
                                 x-transition 
                                 @click.away="openFilter = null"
                                 class="absolute top-full left-0 mt-2 w-[832px] bg-white rounded-[6px] shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] border border-[#E8E8E7] z-30 p-6 flex gap-4"
                                 x-cloak>
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
                                    <div class="flex-1 flex flex-col items-center gap-3 p-4 border border-[#E8E8E7] rounded-[6px] cursor-pointer hover:border-[#1447D4] group"
                                         @click="propertyType = '{{ $type['name'] }}'; openFilter = null">
                                        <div class="size-[48px]">
                                            <img src="{{ asset('images/' . $type['icon']) }}" class="w-full h-full" alt="{{ $type['name'] }}">
                                        </div>
                                        <span class="text-[15px] font-medium text-[#1E1D1D] group-hover:text-[#1447D4] transition-colors">{{ $type['name'] }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Bedrooms --}}
                        <div class="relative flex-1">
                            <div class="bg-white border border-[#E8E8E7] h-[45px] rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] flex items-center justify-between px-[14px] cursor-pointer"
                                 @click="openFilter = openFilter === 'bedrooms' ? null : 'bedrooms'">
                                <span class="text-[16px] text-[#464646]" x-text="bedrooms"></span>
                                <img src="{{ asset('images/chevron.svg') }}" class="size-[23px] transition-transform" :class="openFilter === 'bedrooms' ? 'rotate-180' : ''" alt="">
                            </div>

                            {{-- Bedrooms Dropdown --}}
                            <div x-show="openFilter === 'bedrooms'" 
                                 x-transition 
                                 @click.away="openFilter = null"
                                 class="absolute top-full left-0 mt-2 w-[378px] bg-white rounded-[6px] shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] border border-[#E8E8E7] z-30 p-6"
                                 x-cloak>
                                <h4 class="text-[16px] text-[#1E1D1D] mb-4">Bedrooms</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(['Studio', '1', '2', '3', '4', '5+'] as $val)
                                        <button type="button" 
                                                @click="bedrooms = '{{ $val }} bedrooms'; openFilter = null"
                                                class="px-5 py-2.5 border border-[#E8E8E7] rounded-full text-[16px] font-medium transition-all hover:border-[#1447D4] hover:bg-blue-50"
                                                :class="bedrooms.includes('{{ $val }}') ? 'bg-[#1447D4] text-white border-[#1447D4]' : 'text-[#1E1D1D]'">
                                            {{ $val }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="relative flex-1">
                            <div class="bg-white border border-[#E8E8E7] h-[45px] rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] flex items-center justify-between px-[14px] cursor-pointer"
                                 @click="openFilter = openFilter === 'price' ? null : 'price'">
                                <span class="text-[16px] text-[#464646]" x-text="price"></span>
                                <img src="{{ asset('images/chevron.svg') }}" class="size-[23px] transition-transform" :class="openFilter === 'price' ? 'rotate-180' : ''" alt="">
                            </div>

                            {{-- Price Dropdown --}}
                            <div x-show="openFilter === 'price'" 
                                 x-transition 
                                 @click.away="openFilter = null"
                                 class="absolute top-full left-0 mt-2 w-[390px] bg-white rounded-[6px] shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] border border-[#E8E8E7] z-30 p-6"
                                 x-cloak>
                                <h4 class="text-[16px] text-[#1E1D1D] mb-4">Price</h4>
                                <div class="grid grid-cols-2 gap-4 mb-6">
                                    <div>
                                        <p class="text-[16px] text-[#464646] mb-1">Minimum Price</p>
                                        <div class="border border-[#E8E8E7] p-4 rounded-[6px] flex justify-between">
                                            <input type="text" class="w-full bg-transparent border-none p-0 focus:ring-0 text-[18px] text-[#1E1D1D]" value="100,000">
                                            <span class="text-[18px] text-[#464646] opacity-50">AED</span>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-[16px] text-[#464646] mb-1">Maximum Price</p>
                                        <div class="border border-[#E8E8E7] p-4 rounded-[6px] flex justify-between">
                                            <input type="text" class="w-full bg-transparent border-none p-0 focus:ring-0 text-[18px] text-[#1E1D1D]" placeholder="Any">
                                            <span class="text-[18px] text-[#464646] opacity-50">AED</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative h-1.5 bg-[#D9D9D9] rounded-full">
                                    <div class="absolute inset-y-0 left-[20%] right-[10%] bg-[#1447D4] rounded-full"></div>
                                    <div class="absolute top-1/2 left-[20%] -translate-y-1/2 size-6 bg-white border border-[#1447D4] rounded-full shadow-sm"></div>
                                    <div class="absolute top-1/2 right-[10%] -translate-y-1/2 size-6 bg-white border border-[#1447D4] rounded-full shadow-sm"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
                <a href="#" class="group p-[20px] bg-white border border-[#E8E8E7] rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] hover:shadow-lg transition flex flex-col items-center text-center">
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
