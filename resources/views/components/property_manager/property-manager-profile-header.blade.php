<div class="space-y-6">
    <div class="bg-off-white rounded-lg p-6">
        <div class="flex items-start">
            <div class="w-16 h-16 rounded-full border border-light-gray overflow-hidden">
                <img alt="profile picture" class="h-full w-full object-cover" src="{{ asset('images/profile_picture.png') }}">
            </div>
            <div class="ml-4">
                <div class="flex items-center gap-2">
                    <h3 class="text-lg font-medium text-black">Sarah Johnson</h3>
                    <img alt="verified user" class="h-5 w-5" src="{{ asset('images/verified_user.svg') }}">
                </div>
                <p class="text-sm font-medium text-gray-600">
                    sarah@example.com • verified
                </p>
            </div>
        </div>
        <hr class="my-4 border-light-gray">
        <p class="text-base text-gray-700">
            {{ Auth::user()->bio ?? 'Tell renters about yourself...' }}
        </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <button @click="$dispatch('open-edit-bio-modal')" class="bg-white border border-light-gray rounded-lg p-6 flex justify-between items-center w-full hover:bg-gray-50 transition-colors">
            <span class="text-base font-medium text-black">Edit bio</span>
            <img alt="arrow forward" class="h-5 w-5" src="{{ asset('images/arrow_forward_black.svg') }}">
        </button>
        <div class="bg-white border border-light-gray rounded-lg p-6 flex justify-between items-center">
            <span class="text-base font-medium text-black">Change profile picture</span>
            <button class="block cursor-pointer">
                <img alt="arrow forward" class="h-5 w-5" src="{{ asset('images/arrow_forward_black.svg') }}">
            </button>
        </div>
    </div>
</div>

