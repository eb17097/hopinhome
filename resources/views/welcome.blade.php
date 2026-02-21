<style>
    select {
        background-image: none !important;
    }
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
            Find trusted rental properties in the UAE
        </h1>

        <p class="text-[18px] font-normal leading-[1.5] text-[#F9F9F8] mb-12 max-w-2xl mx-auto font-['General_Sans_Variable','General_Sans',_sans-serif]">
            HopInHome helps you find <span class="font-medium">trusted</span> rental properties in Dubai <span class="font-medium">with ease.</span>
            Explore listings and start renting with confidence.
        </p>

        <div class="bg-[#FBFBFB]/90 backdrop-blur-[6.05px] p-[20px] rounded-[14px] shadow-sm mx-auto w-full max-w-[792px] text-left border border-white/20">
            <form action="#" method="GET" style="margin-bottom:0;">
                <div class="flex flex-col md:flex-row gap-[16px] mb-[15px]">
                    <div class="relative flex-grow">
                        <div class="absolute inset-y-0 left-0 pl-[18px] flex items-center pointer-events-none">
                            <img src="{{ asset('images/location_on.svg') }}" class="size-[23px]" alt="Location">
                        </div>
                        <input type="text"
                               class="block w-full pl-[50px] pr-[18px] py-[14px] bg-white border border-[#E8E8E7] focus:ring-0 rounded-[6px] text-[#464646] placeholder-[#464646]/60 font-normal text-[18px] leading-[1.3] transition h-[52px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]"
                               placeholder="Enter City or Location">
                    </div>

                    <button class="bg-[#1447D4] text-white font-medium py-[15px] px-[20px] md:min-w-[240px] rounded-[6px] hover:opacity-90 transition flex items-center justify-center gap-[6px] h-[52px] whitespace-nowrap">
                        <img src="{{ asset('images/search.svg') }}" alt="Search Icon" class="size-[18px] brightness-0 invert">
                        <span class="text-[18px] leading-[1.18] tracking-[-0.54px]">Search properties</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-[16px]">
                    @foreach(['Property type', 'Bedrooms', 'Price'] as $label)
                        <div class="relative">
                            <select class="block w-full h-[51px] pl-[18px] pr-[50px] py-[14px] bg-white border border-[#E8E8E7] focus:ring-0 rounded-[6px] text-[#464646] font-normal text-[18px] leading-[1.3] appearance-none cursor-pointer shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]">
                                <option>{{ $label }}</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center px-[18px] pointer-events-none">
                                <img src="{{ asset('images/chevron.svg') }}" class="size-[23px] opacity-60" alt="">
                            </div>
                        </div>
                    @endforeach
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
                    Publish your listing and connect with people who value clarity and honesty.
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
