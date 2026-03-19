@props(['isLanding' => false])

@php use Illuminate\Support\Facades\Auth; @endphp

<div x-data="{
    scrolled: window.scrollY > 50,
    showGlobalMenu: false,
    showUserDropdown: false
}"
@scroll.window="scrolled = window.scrollY > 50"
class="z-[50] {{ $isLanding ? 'fixed top-0 left-0 right-0' : 'sticky top-0' }}">

    <nav :class="{
            'bg-white border-b border-[#e8e8e7]': scrolled || showGlobalMenu || !@json($isLanding),
            'bg-transparent border-b border-transparent': !scrolled && !showGlobalMenu && @json($isLanding)
         }"
         class="transition-all duration-300 h-[88px] flex items-center">

        <div class="max-w-[1204px] mx-auto w-full flex justify-between items-center h-full">
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

                    <div class="relative">
                        <button @click="showUserDropdown = !showUserDropdown"
                                @click.away="showUserDropdown = false"
                                class="rounded-full p-2 transition-colors"
                                :class="(scrolled || showGlobalMenu || !@json($isLanding)) ? 'bg-[#e8e8e7] hover:bg-gray-300' : 'bg-white/20 hover:bg-white/30'">
                            <img src="{{ asset('images/dehaze.svg') }}" alt="Menu" class="w-6 h-6" :class="(!scrolled && !showGlobalMenu && @json($isLanding)) ? 'invert brightness-0' : ''">
                        </button>

                        {{-- User Dropdown Menu --}}
                        <div x-show="showUserDropdown"
                             x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95 translate-y-[-10px]"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                             x-transition:leave-end="opacity-0 scale-95 translate-y-[-10px]"
                             class="absolute right-0 mt-[12px] w-[326px] bg-white rounded-[8px] border border-light-gray shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] z-[110] px-[24px] py-[20px] overflow-hidden">

                            <div class="flex flex-col gap-4">
                                {{-- Main Section --}}
                                <div class="flex flex-col">
                                    <div>
                                        <a href="#" class="opacity-50 pointer-events-none flex items-center gap-[10px] py-[10px] rounded-[4px] transition-colors">
                                            <img src="{{ asset('images/chat.svg') }}" class="w-[18px] h-[18px]" alt="">
                                            <span class="text-[16px] font-medium text-[#1e1d1d] flex-1 leading-[1.5]">Messages</span>
                                            <div class="bg-electric-blue flex items-center justify-center px-[3px] h-[18px] min-w-[22px] rounded-[3px]">
                                                <span class="text-white text-[14px] font-medium leading-[1.3]">17</span>
                                            </div>
                                        </a>
                                        <a href="#" class="opacity-50 pointer-events-none flex items-center gap-[10px] py-[10px] rounded-[4px] transition-colors">
                                            <img src="{{ asset('images/notifications_sidebar.svg') }}" class="w-[18px] h-[18px]" alt="">
                                            <span class="text-[16px] font-medium text-[#1e1d1d] flex-1 leading-[1.5]">Notifications</span>
                                            <div class="bg-electric-blue flex items-center justify-center px-[3px] h-[18px] min-w-[22px] rounded-[3px]">
                                                <span class="text-white text-[14px] font-medium leading-[1.3]">5</span>
                                            </div>
                                        </a>
                                        <a href="#" class="opacity-50 pointer-events-none flex items-center gap-[10px] py-[10px] rounded-[4px] transition-colors">
                                            <img src="{{ asset('images/group.svg') }}" class="w-[18px] h-[18px]" alt="">
                                            <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Landlords</span>
                                        </a>
                                        <a href="#" class="opacity-50 pointer-events-none flex items-center gap-[10px] py-[10px] rounded-[4px] transition-colors">
                                            <img src="{{ asset('images/favorite.svg') }}" class="w-[18px] h-[18px]" alt="">
                                            <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Saved listings</span>
                                        </a>
                                        <a href="{{ route('listings.index') }}" class="flex items-center gap-[10px] py-[10px] rounded-[4px] transition-colors">
                                            <img src="{{ asset('images/black_search.svg') }}" class="w-[18px] h-[18px]" alt="">
                                            <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Search listings</span>
                                        </a>
                                    </div>
                                </div>

                                {{-- Settings Section --}}
                                <div class="flex flex-col">
                                    <p class="text-[12px] font-medium text-[#464646] mb-1">Settings</p>
                                    <div class="flex flex-col">
                                        <a href="{{ Auth::user()->isPropertyManager() ? route('property_manager.profile') : route('profile.update') }}" class="flex items-center gap-[10px] py-[10px] rounded-[4px] transition-colors">
                                            <img src="{{ asset('images/account_circle.svg') }}" class="w-[18px] h-[18px]" alt="">
                                            <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Profile settings</span>
                                        </a>
                                        <button @click.prevent="$dispatch('open-regional-preferences-modal'); showUserDropdown = false" class="flex items-center gap-[10px] py-[10px] rounded-[4px] transition-colors text-left w-full">
                                            <img src="{{ asset('images/language_sidebar.svg') }}" class="w-[18px] h-[18px]" alt="">
                                            <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Regional preferences</span>
                                        </button>
                                    </div>
                                </div>

                                {{-- Support Section --}}
                                <div class="flex flex-col">
                                    <p class="text-[12px] font-medium text-[#464646] mb-1">Support</p>
                                    <div class="flex flex-col">
                                        <a href="#" class="opacity-50 pointer-events-none flex items-center gap-[10px] py-[10px] rounded-[4px] transition-colors">
                                            <img src="{{ asset('images/contact_support.svg') }}" class="w-[18px] h-[18px]" alt="">
                                            <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Help center</span>
                                        </a>
                                        <a href="#" class="opacity-50 pointer-events-none flex items-center gap-[10px] py-[10px] rounded-[4px] transition-colors">
                                            <img src="{{ asset('images/headset_mic.svg') }}" class="w-[18px] h-[18px]" alt="">
                                            <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Support tickets</span>
                                        </a>
                                    </div>
                                </div>

                                {{-- Footer Section --}}
                                <div class="flex flex-col gap-4">
                                    <form method="POST" action="{{ route('logout') }}" class="w-full mb-0">
                                        @csrf
                                        <button type="submit" class="border border-light-gray bg-white text-[#1e1d1d] font-medium h-[51px] rounded-[6px] flex items-center justify-center hover:bg-gray-50 transition-all text-[16px] tracking-[-0.48px] w-full">
                                            Sign out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <button @click="showGlobalMenu = !showGlobalMenu" class="focus:outline-none flex items-center">
                        @if($isLanding)
                            <img x-show="!scrolled && !showGlobalMenu" src="{{ asset('images/language_white.svg') }}" alt="Language" class="w-6 h-6">
                            <img x-show="scrolled || showGlobalMenu" src="{{ asset('images/language_black.svg') }}" alt="Language" class="w-6 h-6" style="display: none;">
                        @else
                            <img src="{{ asset('images/language_black.svg') }}" alt="Language" class="w-6 h-6">
                        @endif
                    </button>
                    <button @click.prevent="$dispatch('open-auth-modal')"
                            class="bg-electric-blue border border-electric-blue text-[#f9f9f8] px-[20px] py-[10px] rounded-[29.5px] text-[16px] font-medium leading-[1.22] tracking-[-0.48px] hover:opacity-90 transition-all text-center whitespace-nowrap">
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
         class="absolute top-full left-0 w-full bg-white border-b border-[#e8e8e7]">

        <div class="max-w-[1440px] mx-auto px-8 grid grid-cols-4 relative">
            {{-- United Arab Emirates --}}
            <div class="pr-8 py-10">
                <h3 class="text-[18px] font-medium text-[#1E1D1D] tracking-[-0.36px] mb-3">United Arab Emirates</h3>
                <ul class="space-y-3">
                    @foreach(['Dubai', 'Abu Dhabi', 'Sharjah', 'Ajman', 'Ras Al Khaimah', 'Fujairah', 'Umm Al Quwain'] as $city)
                        <li><a href="#" class="text-[15px] text-[#1E1D1D] hover:text-electric-blue transition-colors">{{ $city }}</a></li>
                    @endforeach
                    <li class="pt-2"><a href="#" class="text-[15px] text-[#1E1D1D] underline font-normal hover:text-electric-blue transition-colors">All cities</a></li>
                </ul>
            </div>

            {{-- Germany --}}
            <div class="px-8 py-10 border-l border-[#d9d9d9]/30">
                <h3 class="text-[18px] font-medium text-[#1E1D1D] tracking-[-0.36px] mb-3">Germany</h3>
                <ul class="space-y-3">
                    @foreach(['Berlin', 'Munich', 'Hamburg', 'Frankfurt am Main', 'Cologne', 'Stuttgart', 'Düsseldorf'] as $city)
                        <li><a href="#" class="text-[15px] text-[#1E1D1D] hover:text-electric-blue transition-colors">{{ $city }}</a></li>
                    @endforeach
                    <li class="pt-2"><a href="#" class="text-[15px] text-[#1E1D1D] underline font-normal hover:text-electric-blue transition-colors">All cities</a></li>
                </ul>
            </div>

            {{-- Latvia --}}
            <div class="px-8 py-10 border-l border-[#d9d9d9]/30">
                <h3 class="text-[18px] font-medium text-[#1E1D1D] tracking-[-0.36px] mb-3">Latvia</h3>
                <ul class="space-y-3">
                    @foreach(['Riga', 'Daugavpils', 'Liepāja', 'Jelgava', 'Jūrmala', 'Ventspils', 'Rēzekne'] as $city)
                        <li><a href="#" class="text-[15px] text-[#1E1D1D] hover:text-electric-blue transition-colors">{{ $city }}</a></li>
                    @endforeach
                    <li class="pt-2"><a href="#" class="text-[15px] text-[#1E1D1D] underline font-normal hover:text-electric-blue transition-colors">All cities</a></li>
                </ul>
            </div>

            {{-- Countries --}}
            <div class="pl-8 py-10 border-l border-[#d9d9d9]/30">
                <h3 class="text-[18px] font-medium text-[#1E1D1D] tracking-[-0.36px] mb-3">Countries</h3>
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
