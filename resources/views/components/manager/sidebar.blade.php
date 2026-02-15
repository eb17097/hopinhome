<div class="w-full space-y-6">
    {{-- User Profile Section --}}
    <div class="flex items-center space-x-4 p-4 bg-off-white rounded-md">
        <div class="w-16 h-16 rounded-full border border-light-gray overflow-hidden">
            <img alt="profile picture" class="h-full w-full object-cover" src="{{ asset('images/profile_picture.png') }}">
        </div>
        <div>
            <div class="flex items-center space-x-2">
                <span class="font-medium text-lg text-black">Sarah Johnson</span>
                <img alt="verified user" class="h-4 w-4" src="{{ asset('images/verified_user.svg') }}">
            </div>
            <a href="{{ route('manager.index') }}" class="text-sm text-gray-600 hover:underline">View your profile</a>
        </div>
    </div>

    <hr class="border-light-gray">

    {{-- My Account Section --}}
    <div class="space-y-2">
        <h4 class="text-xs text-gray-600 px-2 uppercase font-medium">My Account</h4>
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 p-2 rounded-md {{ request()->routeIs('dashboard') ? 'bg-white shadow' : 'hover:bg-white/50' }} transition">
            <img alt="speed" class="h-4 w-4" src="{{ asset('images/speed.svg') }}">
            <span class="font-medium text-base text-black">Dashboard</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-white/50 transition">
            <img alt="apartment" class="h-4 w-4" src="{{ asset('images/apartment.svg') }}">
            <span class="font-medium text-base text-black">My listings</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-white/50 transition">
            <img alt="group" class="h-4 w-4" src="{{ asset('images/group.svg') }}">
            <span class="font-medium text-base text-black">My tenants</span>
        </a>
        <a href="#" class="flex items-center justify-between p-2 rounded-md hover:bg-white/50 transition">
            <div class="flex items-center space-x-3">
                <img alt="chat" class="h-4 w-4" src="{{ asset('images/chat.svg') }}">
                <span class="font-medium text-base text-black">Messages</span>
            </div>
            <span class="bg-electric-blue text-white text-xs font-medium px-1.5 py-0.5 rounded">17</span>
        </a>
        <a href="#" class="flex items-center justify-between p-2 rounded-md hover:bg-white/50 transition">
            <div class="flex items-center space-x-3">
                <img alt="notifications" class="h-4 w-4" src="{{ asset('images/notifications_sidebar.svg') }}">
                <span class="font-medium text-base text-black">Notifications</span>
            </div>
            <span class="bg-electric-blue text-white text-xs font-medium px-1.5 py-0.5 rounded">5</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-white/50 transition">
            <img alt="favorite" class="h-4 w-4" src="{{ asset('images/favorite.svg') }}">
            <span class="font-medium text-base text-black">Saved properties</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-white/50 transition">
            <img alt="search" class="h-4 w-4" src="{{ asset('images/search.svg') }}">
            <span class="font-medium text-base text-black">Search properties</span>
        </a>
    </div>

    <hr class="border-light-gray">

    {{-- My Properties Section --}}
    <div class="space-y-2">
        <h4 class="text-xs text-gray-600 px-2 uppercase font-medium">My Properties</h4>
        <a href="{{ route('listings.create') }}" class="flex justify-between items-center py-3 px-2 rounded-md hover:bg-white/50 transition">
            <span class="font-medium text-base text-black">Add new property</span>
            <img alt="arrow forward" class="h-4 w-4" src="{{ asset('images/arrow_forward_black.svg') }}">
        </a>
    </div>

    <hr class="border-light-gray">

    {{-- Settings Section --}}
    <div class="space-y-2">
        <h4 class="text-xs text-gray-600 px-2 uppercase font-medium">Settings</h4>
        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 p-2 rounded-md {{ request()->routeIs('profile.edit') ? 'bg-white shadow' : 'hover:bg-white/50' }} transition">
            <img alt="account circle" class="h-4 w-4" src="{{ asset('images/account_circle.svg') }}">
            <span class="font-medium text-base text-black">Profile settings</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-white/50 transition">
            <img alt="language" class="h-4 w-4" src="{{ asset('images/language_sidebar.svg') }}">
            <span class="font-medium text-base text-black">Regional settings</span>
        </a>
    </div>

    <hr class="border-light-gray">

    {{-- Support Section --}}
    <div class="space-y-2">
        <h4 class="text-xs text-gray-600 px-2 uppercase font-medium">Support</h4>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-white/50 transition">
            <img alt="contact support" class="h-4 w-4" src="{{ asset('images/contact_support.svg') }}">
            <span class="font-medium text-base text-black">Help center</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-white/50 transition">
            <img alt="headset mic" class="h-4 w-4" src="{{ asset('images/headset_mic.svg') }}">
            <span class="font-medium text-base text-black">Request support</span>
        </a>
    </div>

    <hr class="border-light-gray">

    {{-- Articles Section --}}
    <div class="space-y-2">
        <h4 class="text-xs text-gray-600 px-2 uppercase font-medium">Articles</h4>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-white/50 transition">
            <span class="font-medium text-base text-black">Insights</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-white/50 transition">
            <span class="font-medium text-base text-black">News</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-white/50 transition">
            <span class="font-medium text-base text-black">Community articles</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-white/50 transition">
            <span class="font-medium text-base text-black">Tips & Resources</span>
        </a>
    </div>

    <hr class="border-light-gray">

    {{-- Sign Out --}}
    <form method="POST" action="{{ route('logout') }}" class="w-full">
        @csrf
        <button type="submit" class="flex items-center space-x-3 p-2 rounded-md text-red-600 hover:bg-red-50/50 transition w-full">
            <img alt="arrow forward" class="h-4 w-4 transform rotate-180" src="{{ asset('images/arrow_forward_red.svg') }}">
            <span class="font-medium text-base">Sign out</span>
        </button>
    </form>
</div>


