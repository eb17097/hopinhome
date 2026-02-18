@php use Illuminate\Support\Facades\Auth; @endphp

<div class="bg-white border border-light-gray rounded-lg shadow-sm p-6">
    <div class="flex items-start space-x-4">
        <div class="w-16 h-16 rounded-full border border-light-gray overflow-hidden">
            <img alt="profile picture" class="h-full w-full object-cover" src="{{ Auth::user()->profile_photo_url ?? asset('images/profile_picture.png') }}">
        </div>
        <div class="ml-4">
            <div class="flex items-center gap-2">
                <h3 class="text-lg font-medium text-black">{{ Auth::user()->name }}</h3>
                <img alt="verified user" class="h-5 w-5" src="{{ asset('images/verified_user.svg') }}">
            </div>
            <p class="text-sm font-medium text-gray-600">
                {{ Auth::user()->email }} • verified
            </p>
        </div>
    </div>
    <hr class="my-4 border-light-gray">
    <div class="grid grid-cols-1 gap-6">
        <a href="{{ route('profile.edit') }}" class="bg-white border border-light-gray rounded-lg p-6 flex justify-between items-center">
            <span class="text-base font-medium text-black">Edit bio</span>
            <img alt="arrow forward" class="h-5 w-5" src="{{ asset('images/arrow_forward_black.svg') }}">
        </a>
        <a href="#" class="bg-white border border-light-gray rounded-lg p-6 flex justify-between items-center">
            <span class="text-base font-medium text-black">Change profile picture</span>
            <img alt="arrow forward" class="h-5 w-5" src="{{ asset('images/arrow_forward_black.svg') }}">
        </a>
    </div>
</div>