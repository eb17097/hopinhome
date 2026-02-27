@props(['user'])

<div class="flex items-start gap-6 relative">
    {{-- Profile Photo --}}
    <div class="w-[126px] h-[126px] rounded-full border-2 border-light-gray overflow-hidden flex-shrink-0">
        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
    </div>

    {{-- Info --}}
    <div class="flex flex-col pt-2">
        <div class="flex items-center gap-2 mb-1">
            <h1 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px]">{{ $user->name }}</h1>
            <img src="{{ asset('images/verified_user.svg') }}" alt="Verified" class="w-[23px] h-[23px]">
        </div>
        <p class="text-[14px] text-[#464646]">{{ $user->role }} • License no. {{ $user->license_number }}</p>
    </div>

    {{-- Flag/Report --}}
    <button class="absolute top-0 right-0">
        <img src="{{ asset('images/flag.svg') }}" alt="Report" class="w-[25px] h-[25px]">
    </button>
</div>
