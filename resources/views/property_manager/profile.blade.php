<x-property-manager-layout>
    <div class="p-[24px] max-w-[768px]">
        {{-- Header Section --}}
        <div class="flex items-center space-x-[10px] mb-[20px]">
            <img src="{{ asset('images/account_circle.svg') }}" alt="Profile" class="w-[30px] h-[30px]">
            <h1 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px]">Profile settings</h1>
        </div>

        {{-- User Info Card --}}
        <div class="bg-[#f9f9f8] rounded-[6px] mb-[16px]">
            <div class="flex items-center space-x-[12px] mb-[16px] px-[24px] pt-[24px]">
                <div class="w-[64px] h-[64px] rounded-full border border-light-gray overflow-hidden">
                    <img src="{{ Auth::user()->profile_photo_url ?? asset('images/user-placeholder.svg') }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                </div>
                <div>
                    <div class="flex items-center space-x-1">
                        <h2 class="text-[18px] font-medium text-[#1e1d1d] tracking-[-0.36px] leading-[1.28]">{{ Auth::user()->name }}</h2>
                        @if(Auth::user()->email_verified_at)
                            <img src="{{ asset('images/verified_user.svg') }}" alt="Verified" class="w-[18px] h-[18px]">
                        @endif
                    </div>
                    <p class="text-[14px] text-[#1e1d1d] font-medium leading-[1.5]">{{ Auth::user()->email }} • {{ Auth::user()->email_verified_at ? 'verified' : 'unverified' }}</p>
                </div>
            </div>

            <div class="border-t border-light-gray pt-4 px-[24px] pb-[24px]">
                <p class="text-[16px] text-[#464646] leading-[1.5]">
                    {{ Auth::user()->bio ?? 'No bio provided.' }}
                </p>
            </div>
        </div>

        {{-- Action Cards Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            {{-- Edit Bio --}}
            <button @click="$dispatch('open-edit-bio-modal')" class="h-[76px] bg-white border border-light-gray rounded-[6px] p-6 flex items-center justify-between hover:bg-gray-50 transition-colors group">
                <span class="text-[16px] font-medium text-[#1e1d1d]">Edit bio</span>
                <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
            </button>

            {{-- Change Profile Picture --}}
            <button @click="$dispatch('open-change-profile-photo-modal')" class="h-[76px] bg-white border border-light-gray rounded-[6px] p-6 flex items-center justify-between hover:bg-gray-50 transition-colors group">
                <span class="text-[16px] font-medium text-[#1e1d1d]">Change profile picture</span>
                <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
            </button>
        </div>

        <div class="border-t border-light-gray my-6"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            {{-- Payments & Subscriptions --}}
            <a href="#" class="h-[124px] bg-white border border-light-gray rounded-[6px] p-6 flex flex-col hover:bg-gray-50 transition-colors group">
                <div class="flex items-center justify-between mb-[6px]">
                    <span class="text-[16px] font-medium text-[#1e1d1d]">Payments & Subscriptions</span>
                    <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
                </div>
                <p class="text-[14px] text-[#464646]">Manage your plan, billing details, invoices, and subscription settings in one place.</p>
            </a>

            {{-- Message templates --}}
            <a href="#" class="h-[124px] bg-white border border-light-gray rounded-[6px] p-6 flex flex-col hover:bg-gray-50 transition-colors group">
                <div class="flex items-center justify-between mb-[6px]">
                    <span class="text-[16px] font-medium text-[#1e1d1d]">Message templates</span>
                    <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
                </div>
                <p class="text-[14px] text-[#464646]">Create and save reusable messages to respond to renters quickly and consistently.</p>
            </a>
        </div>

        <div class="border-t border-light-gray my-6"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            {{-- Notification preferences --}}
            <button @click="$dispatch('open-notification-preferences-modal')" class="h-[76px] bg-white border border-light-gray rounded-[6px] p-6 flex items-center justify-between hover:bg-gray-50 transition-colors group text-left">
                <span class="text-[16px] font-medium text-[#1e1d1d]">Notification preferences</span>
                <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
            </button>

            {{-- Regional preferences --}}
            <button @click="$dispatch('open-regional-preferences-modal')" class="h-[76px] bg-white border border-light-gray rounded-[6px] p-6 flex items-center justify-between hover:bg-gray-50 transition-colors group text-left">
                <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Regional preferences</span>
                <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
            </button>

            {{-- Account security --}}
            <a href="{{ route('property_manager.security') }}" class="h-[76px] bg-white border border-light-gray rounded-[6px] p-6 flex items-center justify-between hover:bg-gray-50 transition-colors group">
                <span class="text-[16px] font-medium text-[#1e1d1d]">Account security</span>
                <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
            </a>

            {{-- Sign out --}}
            <form method="POST" action="{{ route('logout') }}" class="w-full">
                @csrf
                <button type="submit" class="h-[76px] bg-white border border-light-gray rounded-[6px] p-6 flex items-center justify-between hover:bg-red-50 transition-colors group w-full text-left">
                    <span class="text-[16px] font-medium text-[#1e1d1d]">Sign out</span>
                    <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] opacity-90 group-hover:opacity-100 transition-opacity">
                </button>
            </form>
        </div>

    </div>
</x-property-manager-layout>
