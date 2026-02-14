<nav x-data="{ scrolled: false }"
     @scroll.window="scrolled = window.scrollY > 50"
     :class="{
        'bg-white text-gray-900 border-b border-gray-100 shadow-sm': scrolled,
        'bg-transparent text-white': !scrolled
     }"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-22 py-4">
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <img x-show="scrolled" src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopInHome Logo" class="h-7 w-auto" style="display: none;">
                    <img x-show="!scrolled" src="{{ asset('images/hopinhome_logo_white.svg') }}" 
                         onerror="this.onerror=null; this.src='{{ asset('images/hopinhome_logo_blue.svg') }}';"
                         alt="HopInHome Logo" class="h-7 w-auto">
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-lg font-medium transition" :class="{'text-gray-900 hover:text-blue-600': scrolled, 'text-white hover:text-gray-200': !scrolled}">Home</a>

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center text-lg font-medium transition" :class="{'text-gray-500 hover:text-blue-600': scrolled, 'text-gray-200 hover:text-white': !scrolled}">
                        <span>Find Properties</span>
                        <svg class="w-5 h-5 ml-1 transition-transform" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg" style="display: none;">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">For Sale</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">For Rent</a>
                    </div>
                </div>
                
                <a href="#" class="text-lg font-medium transition" :class="{'text-gray-500 hover:text-blue-600': scrolled, 'text-gray-200 hover:text-white': !scrolled}">Articles & Insights</a>
                <a href="#" class="text-lg font-medium transition" :class="{'text-gray-500 hover:text-blue-600': scrolled, 'text-gray-200 hover:text-white': !scrolled}">About Us</a>
            </div>

            <div class="flex items-center space-x-4">
                <button>
                     <svg class="w-6 h-6 transition-colors" :class="{'text-gray-800': scrolled, 'text-white': !scrolled}" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9V3m-9 9h18"></path></svg>
                </button>
                <a href="#" class="bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-blue-700 transition">
                    Log in or sign up
                </a>
            </div>
        </div>
    </div>
</nav>
