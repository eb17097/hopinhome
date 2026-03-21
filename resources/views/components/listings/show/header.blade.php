@props(['listing', 'isPreview' => false])

<div x-data="{}" class="flex justify-between items-end mb-[24px] space-x-4">
    <div class="min-w-0">
        <h1 class="text-[32px] font-medium text-black tracking-[-0.64px] leading-[1.28] truncate" title="{{ $listing->name }}">{{ $listing->name }}</h1>
    </div>
    @if(!$isPreview)
        <div class="flex items-center space-x-[20px]">
            <button
                @click="$dispatch('open-modal', 'report-listing')"
                class="p-[4px] rounded-full hover:bg-gray-100 flex items-center justify-center transition-colors"
            >
                <img src="{{ asset('images/flag.svg') }}" alt="Report" class="w-[25px] h-[25px]">
            </button>
            <button
                @click="$dispatch('open-modal', 'share-listing')"
                class="p-[4px] rounded-full hover:bg-gray-100 flex items-center justify-center transition-colors"
            >
                <img src="{{ asset('images/share.svg') }}" alt="Share" class="w-[25px] h-[25px]">
            </button>
            <button class="p-[4px] rounded-full hover:bg-gray-100 flex items-center justify-center">
                <img src="{{ asset('images/favorite.svg') }}" alt="Favorite" class="w-[25px] h-[25px]">
            </button>
        </div>
    @endif
</div>
