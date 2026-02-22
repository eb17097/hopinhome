@php use Illuminate\Support\Facades\Auth; @endphp
<div class="w-full h-full bg-white flex flex-col py-6">
    {{-- Home Section --}}
    <div class="px-2 mb-6">
        <p class="text-[12px] font-medium text-[#464646] uppercase px-2 mb-4 leading-[1.5]">Home</p>
        <div class="space-y-1">
            <a href="{{ route('property_manager.index') }}" class="flex items-center space-x-[10px] p-2 rounded-[4px] {{ request()->routeIs('property_manager.index') ? 'bg-[#f6f6f5] text-[#1e1d1d]' : 'hover:bg-gray-50 text-[#1e1d1d]' }} transition-colors">
                <img alt="speed" class="w-[18px] h-[18px]" src="{{ asset('images/speed.svg') }}">
                <span class="font-medium text-[14px] leading-[1.3]">Dashboard</span>
            </a>
            <a href="{{ route('property_manager.index') }}" class="flex items-center space-x-[10px] p-2 rounded-[4px] hover:bg-gray-50 text-[#1e1d1d] transition-colors">
                <img alt="apartment" class="w-[18px] h-[18px]" src="{{ asset('images/apartment_sidebar.svg') }}">
                <span class="font-medium text-[14px] leading-[1.3]">Listings</span>
            </a>
            <a href="#" class="flex items-center space-x-[10px] p-2 rounded-[4px] hover:bg-gray-50 text-[#1e1d1d] transition-colors">
                <img alt="group" class="w-[18px] h-[18px]" src="{{ asset('images/group.svg') }}">
                <span class="font-medium text-[14px] leading-[1.3]">Tenants</span>
            </a>
            <a href="#" class="flex items-center justify-between p-2 rounded-[4px] hover:bg-gray-50 text-[#1e1d1d] transition-colors">
                <div class="flex items-center space-x-[10px]">
                    <img alt="chat" class="w-[18px] h-[18px]" src="{{ asset('images/chat.svg') }}">
                    <span class="font-medium text-[14px] leading-[1.3]">Messages</span>
                </div>
            </a>
            <a href="#" class="flex items-center justify-between p-2 rounded-[4px] hover:bg-gray-50 text-[#1e1d1d] transition-colors">
                <div class="flex items-center space-x-[10px]">
                    <img alt="notifications" class="w-[18px] h-[18px]" src="{{ asset('images/notifications_sidebar.svg') }}">
                    <span class="font-medium text-[14px] leading-[1.3]">Notifications</span>
                </div>
                <div class="bg-electric-blue flex items-center justify-center px-[3px] h-[18px] min-w-[22px] rounded-[3px]">
                    <span class="text-white text-[14px] font-medium leading-[1.3]">17</span>
                </div>
            </a>
            <a href="#" class="flex items-center space-x-[10px] p-2 rounded-[4px] hover:bg-gray-50 text-[#1e1d1d] transition-colors">
                <img alt="analytics" class="w-[18px] h-[18px]" src="{{ asset('images/leaderboard.svg') }}">
                <span class="font-medium text-[14px] leading-[1.3]">Analytics</span>
            </a>
            <a href="#" class="flex items-center space-x-[10px] p-2 rounded-[4px] hover:bg-gray-50 text-[#1e1d1d] transition-colors">
                <img alt="reviews" class="w-[18px] h-[18px]" src="{{ asset('images/star.svg') }}">
                <span class="font-medium text-[14px] leading-[1.3]">Reviews</span>
            </a>
        </div>
    </div>

    {{-- Settings Section --}}
    <div class="px-2 mb-6">
        <p class="text-[12px] font-medium text-[#464646] uppercase px-2 mb-4 leading-[1.5]">Settings</p>
        <div class="space-y-1">
            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-[10px] p-2 rounded-[4px] {{ request()->routeIs('profile.edit') ? 'bg-[#f6f6f5] text-[#1e1d1d]' : 'hover:bg-gray-50 text-[#1e1d1d]' }} transition-colors">
                <img alt="account circle" class="w-[18px] h-[18px]" src="{{ asset('images/account_circle.svg') }}">
                <span class="font-medium text-[14px] leading-[1.3]">Profile settings</span>
            </a>
            <a href="#" @click.prevent="$dispatch('open-regional-preferences-modal')" class="flex items-center space-x-[10px] p-2 rounded-[4px] hover:bg-gray-50 text-[#1e1d1d] transition-colors">
                <img alt="language" class="w-[18px] h-[18px]" src="{{ asset('images/language_sidebar.svg') }}">
                <span class="font-medium text-[14px] leading-[1.3]">Regional settings</span>
            </a>
            <a href="#" @click.prevent="$dispatch('open-account-security-modal')" class="flex items-center space-x-[10px] p-2 rounded-[4px] hover:bg-gray-50 text-[#1e1d1d] transition-colors">
                <img alt="lock" class="w-[18px] h-[18px]" src="{{ asset('images/lock.svg') }}">
                <span class="font-medium text-[14px] leading-[1.3]">Account security</span>
            </a>
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="flex items-center space-x-[10px] w-full p-2 rounded-[4px] hover:bg-red-50 text-red-600 transition-colors text-left">
                    <div class="w-[18px] h-[18px] flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    </div>
                    <span class="font-medium text-[14px] leading-[1.3]">Sign out</span>
                </button>
            </form>
        </div>
    </div>

    {{-- Support Section --}}
    <div class="px-2 mb-8">
        <p class="text-[12px] font-medium text-[#464646] uppercase px-2 mb-4 leading-[1.5]">Support</p>
        <div class="space-y-1">
            <a href="#" class="flex items-center space-x-[10px] p-2 rounded-[4px] hover:bg-gray-50 text-[#1e1d1d] transition-colors">
                <img alt="contact support" class="w-[18px] h-[18px]" src="{{ asset('images/contact_support.svg') }}">
                <span class="font-medium text-[14px] leading-[1.3]">Help center</span>
            </a>
            <a href="#" class="flex items-center space-x-[10px] p-2 rounded-[4px] hover:bg-gray-50 text-[#1e1d1d] transition-colors">
                <img alt="headset mic" class="w-[18px] h-[18px]" src="{{ asset('images/headset_mic.svg') }}">
                <span class="font-medium text-[14px] leading-[1.3]">Request support</span>
            </a>
        </div>
    </div>

    <div class="px-4 mt-auto">
        <a href="{{ route('property_manager.listings.create') }}" class="bg-electric-blue text-white font-medium w-[200px] h-[40px] rounded-[6px] flex items-center justify-center space-x-[6px] hover:opacity-90 transition-all">
            <img alt="add" class="w-4 h-4 brightness-0 invert" src="{{ asset('images/add.svg') }}">
            <span class="text-[14px] leading-[1.3]">Create a listing</span>
        </a>
    </div>
</div>
