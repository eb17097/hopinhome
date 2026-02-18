@php use Illuminate\Support\Facades\Auth; @endphp
<nav class="bg-white border-b border-light-gray h-16 flex items-center px-6 justify-between">
    <div class="flex items-center space-x-4">
        <h2 class="text-[15px] font-medium text-[#1e1d1d]">Dashboard</h2>
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
            <img alt="profile picture" class="h-full w-full object-cover" src="{{ Auth::user()->profile_photo_url ?? asset('images/profile_picture.png') }}">
        </a>

        <button @click="$dispatch('toggle-sidebar')" class="bg-light-gray rounded-full p-2 hover:bg-gray-200 transition-colors">
            <img src="{{ asset('images/dehaze.svg') }}" alt="Menu" class="w-6 h-6">
        </button>
    </div>
</nav>
