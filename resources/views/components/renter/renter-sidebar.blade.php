<div class="w-full">
    <a href="{{ route('renter.index') }}" class="h-[48px] flex items-center justify-between p-4 rounded-[4px] {{ request()->routeIs('renter.index') ? 'bg-[#f9f9f8]' : 'hover:bg-[#f9f9f8]' }} text-[#1e1d1d] group transition-colors">
        <span class="font-medium text-[16px] leading-[1.5]">My profile</span>
        <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
    </a>

    <a href="#" @click.prevent="$dispatch('open-notification-preferences-modal')" class="h-[48px] flex items-center justify-between p-4 rounded-[4px] hover:bg-[#f9f9f8] text-[#1e1d1d] group transition-colors">
        <span class="font-medium text-[16px] leading-[1.5]">Notification preferences</span>
        <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
    </a>

    <a href="#" @click.prevent="$dispatch('open-regional-preferences-modal')" class="h-[48px] flex items-center justify-between p-4 rounded-[4px] hover:bg-[#f9f9f8] text-[#1e1d1d] group transition-colors">
        <span class="font-medium text-[16px] leading-[1.5]">Regional preferences</span>
        <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
    </a>

    <a href="{{ route('renter.security') }}" class="h-[48px] flex items-center justify-between p-4 rounded-[4px] {{ request()->routeIs('renter.security') ? 'bg-[#f9f9f8]' : 'hover:bg-[#f9f9f8]' }} text-[#1e1d1d] group transition-colors">
        <span class="font-medium text-[16px] leading-[1.5]">Account security</span>
        <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
    </a>

    <form method="POST" action="{{ route('logout') }}" class="w-full">
        @csrf
        <button type="submit" class="h-[48px] flex items-center justify-between w-full p-4 rounded-[4px] hover:bg-[#f9f9f8] group transition-colors">
            <span class="font-medium text-[16px] leading-[1.5]">Sign out</span>
            <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
        </button>
    </form>
</div>
