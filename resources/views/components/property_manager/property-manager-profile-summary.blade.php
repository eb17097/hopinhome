@php use Illuminate\Support\Facades\Auth; @endphp

<div @click="$dispatch('open-profile-photo-modal')" class="bg-[#f9f9f8] rounded-[6px] p-4 flex items-center justify-between cursor-pointer hover:bg-gray-100 transition-colors">
    <div class="flex items-center space-x-4">
        <div class="w-16 h-16 rounded-full border border-light-gray overflow-hidden shrink-0">
            <img alt="profile picture" class="h-full w-full object-cover" src="{{ Auth::user()->getProfilePhotoUrl() }}">
        </div>
        <div>
            <div class="flex items-center gap-1">
                <h3 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.28]">{{ Auth::user()->name }}</h3>
                <img alt="verified user" class="w-[18px] h-[18px]" src="{{ asset('images/verified_user.svg') }}">
            </div>
            <p class="text-[14px] font-medium text-[#1e1d1d] leading-[1.5]">
                {{ Auth::user()->email }} • verified
            </p>
        </div>
    </div>
    <img alt="arrow forward" class="w-[18px] h-[18px] brightness-0 opacity-70" src="{{ asset('images/arrow_forward.svg') }}">
</div>