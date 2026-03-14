@php use Illuminate\Support\Facades\Auth; @endphp
<div class="w-full h-full bg-white flex flex-col transition-all duration-300">
    {{-- Home Section --}}
    <div class="px-[8px] mb-[16px]">
        <p x-show="sidebarOpen" x-cloak class="text-[12px] font-medium text-[#464646] px-2 mb-[4px] leading-[1.5] transition-opacity duration-300">Home</p>
        <div class="space-y-1">
            <a href="{{ route('property_manager.index') }}" 
               class="flex items-center rounded-[4px] p-2 transition-all duration-300 {{ request()->routeIs('property_manager.index') ? 'bg-[#f6f6f5] text-[#1e1d1d]' : 'hover:bg-gray-50 text-[#1e1d1d]' }}"
               :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                <img alt="speed" class="w-[18px] h-[18px] shrink-0" src="{{ asset('images/speed.svg') }}">
                <span x-show="sidebarOpen" x-cloak class="font-medium text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Dashboard</span>
            </a>
            <a href="{{ route('property_manager.listings.index') }}" 
               class="flex items-center rounded-[4px] p-2 transition-all duration-300 {{ request()->routeIs('property_manager.listings.index') ? 'bg-[#f6f6f5] text-[#1e1d1d]' : 'hover:bg-gray-50 text-[#1e1d1d]' }}"
               :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                <img alt="apartment" class="w-[18px] h-[18px] shrink-0" src="{{ asset('images/apartment_black.svg') }}">
                <span x-show="sidebarOpen" x-cloak class="font-medium text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Listings</span>
            </a>
            <a href="#" 
               class="flex items-center rounded-[4px] p-2 transition-all duration-300 hover:bg-gray-50 text-[#1e1d1d]"
               :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                <img alt="group" class="w-[18px] h-[18px] shrink-0" src="{{ asset('images/group.svg') }}">
                <span x-show="sidebarOpen" x-cloak class="font-medium text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Tenants</span>
            </a>
            <a href="#" 
               class="flex items-center rounded-[4px] p-2 transition-all duration-300 hover:bg-gray-50 text-[#1e1d1d]"
               :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                <div class="flex items-center shrink-0" :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                    <img alt="chat" class="w-[18px] h-[18px]" src="{{ asset('images/chat.svg') }}">
                </div>
                <span x-show="sidebarOpen" x-cloak class="font-medium text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Messages</span>
            </a>
            <a href="#" 
               class="flex items-center rounded-[4px] p-2 transition-all duration-300 hover:bg-gray-50 text-[#1e1d1d] relative"
               :class="sidebarOpen ? 'justify-between' : 'justify-center'">
                <div class="flex items-center" :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                    <img alt="notifications" class="w-[18px] h-[18px] shrink-0" src="{{ asset('images/notifications_sidebar.svg') }}">
                    <span x-show="sidebarOpen" x-cloak class="font-medium text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Notifications</span>
                </div>
                <div x-show="sidebarOpen" x-cloak class="bg-electric-blue flex items-center justify-center px-[3px] h-[18px] min-w-[22px] rounded-[3px]">
                    <span class="text-white text-[14px] font-medium leading-[1.3]">17</span>
                </div>
                {{-- Mini badge for collapsed state --}}
                <div x-show="!sidebarOpen" x-cloak class="absolute top-1 right-1 w-2 h-2 bg-electric-blue rounded-full border border-white"></div>
            </a>
            <a href="#" 
               class="flex items-center rounded-[4px] p-2 transition-all duration-300 hover:bg-gray-50 text-[#1e1d1d]"
               :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                <img alt="analytics" class="w-[18px] h-[18px] shrink-0" src="{{ asset('images/leaderboard.svg') }}">
                <span x-show="sidebarOpen" x-cloak class="font-medium text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Analytics</span>
            </a>
            <a href="#" 
               class="flex items-center rounded-[4px] p-2 transition-all duration-300 hover:bg-gray-50 text-[#1e1d1d]"
               :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                <img alt="reviews" class="w-[18px] h-[18px] shrink-0" src="{{ asset('images/star.svg') }}">
                <span x-show="sidebarOpen" x-cloak class="font-medium text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Reviews</span>
            </a>
            <a href="#" 
               class="flex items-center rounded-[4px] p-2 transition-all duration-300 hover:bg-gray-50 text-[#1e1d1d]"
               :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                <img alt="credits" class="w-[18px] h-[18px] shrink-0" src="{{ asset('images/credits_usage.svg') }}">
                <span x-show="sidebarOpen" x-cloak class="font-medium text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Credits usage</span>
            </a>
        </div>
    </div>

    {{-- Settings Section --}}
    <div class="px-[8px] mb-[16px]">
        <p x-show="sidebarOpen" x-cloak class="text-[12px] font-medium text-[#464646] px-2 mb-[4px] leading-[1.5] transition-opacity duration-300">Settings</p>
        <div class="space-y-1">
            <a href="{{ route('property_manager.profile') }}" 
               class="flex items-center rounded-[4px] p-2 transition-all duration-300 {{ request()->routeIs('property_manager.profile') || request()->routeIs('property_manager.security') ? 'bg-[#f6f6f5] text-[#1e1d1d]' : 'hover:bg-gray-50 text-[#1e1d1d]' }}"
               :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                <img alt="account circle" class="w-[18px] h-[18px] shrink-0" src="{{ asset('images/account_circle.svg') }}">
                <span x-show="sidebarOpen" x-cloak class="font-medium text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Profile settings</span>
            </a>
            <a href="#" @click.prevent="$dispatch('open-regional-preferences-modal')" 
               class="flex items-center rounded-[4px] p-2 transition-all duration-300 hover:bg-gray-50 text-[#1e1d1d]"
               :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                <img alt="language" class="w-[18px] h-[18px] shrink-0" src="{{ asset('images/language_sidebar.svg') }}">
                <span x-show="sidebarOpen" x-cloak class="font-medium text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Regional settings</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" 
                        class="flex items-center w-full rounded-[4px] p-2 transition-all duration-300 hover:bg-red-50 text-red-600 text-left"
                        :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                    <div class="w-[18px] h-[18px] flex items-center justify-center shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </div>
                    <span x-show="sidebarOpen" x-cloak class="font-medium text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Sign out</span>
                </button>
            </form>
        </div>
    </div>

    {{-- Support Section --}}
    <div class="px-[8px] mb-[16px]">
        <p x-show="sidebarOpen" x-cloak class="text-[12px] font-medium text-[#464646] px-2 mb-[4px] leading-[1.5] transition-opacity duration-300">Support</p>
        <div class="space-y-1">
            <a href="#" 
               class="flex items-center rounded-[4px] p-2 transition-all duration-300 hover:bg-gray-50 text-[#1e1d1d]"
               :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                <img alt="contact support" class="w-[18px] h-[18px] shrink-0" src="{{ asset('images/contact_support.svg') }}">
                <span x-show="sidebarOpen" x-cloak class="font-medium text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Help center</span>
            </a>
            <a href="#" 
               class="flex items-center rounded-[4px] p-2 transition-all duration-300 hover:bg-gray-50 text-[#1e1d1d]"
               :class="sidebarOpen ? 'space-x-[10px]' : 'justify-center'">
                <img alt="headset mic" class="w-[18px] h-[18px] shrink-0" src="{{ asset('images/headset_mic.svg') }}">
                <span x-show="sidebarOpen" x-cloak class="font-medium text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Request support</span>
            </a>
        </div>
    </div>

    <div x-show="sidebarOpen" x-cloak class="mt-auto transition-all duration-300 px-4">
        <a href="{{ route('property_manager.listings.create') }}" 
           class="bg-electric-blue text-white font-medium rounded-[6px] flex items-center justify-center transition-all duration-300 hover:opacity-90 w-full h-[40px] space-x-[6px]">
            <img alt="add" class="w-4 h-4 brightness-0 invert shrink-0" src="{{ asset('images/add.svg') }}">
            <span class="text-[14px] leading-[1.3] whitespace-nowrap overflow-hidden">Create a listing</span>
        </a>
    </div>
</div>

