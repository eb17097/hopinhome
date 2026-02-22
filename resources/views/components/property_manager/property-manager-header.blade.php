@php use Illuminate\Support\Facades\Auth; @endphp
<nav class="bg-white border-b border-light-gray h-16 flex items-center px-6 justify-between">
    <div class="flex items-center space-x-[5px]">
        @if(request()->routeIs('property_manager.index'))
            <h2 class="text-[15px] font-medium text-[#1e1d1d]">Dashboard</h2>
        @else
            <a href="{{ route('property_manager.index') }}" class="text-[15px] font-medium text-[#1e1d1d] opacity-60 hover:opacity-100 transition-opacity">Dashboard</a>
            <img src="{{ asset('images/chevron.svg') }}" class="w-4 h-4 transform -rotate-90 opacity-60" alt="">
            
            @if(request()->routeIs('property_manager.listings.create'))
                <a href="{{ route('property_manager.index') }}" class="text-[15px] font-medium text-[#1e1d1d] opacity-60 hover:opacity-100 transition-opacity">Listings</a>
                <img src="{{ asset('images/chevron.svg') }}" class="w-4 h-4 transform -rotate-90 opacity-60" alt="">
                <h2 class="text-[15px] font-medium text-[#1e1d1d]">Create a listing</h2>
            @else
                <h2 class="text-[15px] font-medium text-[#1e1d1d]">Listings</h2>
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

        <button @click="$dispatch('toggle-sidebar')" class="bg-light-gray rounded-full p-2 hover:bg-gray-200 transition-colors">
            <img src="{{ asset('images/dehaze.svg') }}" alt="Menu" class="w-6 h-6">
        </button>
    </div>
</nav>
