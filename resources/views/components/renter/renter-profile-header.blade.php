<div class="space-y-6">
    {{-- Profile Summary Card --}}
    <div class="bg-[#f9f9f8] rounded-[6px] p-8">
        <div class="flex items-start">
            <div class="w-16 h-16 rounded-full border border-light-gray overflow-hidden shrink-0">
                <img alt="profile picture" class="h-full w-full object-cover" src="{{ auth()->user()->profile_photo_url ?? asset('images/profile_picture.png') }}">
            </div>
            <div class="ml-4 pt-1">
                <div class="flex items-center gap-1">
                    <h3 class="text-[18px] font-medium text-[#1e1d1d] tracking-[-0.36px]">{{ auth()->user()->name }}</h3>
                    <img alt="verified user" class="w-[18px] h-[18px]" src="{{ asset('images/verified_user.svg') }}">
                </div>
                <p class="text-[14px] font-medium text-[#1e1d1d] leading-[1.5]">
                    {{ auth()->user()->email }} • verified
                </p>
            </div>
        </div>
        <hr class="my-6 border-[#e8e8e7]">
        <p class="text-[16px] leading-[1.5] text-[#464646] max-w-[519px]">
            I am a friendly professional relocating to Dubai. Non-smoker, no pets, and looking for a long-term rental close to work.
        </p>
    </div>

    {{-- Action Buttons --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="#" class="bg-white border border-[#e8e8e7] rounded-[6px] px-6 py-[26px] flex justify-between items-center w-full hover:bg-gray-50 transition-colors">
            <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Edit bio</span>
            <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
        </a>
        <button @click="$dispatch('open-profile-photo-modal')" class="bg-white border border-[#e8e8e7] rounded-[6px] px-6 py-[26px] flex justify-between items-center w-full hover:bg-gray-50 transition-colors">
            <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Change profile picture</span>
            <img alt="arrow forward" class="w-[18px] h-[18px]" src="{{ asset('images/arrow_forward_black.svg') }}">
        </button>
    </div>
</div>

