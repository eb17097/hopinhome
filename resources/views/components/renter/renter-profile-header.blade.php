<div>
    {{-- Profile Summary Card --}}
    <div class="bg-[#f9f9f8] rounded-[6px] py-[24px]">
        <div class="flex items-center px-[24px]">
            <div class="w-16 h-16 rounded-full border border-light-gray overflow-hidden shrink-0">
                <img alt="profile picture" class="h-full w-full object-cover" src="{{ auth()->user()->getProfilePhotoUrl() }}">
            </div>
            <div class="ml-[12px]">
                <div class="flex items-center gap-1">
                    <h3 class="text-[18px] font-medium text-[#1e1d1d] tracking-[-0.36px]">{{ auth()->user()->name }}</h3>
                    <img alt="verified user" class="w-[18px] h-[18px]" src="{{ asset('images/verified_user.svg') }}">
                </div>
                <p class="text-[14px] font-medium text-[#1e1d1d] leading-[1.5]">
                    {{ auth()->user()->email }} • verified
                </p>
            </div>
        </div>
        <hr class="my-[16px] border-[#e8e8e7]">
        <p class="px-[24px] text-[16px] leading-[1.5] text-[#464646] max-w-[519px]">
            {{ auth()->user()->bio ?? 'Tell property managers about yourself...' }}
        </p>
    </div>

    {{-- Action Buttons --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-[16px] mt-[16px]">
        <button @click="$dispatch('open-edit-bio-modal')" class="h-[76px] bg-white border border-[#e8e8e7] rounded-[6px] px-6 py-[26px] flex justify-between items-center w-full hover:bg-gray-50 transition-colors">
            <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Edit bio</span>
            <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
        </button>
        <button @click="$dispatch('open-profile-photo-modal')" class="h-[76px] bg-white border border-[#e8e8e7] rounded-[6px] px-6 py-[26px] flex justify-between items-center w-full hover:bg-gray-50 transition-colors">
            <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Change profile picture</span>
            <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
        </button>
    </div>
</div>

