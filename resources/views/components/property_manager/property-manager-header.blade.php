@php use Illuminate\Support\Facades\Auth; @endphp
<nav class="bg-white border-b border-light-gray shadow-sm h-20 flex items-center px-8 justify-between">
    <div class="flex items-center space-x-2">
        <h2 class="text-xl font-medium text-black tracking-tight">Dashboard</h2>
        {{-- Placeholder for breadcrumbs --}}
    </div>

    <div class="flex items-center space-x-4">
        <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-blue-600 transition">Go to homepage</a>

        <div class="relative">
            <img src="{{ asset('images/notifications.svg') }}" alt="Notifications" class="w-6 h-6">
            <div class="absolute -top-1 -right-1 flex items-center justify-center w-4 h-4 rounded-full text-white text-xs font-normal bg-electric-blue">
                <span>5</span> {{-- Placeholder count --}}
            </div>
        </div>

        <a href="#" class="w-11 h-11 rounded-full border border-light-gray overflow-hidden">
            <img alt="profile picture" class="h-full w-full object-cover" src="{{ Auth::user()->profile_photo_url ?? asset('images/profile_picture.png') }}">
        </a>

        <button @click="$dispatch('toggle-sidebar')" class="bg-light-gray rounded-full p-2">
            <img src="{{ asset('images/hamburger.svg') }}" alt="Menu" class="w-6 h-6">
        </button>
    </div>
</nav>
