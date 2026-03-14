@php use Illuminate\Support\Facades\Auth; @endphp
<nav class="bg-white border-b border-light-gray h-[74px] flex items-center px-6 justify-between">
    <div class="flex items-center space-x-[5px]">
        @if(request()->routeIs('property_manager.index'))
            <h2 class="text-[15px] font-medium text-[#1e1d1d]">Dashboard</h2>
        @else
            <a href="{{ route('property_manager.index') }}" class="text-[15px] font-medium text-[#1e1d1d] opacity-60 hover:opacity-100 transition-opacity">Dashboard</a>
            <img src="{{ asset('images/chevron.svg') }}" class="w-4 h-4 transform -rotate-90 opacity-60" alt="">

            @if(request()->routeIs('property_manager.profile'))
                <h2 class="text-[15px] font-medium text-[#1e1d1d]">Profile settings</h2>
            @elseif(request()->routeIs('property_manager.listings.create'))
                <a href="{{ route('property_manager.listings.index') }}" class="text-[15px] font-medium text-[#1e1d1d] opacity-60 hover:opacity-100 transition-opacity">Listings</a>
                <img src="{{ asset('images/chevron.svg') }}" class="w-4 h-4 transform -rotate-90 opacity-60" alt="">
                <h2 class="text-[15px] font-medium text-[#1e1d1d]">Create a listing</h2>
            @elseif(request()->routeIs('property_manager.listings.index'))
                <h2 class="text-[15px] font-medium text-[#1e1d1d]">Listings</h2>
            @else
                <h2 class="text-[15px] font-medium text-[#1e1d1d]">Page</h2>
            @endif
        @endif
    </div>

    <div class="flex items-center space-x-6">
        <a href="{{ route('home') }}" class="text-[15px] font-medium text-[#1e1d1d] hover:text-black transition-colors">Go to homepage</a>

        <div class="relative cursor-pointer">
            <img src="{{ asset('images/notifications.svg') }}" alt="Notifications" class="w-5 h-5 opacity-70">
            <div class="absolute -top-2 -right-2 flex items-center justify-center w-[18px] h-[18px] rounded-full text-white text-[10px] font-medium bg-electric-blue border-2 border-white">
                <span>5</span>
            </div>
        </div>

        <a href="#" class="w-8 h-8 rounded-full border border-light-gray overflow-hidden">
            <img alt="profile picture" class="h-full w-full object-cover" src="{{ Auth::user()->profile_photo_url ?? asset('images/user-placeholder.svg') }}">
        </a>

        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" @click.away="open = false" class="bg-light-gray rounded-full p-2 hover:bg-gray-200 transition-colors">
                <img src="{{ asset('images/dehaze.svg') }}" alt="Menu" class="w-6 h-6">
            </button>

            {{-- Dropdown Menu --}}
            <div x-show="open"
                 x-cloak
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-[-10px]"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-[-10px]"
                 class="absolute right-0 mt-2 w-[326px] bg-white rounded-[8px] border border-light-gray shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] z-[110] p-6 overflow-hidden">

                <div class="flex flex-col gap-4">
                    {{-- Settings Section --}}
                    <div class="flex flex-col">
                        <p class="text-[12px] font-medium text-[#464646] mb-1">Settings</p>
                        <div class="flex flex-col">
                            <a href="{{ route('property_manager.profile') }}" class="flex items-center gap-[10px] py-[10px] rounded-[4px] transition-colors">
                                <img src="{{ asset('images/account_circle.svg') }}" class="w-[18px] h-[18px]" alt="">
                                <span class="text-[16px] font-medium text-[#1e1d1d]">Profile settings</span>
                            </a>
                            <button @click.prevent="$dispatch('open-regional-preferences-modal'); open = false" class="flex items-center gap-[10px] py-[10px] rounded-[4px] transition-colors text-left w-full">
                                <img src="{{ asset('images/language_sidebar.svg') }}" class="w-[18px] h-[18px]" alt="">
                                <span class="text-[16px] font-medium text-[#1e1d1d]">Regional preferences</span>
                            </button>
                        </div>
                    </div>

                    {{-- Articles Section --}}
                    <div class="flex flex-col">
                        <p class="text-[12px] font-medium text-[#464646] mb-1">Articles</p>
                        <div class="flex flex-col">
                            <a href="#" class="py-[10px] rounded-[4px] transition-colors text-[16px] font-medium text-[#1e1d1d]">Insights</a>
                            <a href="#" class="py-[10px] rounded-[4px] transition-colors text-[16px] font-medium text-[#1e1d1d]">News</a>
                            <a href="#" class="py-[10px] rounded-[4px] transition-colors text-[16px] font-medium text-[#1e1d1d]">Community articles</a>
                            <a href="#" class="py-[10px] rounded-[4px] transition-colors text-[16px] font-medium text-[#1e1d1d]">Tips & Resources</a>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col gap-4 mt-2">
                        <a href="{{ route('home') }}" class="bg-electric-blue text-white font-medium h-[51px] rounded-[6px] flex items-center justify-center gap-[6px] hover:opacity-90 transition-all text-[16px] tracking-[-0.48px]">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="brightness-0 invert">
                                <path d="M19 8l-4 4h3c0 3.31-2.69 6-6 6-1.01 0-1.97-.25-2.8-.7l-1.46 1.46C8.97 19.54 10.43 20 12 20c4.42 0 8-3.58 8-8h3l-4-4zM6 12c0-3.31 2.69-6 6-6 1.01 0 1.97.25 2.8.7l1.46-1.46C15.03 4.46 13.57 4 12 4c-4.42 0-8 3.58-8 8H1l4 4 4-4H6z" fill="currentColor"/>
                            </svg>
                            Switch to renter
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="border border-light-gray bg-white text-[#1e1d1d] font-medium h-[51px] rounded-[6px] flex items-center justify-center hover:bg-gray-50 transition-all text-[16px] tracking-[-0.48px] w-full">
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
