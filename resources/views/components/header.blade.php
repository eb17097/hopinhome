@props(['isLanding' => false])

@php use Illuminate\Support\Facades\Auth; @endphp

<div x-data="{ 
    scrolled: window.scrollY > 50,
    showGlobalMenu: false
}"
@scroll.window="scrolled = window.scrollY > 50"
class="z-50 {{ $isLanding ? 'fixed top-0 left-0 right-0' : 'sticky top-0' }}">
    
    <nav :class="{
            'bg-white border-b border-[#e8e8e7] shadow-sm': scrolled || showGlobalMenu || !@json($isLanding),
            'bg-transparent border-b border-transparent': !scrolled && !showGlobalMenu && @json($isLanding)
         }"
         class="transition-all duration-300 h-[88px] flex items-center">
        
        <div class="max-w-[1440px] mx-auto px-8 w-full flex justify-between items-center h-full">
            {{-- Logo --}}
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2">
                    @if($isLanding)
                        <img x-show="scrolled || showGlobalMenu" src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopInHome Logo" class="h-7 w-auto" style="display: none;">
                        <img x-show="!scrolled && !showGlobalMenu" src="{{ asset('images/hopinhome_logo_white.svg') }}" alt="HopInHome Logo" class="h-7 w-auto">
                    @else
                        <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopInHome Logo" class="h-7 w-auto">
                    @endif
                </a>
            </div>

            {{-- Main Navigation --}}
            <div class="hidden md:flex items-center space-x-12">
                <a href="/" class="text-[16px] font-medium transition-colors" :class="(scrolled || showGlobalMenu || !@json($isLanding)) ? 'text-[#1e1d1d] hover:text-blue-600' : 'text-white hover:text-gray-200'">Home</a>
                <a href="{{ route('listings.index') }}" class="text-[16px] font-medium transition-colors" :class="(scrolled || showGlobalMenu || !@json($isLanding)) ? 'text-[#1e1d1d] hover:text-blue-600' : 'text-gray-200 hover:text-white'">Find Properties</a>
                <a href="#" class="text-[16px] font-medium transition-colors" :class="(scrolled || showGlobalMenu || !@json($isLanding)) ? 'text-[#1e1d1d] hover:text-blue-600' : 'text-gray-200 hover:text-white'">Articles & Insights</a>
                <a href="#" class="text-[16px] font-medium transition-colors" :class="(scrolled || showGlobalMenu || !@json($isLanding)) ? 'text-[#1e1d1d] hover:text-blue-600' : 'text-gray-200 hover:text-white'">About Us</a>
                @if($isLanding)
                    @guest
                    <a href="#" class="text-[16px] font-medium transition-colors" :class="(scrolled || showGlobalMenu) ? 'text-[#1e1d1d] hover:text-blue-600' : 'text-white hover:text-gray-200'">Add a listing</a>
                    @endguest
                @endif
            </div>

            <div class="flex items-center space-x-6">
                @auth
                    <div class="relative cursor-pointer">
                        <img src="{{ asset('images/notifications.svg') }}" alt="Notifications" class="w-6 h-6 opacity-80" :class="(!scrolled && !showGlobalMenu && @json($isLanding)) ? 'invert brightness-0' : ''">
                        <div class="absolute -top-1.5 -right-1.5 flex items-center justify-center w-[18px] h-[18px] rounded-full text-white text-[10px] font-medium bg-electric-blue border-2 border-white">
                            <span>5</span>
                        </div>
                    </div>

                    <a href="{{ Auth::user()->isPropertyManager() ? route('property_manager.index') : route('renter.index') }}" class="w-11 h-11 rounded-full border border-light-gray overflow-hidden hover:opacity-90 transition-opacity">
                        <img alt="profile picture" class="h-full w-full object-cover" src="{{ Auth::user()->profile_photo_url ?? asset('images/user-placeholder.svg') }}">
                    </a>

                    <button class="rounded-full p-2 transition-colors" :class="(scrolled || showGlobalMenu || !@json($isLanding)) ? 'bg-[#e8e8e7] hover:bg-gray-300' : 'bg-white/20 hover:bg-white/30'">
                        <img src="{{ asset('images/dehaze.svg') }}" alt="Menu" class="w-6 h-6" :class="(!scrolled && !showGlobalMenu && @json($isLanding)) ? 'invert brightness-0' : ''">
                    </button>
                @else
                    <button @click="showGlobalMenu = !showGlobalMenu" class="focus:outline-none flex items-center">
                        @if($isLanding)
                            <img x-show="!scrolled && !showGlobalMenu" src="{{ asset('images/language_white.svg') }}" alt="Language" class="w-6 h-6">
                            <img x-show="scrolled || showGlobalMenu" src="{{ asset('images/language_black.svg') }}" alt="Language" class="w-6 h-6" style="display: none;">
                        @else
                            <img src="{{ asset('images/language_black.svg') }}" alt="Language" class="w-6 h-6">
                        @endif
                    </button>
                    <button @click.prevent="$dispatch('open-auth-modal')" class="text-white px-6 py-2.5 rounded-full text-sm font-medium transition" :class="(scrolled || showGlobalMenu || !@json($isLanding)) ? 'bg-electric-blue hover:bg-blue-700' : 'bg-[#1447D4] hover:bg-blue-700'">
                        Log in or sign up
                    </button>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Global Mega Menu --}}
    <div x-show="showGlobalMenu" 
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         @click.away="showGlobalMenu = false"
         class="absolute top-full left-0 w-full bg-white shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] border-t border-[#E8E8E7] py-12">
        
        <div class="max-w-[1440px] mx-auto px-8 grid grid-cols-4 relative">
            {{-- United Arab Emirates --}}
            <div class="pr-12">
                <h3 class="text-[18px] font-medium text-[#1E1D1D] tracking-[-0.36px] mb-6">United Arab Emirates</h3>
                <ul class="space-y-3">
                    @foreach(['Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman', 'Ras Al Khaimah', 'Fujairah', 'Umm Al Quwain'] as $city)
                        <li><a href="#" class="text-[15px] text-[#1E1D1D] hover:text-electric-blue transition-colors">{{ $city }}</a></li>
                    @endforeach
                    <li class="pt-2"><a href="#" class="text-[15px] text-[#1E1D1D] underline font-normal hover:text-electric-blue transition-colors">All cities</a></li>
                </ul>
            </div>

            {{-- Germany --}}
            <div class="px-12 border-l border-[#d9d9d9]/30">
                <h3 class="text-[18px] font-medium text-[#1E1D1D] tracking-[-0.36px] mb-6">Germany</h3>
                <ul class="space-y-3">
                    @foreach(['Berlin', 'Munich', 'Hamburg', 'Frankfurt am Main', 'Cologne', 'Stuttgart', 'Düsseldorf'] as $city)
                        <li><a href="#" class="text-[15px] text-[#1E1D1D] hover:text-electric-blue transition-colors">{{ $city }}</a></li>
                    @endforeach
                    <li class="pt-2"><a href="#" class="text-[15px] text-[#1E1D1D] underline font-normal hover:text-electric-blue transition-colors">All cities</a></li>
                </ul>
            </div>

            {{-- Latvia --}}
            <div class="px-12 border-l border-[#d9d9d9]/30">
                <h3 class="text-[18px] font-medium text-[#1E1D1D] tracking-[-0.36px] mb-6">Latvia</h3>
                <ul class="space-y-3">
                    @foreach(['Riga', 'Daugavpils', 'Liepāja', 'Jelgava', 'Jūrmala', 'Ventspils', 'Rēzekne'] as $city)
                        <li><a href="#" class="text-[15px] text-[#1E1D1D] hover:text-electric-blue transition-colors">{{ $city }}</a></li>
                    @endforeach
                    <li class="pt-2"><a href="#" class="text-[15px] text-[#1E1D1D] underline font-normal hover:text-electric-blue transition-colors">All cities</a></li>
                </ul>
            </div>

            {{-- Countries --}}
            <div class="pl-12 border-l border-[#d9d9d9]/30">
                <h3 class="text-[18px] font-medium text-[#1E1D1D] tracking-[-0.36px] mb-6">Countries</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-[16px] text-[#1E1D1D] hover:text-electric-blue transition-colors">United Arab Emirates</a></li>
                    <li><a href="#" class="text-[16px] text-[#1E1D1D] hover:text-electric-blue transition-colors">Germany</a></li>
                    <li><a href="#" class="text-[16px] text-[#1E1D1D] hover:text-electric-blue transition-colors">Latvia</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<x-auth-modal />
