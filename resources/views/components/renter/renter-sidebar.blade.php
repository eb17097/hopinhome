<div class="w-full space-y-1">
    <a href="{{ route('renter.index') }}" class="flex items-center justify-between p-4 rounded-[4px] bg-[#f9f9f8] text-[#1e1d1d] group transition-colors">
        <span class="font-medium text-[16px] leading-[1.5]">My profile</span>
        <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
    </a>

    <a href="#" @click.prevent="$dispatch('open-notification-preferences-modal')" class="flex items-center justify-between p-4 rounded-[4px] hover:bg-[#f9f9f8] text-[#1e1d1d] group transition-colors">
        <span class="font-medium text-[16px] leading-[1.5]">Notification preferences</span>
        <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
    </a>

    <a href="#" @click.prevent="$dispatch('open-regional-preferences-modal')" class="flex items-center justify-between p-4 rounded-[4px] hover:bg-[#f9f9f8] text-[#1e1d1d] group transition-colors">
        <span class="font-medium text-[16px] leading-[1.5]">Regional preferences</span>
        <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
    </a>

    <a href="#" class="flex items-center justify-between p-4 rounded-[4px] hover:bg-[#f9f9f8] text-[#1e1d1d] group transition-colors">
        <span class="font-medium text-[16px] leading-[1.5]">Account security</span>
        <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
    </a>

    <form method="POST" action="{{ route('logout') }}" class="w-full">
        @csrf
        <button type="submit" class="flex items-center justify-between w-full p-4 rounded-[4px] hover:bg-red-50 text-[#ed0707] group transition-colors">
            <span class="font-medium text-[16px] leading-[1.5]">Sign out</span>
            <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_red.svg') }}">
        </button>
    </form>
</div>


