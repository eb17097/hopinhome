<style>
    select {
        background-image: none !important;
    }
</style>
<x-main-layout title="Hopinhome">

<x-header :is-landing="true" />

<div class="relative w-full h-[800px] flex items-center justify-center overflow-hidden">

    <div class="absolute inset-0 bg-cover bg-center transition-transform duration-1000 scale-105"
         style="background-image: url('{{ asset('images/main_hero_image.png') }}');">
    </div>



    <div class="relative z-10 w-full max-w-5xl px-4 text-center mt-16">

        <h1 class="text-[64px] font-medium leading-[1.22] tracking-[-0.03em] text-white mb-6 drop-shadow-2xl font-['PP_Formula','General_Sans',_sans-serif]">
            Find trusted <br />
            rental properties
        </h1>

        <p class="text-[18px] font-normal leading-[1.5] tracking-normal text-gray-100 mb-12 max-w-2xl mx-auto drop-shadow-lg font-['General_Sans_Variable','General_Sans',_sans-serif]">
            HopInHome helps you find <span class="font-semibold text-white">trusted</span> rental properties with ease.
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

<div class="bg-white py-20 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.02em] text-gray-900 mb-8 font-['General_Sans',_sans-serif]">
            Popular cities in the UAE
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-20">

            <a href="{{ route('listings.index', ['city' => 'Dubai']) }}" class="group cursor-pointer block">
                <div class="overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1546412414-e1885259563a?q=80&w=800&auto=format&fit=crop"
                         alt="Dubai"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="text-center font-medium text-gray-900 text-lg font-['General_Sans',_sans-serif]">Dubai</h3>
            </a>

            <a href="{{ route('listings.index', ['city' => 'Abu Dhabi']) }}" class="group cursor-pointer block">
                <div class="overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1546412414-e1885259563a?q=80&w=800&auto=format&fit=crop"
                         alt="Abu Dhabi"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="text-center font-medium text-gray-900 text-lg font-['General_Sans',_sans-serif]">Abu Dhabi</h3>
            </a>

            <a href="{{ route('listings.index', ['city' => 'Sharjah']) }}" class="group cursor-pointer block">
                <div class="overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1546412414-e1885259563a?q=80&w=800&auto=format&fit=crop"
                         alt="Sharjah"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="text-center font-medium text-gray-900 text-lg font-['General_Sans',_sans-serif]">Sharjah</h3>
            </a>

            <a href="{{ route('listings.index', ['city' => 'Al Ain']) }}" class="group cursor-pointer block">
                <div class="overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1546412414-e1885259563a?q=80&w=800&auto=format&fit=crop"
                         alt="Al Ain"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
                <h3 class="text-center font-medium text-gray-900 text-lg font-['General_Sans',_sans-serif]">Al Ain</h3>
            </a>

        </div>


        <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.02em] text-gray-900 mb-8 font-['General_Sans',_sans-serif]">
            Browse by property type
        </h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            <a href="#" class="group p-6 border border-gray-100 rounded-2xl bg-white hover:shadow-lg hover:border-transparent transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 mb-4 text-blue-600">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"></path></svg>
                </div>
                <h3 class="font-medium text-gray-900 font-['General_Sans',_sans-serif]">Apartment</h3>
                <p class="text-xs text-gray-500 mt-1 font-['General_Sans',_sans-serif]">800+ listings</p>
            </a>

            <a href="#" class="group p-6 border border-gray-100 rounded-2xl bg-white hover:shadow-lg hover:border-transparent transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 mb-4 text-blue-600">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819"></path></svg>
                </div>
                <h3 class="font-medium text-gray-900 font-['General_Sans',_sans-serif]">Villa</h3>
                <p class="text-xs text-gray-500 mt-1 font-['General_Sans',_sans-serif]">150+ listings</p>
            </a>

            <a href="#" class="group p-6 border border-gray-100 rounded-2xl bg-white hover:shadow-lg hover:border-transparent transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 mb-4 text-blue-600">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"></path></svg>
                </div>
                <h3 class="font-medium text-gray-900 font-['General_Sans',_sans-serif]">House</h3>
                <p class="text-xs text-gray-500 mt-1 font-['General_Sans',_sans-serif]">300+ listings</p>
            </a>

            <a href="#" class="group p-6 border border-gray-100 rounded-2xl bg-white hover:shadow-lg hover:border-transparent transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 mb-4 text-blue-600">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z"></path></svg>
                </div>
                <h3 class="font-medium text-gray-900 font-['General_Sans',_sans-serif]">Townhouse</h3>
                <p class="text-xs text-gray-500 mt-1 font-['General_Sans',_sans-serif]">100+ listings</p>
            </a>

            <a href="#" class="group p-6 border border-gray-100 rounded-2xl bg-white hover:shadow-lg hover:border-transparent transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 mb-4 text-blue-600">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21"></path></svg>
                </div>
                <h3 class="font-medium text-gray-900 font-['General_Sans',_sans-serif]">Hotel Apt</h3>
                <p class="text-xs text-gray-500 mt-1 font-['General_Sans',_sans-serif]">100+ listings</p>
            </a>

            <a href="#" class="group p-6 border border-gray-100 rounded-2xl bg-white hover:shadow-lg hover:border-transparent transition duration-300 flex flex-col items-center text-center">
                <div class="w-12 h-12 mb-4 text-blue-600">
                    <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z"></path></svg>
                </div>
                <h3 class="font-medium text-gray-900 font-['General_Sans',_sans-serif]">Penthouse</h3>
                <p class="text-xs text-gray-500 mt-1 font-['General_Sans',_sans-serif]">50+ listings</p>
            </a>

        </div>
    </div>

    <x-listings.popular-listings :listings="$listings" />


<div class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4">
            <div>
                <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.02em] text-gray-900 font-['General_Sans',_sans-serif]">
                    Inside <span class="text-blue-600">the UAE</span>: Tips, Insights & Living
                </h2>
            </div>

            <a href="#" class="inline-flex items-center justify-center px-6 py-2.5 border border-gray-200 rounded-full text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-300 transition font-['General_Sans',_sans-serif]">
                View more articles
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

            <a href="#" class="group cursor-pointer block">
                <div class="relative overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1516961642265-531546e84af2?q=80&w=800&auto=format&fit=crop"
                         alt="Couple in Dubai"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-md uppercase tracking-wide">
                        Insights
                    </span>
                </div>
                <h3 class="text-lg font-medium text-gray-900 leading-snug group-hover:text-blue-600 transition font-['General_Sans',_sans-serif]">
                    Best rental locations in Dubai for couples
                </h3>
            </a>

            <a href="#" class="group cursor-pointer block">
                <div class="relative overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1516961642265-531546e84af2?q=80&w=800&auto=format&fit=crop"
                         alt="Dubai Street"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-md uppercase tracking-wide">
                        Community guide
                    </span>
                </div>
                <h3 class="text-lg font-medium text-gray-900 leading-snug group-hover:text-blue-600 transition font-['General_Sans',_sans-serif]">
                    What to expect when renting in the UAE for the first time
                </h3>
            </a>

            <a href="#" class="group cursor-pointer block">
                <div class="relative overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1516961642265-531546e84af2?q=80&w=800&auto=format&fit=crop"
                         alt="Bathroom Interior"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-md uppercase tracking-wide">
                        Community guide
                    </span>
                </div>
                <h3 class="text-lg font-medium text-gray-900 leading-snug group-hover:text-blue-600 transition font-['General_Sans',_sans-serif]">
                    Hidden Costs to Look Out For When Renting in the UAE
                </h3>
            </a>

            <a href="#" class="group cursor-pointer block">
                <div class="relative overflow-hidden rounded-xl aspect-[16/10] mb-4">
                    <img src="https://images.unsplash.com/photo-1516961642265-531546e84af2?q=80&w=800&auto=format&fit=crop"
                         alt="UAE Culture"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">

                    <span class="absolute top-3 right-3 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-md uppercase tracking-wide">
                        Insights
                    </span>
                </div>
                <h3 class="text-lg font-medium text-gray-900 leading-snug group-hover:text-blue-600 transition font-['General_Sans',_sans-serif]">
                    UAE Cultural Norms Every New Resident Should Know
                </h3>
            </a>

        </div>
    </div>
</div>

<div class="bg-white py-20 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-20 items-center">

            <div class="relative rounded-3xl overflow-hidden aspect-square shadow-lg">
                <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?q=80&w=1000&auto=format&fit=crop"
                     alt="Cozy Living Room"
                     class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
            </div>

            <div>
                <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.02em] text-gray-900 mb-6 font-['General_Sans',_sans-serif]">
                    About <span class="text-blue-600">HopInHome</span>
                </h2>

                <div class="space-y-6 text-lg text-gray-600 leading-relaxed font-['General_Sans',_sans-serif]">
                    <p>
                        At HopInHome our mission is to make renting <span class="font-semibold text-gray-900">easier and more transparent</span>.
                        We help renters navigate one of the most stressful parts of moving by providing verified listings,
                        straightforward guidance, and trusted insights from the community.
                    </p>

                    <p>
                        Our goal is to <span class="font-semibold text-gray-900">reduce surprises</span>, remove uncertainty, and
                        <span class="font-semibold text-gray-900">help people</span> make confident decisions - without pressure or hidden risks.
                    </p>
                </div>

                <div class="mt-8">
                    <a href="#" class="inline-flex items-center justify-center px-8 py-3 border border-blue-600 rounded-full text-base font-medium text-blue-600 bg-transparent hover:bg-blue-50 transition duration-300 font-['General_Sans',_sans-serif]">
                        Learn more
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="bg-white pb-20 pt-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="relative bg-blue-600 rounded-[32px] px-8 py-16 md:px-16 md:py-20 overflow-hidden shadow-xl">

            <div class="absolute top-0 right-0 w-1/2 h-full opacity-10 pointer-events-none">
                <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full object-cover">
                    <circle cx="400" cy="200" r="200" fill="white"/>
                    <circle cx="400" cy="200" r="150" fill="#2563EB"/>
                </svg>
            </div>

            <div class="relative z-10 max-w-2xl">
                <h2 class="text-[42px] md:text-[56px] font-medium leading-[1.1] text-white mb-6 font-['General_Sans',_sans-serif]">
                    Reach the <br />
                    Right Renters
                </h2>

                <p class="text-blue-100 text-lg md:text-xl mb-10 max-w-md font-['General_Sans',_sans-serif] font-light">
                    Publish your listing and connect with people who value clarity and honesty.
                </p>

                <a href="#" class="inline-flex items-center justify-center px-8 py-3.5 bg-white text-blue-900 text-base font-semibold rounded-full hover:bg-gray-50 transition shadow-lg font-['General_Sans',_sans-serif]">
                    Learn more
                </a>
            </div>

        </div>

    </div>
</div>

<x-footer />

</x-main-layout>
