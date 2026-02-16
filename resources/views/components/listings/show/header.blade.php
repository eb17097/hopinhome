@props(['listing'])

<div class="flex justify-between items-end mb-[24px]">
    <div>
        <h1 class="text-[32px] font-medium text-black tracking-[-0.64px] leading-[1.28]">{{ $listing->name }}</h1>
        <p class="text-[14px] text-[#464646] leading-[1.5] mt-1">{{ $listing->address }}</p>
    </div>
    <div class="flex items-center space-x-[20px]">
        <button class="p-[4px] rounded-full hover:bg-gray-100 flex items-center justify-center">
            <img src="{{ asset('images/share.svg') }}" alt="Share" class="w-[25px] h-[25px]">
        </button>
        <button class="p-[4px] rounded-full hover:bg-gray-100 flex items-center justify-center">
            <img src="{{ asset('images/favorite.svg') }}" alt="Favorite" class="w-[25px] h-[25px]">
        </button>
        <button class="p-[4px] rounded-full hover:bg-gray-100 flex items-center justify-center">
            <img src="{{ asset('images/flag.svg') }}" alt="Report" class="w-[25px] h-[25px]">
        </button>
    </div>
</div>
