@props(['isLanding' => false])

@php use Illuminate\Support\Facades\Auth; @endphp

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
                    <a href="{{ route('listings.index') }}" class="text-lg font-medium transition" :class="{'text-gray-500 hover:text-blue-600': scrolled, 'text-gray-200 hover:text-white': !scrolled}">Find Properties</a>
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
                            <div class="absolute -top-1 -right-1 flex items-center justify-center w-5 h-5 rounded-full text-white text-xs font-normal" :class="scrolled ? 'bg-electric-blue' : 'bg-blue-600'">
                                <span>5</span>
                            </div>
                        </div>
                        <a href="{{ Auth::user()->isPropertyManager() ? route('property_manager.index') : route('renter.index') }}" class="w-11 h-11 rounded-full border overflow-hidden" :class="scrolled ? 'border-light-gray' : 'border-white/50'">
                            <img alt="profile picture" class="h-full w-full object-cover" src="{{ Auth::user()->profile_photo_url ?? asset('images/user-placeholder.svg') }}">
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
                        <button @click.prevent="$dispatch('open-auth-modal')" class="bg-[#1447D4] text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-blue-700 transition">
                            Log in or sign up
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <x-auth-modal />
@else
    {{-- Standard Solid Header for All Other Pages --}}
    <nav x-data class="bg-white border-b border-[#e8e8e7] sticky top-0 left-0 right-0 z-50 h-[88px] flex items-center">
         <div class="max-w-7xl mx-auto px-8 w-full">
            <div class="flex justify-between items-center h-full">
                 <div class="flex items-center">
                    <a href="/" class="flex items-center gap-2">
                        <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopInHome Logo" class="h-7 w-auto">
                    </a>
                </div>

                {{-- Main Navigation --}}
                <div class="hidden md:flex items-center space-x-12">
                    <a href="/" class="text-[16px] font-medium text-[#1e1d1d] hover:text-blue-600 transition-colors">Home</a>
                    <a href="{{ route('listings.index') }}" class="text-[16px] font-medium text-[#1e1d1d] hover:text-blue-600 transition-colors">Find Properties</a>
                    <a href="#" class="text-[16px] font-medium text-[#1e1d1d] hover:text-blue-600 transition-colors">Articles & Insights</a>
                    <a href="#" class="text-[16px] font-medium text-[#1e1d1d] hover:text-blue-600 transition-colors">About Us</a>
                </div>

                <div class="flex items-center space-x-6">
                    @auth
                        <div class="relative cursor-pointer">
                            <img src="{{ asset('images/notifications.svg') }}" alt="Notifications" class="w-6 h-6 opacity-80">
                            <div class="absolute -top-1.5 -right-1.5 flex items-center justify-center w-[18px] h-[18px] rounded-full text-white text-[10px] font-medium bg-electric-blue border-2 border-white">
                                <span>5</span>
                            </div>
                        </div>

                        <a href="{{ Auth::user()->isPropertyManager() ? route('property_manager.index') : route('renter.index') }}" class="w-11 h-11 rounded-full border border-light-gray overflow-hidden hover:opacity-90 transition-opacity">
                            <img alt="profile picture" class="h-full w-full object-cover" src="{{ Auth::user()->profile_photo_url ?? asset('images/user-placeholder.svg') }}">
                        </a>

                        <button class="bg-[#e8e8e7] rounded-full p-2 hover:bg-gray-300 transition-colors">
                            <img src="{{ asset('images/dehaze.svg') }}" alt="Menu" class="w-6 h-6">
                        </button>
                    @else
                        <button>
                            <img src="{{ asset('images/language_black.svg') }}" alt="Language" class="w-6 h-6">
                        </button>
                         <button @click.prevent="$dispatch('open-auth-modal')" class="bg-electric-blue text-white px-6 py-2.5 rounded-full text-sm font-medium hover:bg-blue-700 transition">
                            Log in or sign up
                        </button>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    <x-auth-modal />
@endif
