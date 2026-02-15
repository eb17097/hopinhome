@props(['isLanding' => false])

@if ($isLanding)
    {{-- Dynamic Transparent Header for Landing Page (for both guests and logged-in users) --}}
    <nav x-data="{ scrolled: window.scrollY > 50 }"
         @scroll.window="scrolled = window.scrollY > 50"
         :class="{
            'bg-white text-gray-900 border-gray-100 shadow-sm': scrolled,
            'bg-transparent text-white': !scrolled
         }"
         class="fixed top-0 left-0 right-0 z-50 border-b border-transparent transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-22 py-4">
                {{-- Logo with dynamic color --}}
                <div class="flex items-center">
                    <a href="/" class="flex items-center gap-2">
                        <img x-show="scrolled" src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopInHome Logo" class="h-7 w-auto" style="display: none;">
                        <img x-show="!scrolled" src="{{ asset('images/hopinhome_logo_white.svg') }}"
                             onerror="this.onerror=null; this.src='{{ asset('images/hopinhome_logo_blue.svg') }}';"
                             alt="HopInHome Logo" class="h-7 w-auto">
                    </a>
                </div>

                {{-- Navigation Links --}}
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-lg font-medium transition" :class="{'text-gray-900 hover:text-blue-600': scrolled, 'text-white hover:text-gray-200': !scrolled}">Home</a>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-lg font-medium transition" :class="{'text-gray-500 hover:text-blue-600': scrolled, 'text-gray-200 hover:text-white': !scrolled}">
                            <span>Find Properties</span>
                             <img x-show="!scrolled" src="{{ asset('images/keyboard_arrow_down.svg') }}" alt="Dropdown Arrow" class="w-5 h-5 ml-1 transform" :class="{'rotate-180': open}" style="display: none;">
                             <img x-show="scrolled" src="{{ asset('images/keyboard_arrow_down_gray.svg') }}" alt="Dropdown Arrow" class="w-5 h-5 ml-1 transform" :class="{'rotate-180': open}" style="display: none;">
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg" style="display: none;">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">For Sale</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">For Rent</a>
                        </div>
                    </div>
                    <a href="#" class="text-lg font-medium transition" :class="{'text-gray-500 hover:text-blue-600': scrolled, 'text-gray-200 hover:text-white': !scrolled}">Articles & Insights</a>
                    <a href="#" class="text-lg font-medium transition" :class="{'text-gray-500 hover:text-blue-600': scrolled, 'text-gray-200 hover:text-white': !scrolled}">About Us</a>
                    @guest
                    <a href="#" class="text-lg font-medium transition" :class="{'text-gray-500 hover:text-blue-600': scrolled, 'text-white hover:text-gray-200': !scrolled}">Add a listing</a>
                    @endguest
                </div>

                {{-- Right side icons/buttons --}}
                <div class="flex items-center space-x-4">
                    @auth
                        {{-- Authenticated Controls --}}
                        <div class="relative">
                            <img src="{{ asset('images/notifications.svg') }}" alt="Notifications" class="w-6 h-6">
                            <div class="absolute -top-1 -right-1">
                                <img src="{{ asset('images/notification_dot.svg') }}" alt="Notification Dot" class="w-4 h-4">
                                <span class="absolute text-white text-xs font-medium" style="top: 1px; left: 4.5px;">5</span>
                            </div>
                        </div>
                        <a href="{{ route('manager.index') }}" class="w-11 h-11 rounded-full border overflow-hidden" :class="scrolled ? 'border-light-gray' : 'border-white/50'">
                            <img alt="profile picture" class="h-full w-full object-cover" src="{{ asset('images/profile_picture.png') }}">
                        </a>
                        <div class="rounded-full p-2" :class="scrolled ? 'bg-light-gray' : 'bg-white/20'">
                            <img src="{{ asset('images/hamburger.svg') }}" alt="Menu" class="w-6 h-6">
                        </div>
                    @else
                        {{-- Guest Controls --}}
                        <button>
                             <img x-show="!scrolled" src="{{ asset('images/language_white.svg') }}" alt="Language" class="w-6 h-6" style="display: none;">
                            <img x-show="scrolled" src="{{ asset('images/language_black.svg') }}" alt="Language" class="w-6 h-6" style="display: none;">
                        </button>
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-blue-700 transition">
                            Log in or sign up
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
@else
    {{-- Standard Solid Header for All Other Pages --}}
    <nav class="bg-white border-b border-gray-100 sticky top-0 left-0 right-0 z-50 shadow-sm">
         <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-22 py-4">
                 <div class="flex items-center">
                    <a href="/" class="flex items-center gap-2">
                        <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopInHome Logo" class="h-7 w-auto">
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-lg font-medium text-gray-900 hover:text-blue-600 transition">Home</a>
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-lg font-medium text-gray-500 hover:text-blue-600 transition">
                            <span>Find Properties</span>
                            <img src="{{ asset('images/chevron.svg') }}" alt="Dropdown Arrow" class="w-5 h-5 ml-1 transform" :class="{'rotate-180': open}">
                        </button>
                        <div x-show="open" @click.away="open = false" class="absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg" style="display: none;">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">For Sale</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">For Rent</a>
                        </div>
                    </div>
                    <a href="#" class="text-lg font-medium text-gray-500 hover:text-blue-600 transition">Articles & Insights</a>
                    <a href="#" class="text-lg font-medium text-gray-500 hover:text-blue-600 transition">About Us</a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        <div class="relative">
                            <img src="{{ asset('images/notifications.svg') }}" alt="Notifications" class="w-6 h-6">
                            <div class="absolute -top-1 -right-1">
                                <img src="{{ asset('images/notification_dot.svg') }}" alt="Notification Dot" class="w-4 h-4">
                                <span class="absolute text-white text-xs font-medium" style="top: 1px; left: 4.5px;">5</span>
                            </div>
                        </div>
                        <a href="{{ route('manager.index') }}" class="w-11 h-11 rounded-full border border-light-gray overflow-hidden">
                            <img alt="profile picture" class="h-full w-full object-cover" src="{{ asset('images/profile_picture.png') }}">
                        </a>
                        <div class="bg-light-gray rounded-full p-2">
                            <img src="{{ asset('images/hamburger.svg') }}" alt="Menu" class="w-6 h-6">
                        </div>
                    @else
                         <button>
                            <img src="{{ asset('images/language_black.svg') }}" alt="Language" class="w-6 h-6">
                        </button>
                        <a href="{{ route('login') }}" class="bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-blue-700 transition">
                            Log in or sign up
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
@endif
