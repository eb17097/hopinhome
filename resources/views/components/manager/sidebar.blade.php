<div class="w-full">
    <div class="bg-off-white rounded-md p-4">
        <a href="{{ route('manager.index') }}" class="flex justify-between items-center py-3 px-2 {{ request()->routeIs('manager.index') ? 'bg-white rounded shadow' : '' }}">
            <span class="font-medium text-base text-black">My profile</span>
            <img alt="arrow forward" class="h-4 w-4" src="{{ asset('images/arrow_forward_black.svg') }}">
        </a>
        <a href="#" class="flex justify-between items-center py-3 px-2 mt-2 hover:bg-white/50 rounded transition">
            <span class="font-medium text-base text-black">Notification preferences</span>
            <img alt="arrow forward" class="h-4 w-4" src="{{ asset('images/arrow_forward_black.svg') }}">
        </a>
        <a href="#" class="flex justify-between items-center py-3 px-2 mt-2 hover:bg-white/50 rounded transition">
            <span class="font-medium text-base text-black">Regional preferences</span>
            <img alt="arrow forward" class="h-4 w-4" src="{{ asset('images/arrow_forward_black.svg') }}">
        </a>
        <a href="#" class="flex justify-between items-center py-3 px-2 mt-2 hover:bg-white/50 rounded transition">
            <span class="font-medium text-base text-black">Account security</span>
            <img alt="arrow forward" class="h-4 w-4" src="{{ asset('images/arrow_forward_black.svg') }}">
        </a>
    </div>

    <div class="bg-off-white rounded-md p-4 mt-6">
        <a href="#" class="flex justify-between items-center py-3 px-2 hover:bg-white/50 rounded transition">
            <span class="font-medium text-base text-black">My properties</span>
            <img alt="arrow forward" class="h-4 w-4" src="{{ asset('images/arrow_forward_black.svg') }}">
        </a>
        <a href="{{ route('listings.create') }}" class="flex justify-between items-center py-3 px-2 mt-2 hover:bg-white/50 rounded transition">
            <span class="font-medium text-base text-black">Add new property</span>
            <img alt="arrow forward" class="h-4 w-4" src="{{ asset('images/arrow_forward_black.svg') }}">
        </a>
    </div>

    <div class="mt-6">
        <form method="POST" action="{{ route('logout') }}" class="flex justify-between items-center py-3 px-2 hover:bg-gray-100/50 rounded transition">
            @csrf
            <button type="submit" class="flex justify-between items-center w-full">
                <span class="font-medium text-base text-red-600">Sign out</span>
                <img alt="arrow forward" class="h-4 w-4" src="{{ asset('images/arrow_forward_red.svg') }}">
            </button>
        </form>
    </div>
</div>

