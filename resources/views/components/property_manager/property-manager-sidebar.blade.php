@php use Illuminate\Support\Facades\Auth; @endphp
<div class="w-full space-y-6">
    <div class="flex items-center gap-2 px-4 mb-6">
        <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopInHome Logo" class="h-6 w-auto">
    </div>

    {{-- Home Section --}}
    <div class="space-y-2">
        <p class="text-xs text-gray-600 px-4 uppercase font-medium mb-2">Home</p>
        <a href="{{ route('property_manager.index') }}" class="flex items-center space-x-3 p-2 rounded-md {{ request()->routeIs('property_manager.index') ? 'bg-gray-100 shadow-sm text-black' : 'hover:bg-gray-50 text-gray-700' }} transition">
            <img alt="speed" class="h-4 w-4" src="{{ asset('images/speed.svg') }}">
            <span class="font-medium text-base">Dashboard</span>
        </a>
        <a href="{{ route('property_manager.listings.index') }}" class="flex items-center space-x-3 p-2 rounded-md {{ request()->routeIs('property_manager.listings.index') ? 'bg-gray-100 shadow-sm text-black' : 'hover:bg-gray-50 text-gray-700' }} transition">
            <img alt="apartment" class="h-4 w-4" src="{{ asset('images/apartment_sidebar.svg') }}">
            <span class="font-medium text-base">Listings</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-gray-50 transition text-gray-700">
            <img alt="group" class="h-4 w-4" src="{{ asset('images/group.svg') }}">
            <span class="font-medium text-base">Tenants</span>
        </a>
        <a href="#" class="flex items-center justify-between p-2 rounded-md hover:bg-gray-50 transition text-gray-700">
            <div class="flex items-center space-x-3">
                <img alt="chat" class="h-4 w-4" src="{{ asset('images/chat.svg') }}">
                <span class="font-medium text-base">Messages</span>
            </div>
            <span class="bg-electric-blue text-white text-xs font-medium px-1.5 py-0.5 rounded">17</span>
        </a>
        <a href="#" class="flex items-center justify-between p-2 rounded-md hover:bg-gray-50 transition text-gray-700">
            <div class="flex items-center space-x-3">
                <img alt="notifications" class="h-4 w-4" src="{{ asset('images/notifications_sidebar.svg') }}">
                <span class="font-medium text-base">Notifications</span>
            </div>
            <span class="bg-electric-blue text-white text-xs font-medium px-1.5 py-0.5 rounded">5</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-gray-50 transition text-gray-700">
            <img alt="analytics" class="h-4 w-4" src="{{ asset('images/speed.svg') }}"> {{-- Using speed.svg for analytics --}}
            <span class="font-medium text-base">Analytics</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-gray-50 transition text-gray-700">
            <img alt="reviews" class="h-4 w-4" src="{{ asset('images/star.svg') }}">
            <span class="font-medium text-base">Reviews</span>
        </a>
    </div>

    <hr class="border-light-gray mx-4">

    {{-- Settings Section --}}
    <div class="space-y-2">
        <p class="text-xs text-gray-600 px-4 uppercase font-medium mb-2">Settings</p>
        <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 p-2 rounded-md {{ request()->routeIs('profile.edit') ? 'bg-gray-100 shadow-sm text-black' : 'hover:bg-gray-50 text-gray-700' }} transition">
            <img alt="account circle" class="h-4 w-4" src="{{ asset('images/account_circle.svg') }}">
            <span class="font-medium text-base">Profile settings</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-gray-50 transition text-gray-700">
            <img alt="language" class="h-4 w-4" src="{{ asset('images/language_sidebar.svg') }}">
            <span class="font-medium text-base">Regional settings</span>
        </a>
    </div>

    <hr class="border-light-gray mx-4">

    {{-- Support Section --}}
    <div class="space-y-2">
        <p class="text-xs text-gray-600 px-4 uppercase font-medium mb-2">Support</p>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-gray-50 transition text-gray-700">
            <img alt="contact support" class="h-4 w-4" src="{{ asset('images/contact_support.svg') }}">
            <span class="font-medium text-base">Help center</span>
        </a>
        <a href="#" class="flex items-center space-x-3 p-2 rounded-md hover:bg-gray-50 transition text-gray-700">
            <img alt="headset mic" class="h-4 w-4" src="{{ asset('images/headset_mic.svg') }}">
            <span class="font-medium text-base">Request support</span>
        </a>
    </div>

    <hr class="border-light-gray mx-4">

    {{-- Create a Listing Button --}}
    <div class="px-4 mt-6">
        <a href="{{ route('property_manager.listings.create') }}" class="bg-electric-blue text-white font-medium px-[32px] py-[10.5px] rounded-[6px] flex items-center justify-center space-x-2 hover:bg-blue-700 transition w-full">
            <img alt="add" class="h-4 w-4" src="{{ asset('images/add.svg') }}">
            <span class="font-medium text-base">Create a listing</span>
        </a>
    </div>

    <hr class="border-light-gray mx-4">

    {{-- Sign Out --}}
    <form method="POST" action="{{ route('logout') }}" class="w-full">
        @csrf
        <button type="submit" class="flex items-center space-x-3 p-2 rounded-md text-red-600 hover:bg-red-50/50 transition w-full">
            <span class="font-medium text-base">Sign out</span>
        </button>
    </form>
</div>
