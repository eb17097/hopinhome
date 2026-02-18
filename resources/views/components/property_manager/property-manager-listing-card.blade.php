@props(['listing'])

<div class="px-6 py-5 border-b border-light-gray last:border-b-0 flex items-center justify-between group hover:bg-gray-50/50 transition-colors">
    <div class="flex items-center space-x-4">
        {{-- Thumbnail --}}
        <div class="w-[69px] h-[69px] rounded-[4px] overflow-hidden border border-light-gray shrink-0">
            <img src="{{ $listing->images->first()?->image_url ?? asset('images/placeholder_image_1.png') }}" alt="{{ $listing->name }}" class="w-full h-full object-cover">
        </div>

        {{-- Info --}}
        <div>
            <h3 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.28]">{{ $listing->name }}</h3>
            <div class="flex items-baseline space-x-1 mt-1">
                <span class="text-[16px] font-medium text-[#1e1d1d]">AED {{ number_format($listing->price) }}</span>
                <span class="text-[14px] text-[#464646]">Yearly</span>
            </div>
        </div>
    </div>

    <div class="flex items-center space-x-12">
        {{-- Stats --}}
        <div class="flex items-center space-x-8">
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/visibility.svg') }}" alt="Views" class="w-4 h-4 opacity-70">
                <span class="text-[14px] text-[#1e1d1d]">{{ $listing->views_count }}</span>
            </div>
            <div class="flex items-center space-x-2">
                <img src="{{ asset('images/chat_light.svg') }}" alt="Messages" class="w-4 h-4 opacity-70">
                <span class="text-[14px] text-[#1e1d1d]">{{ $listing->comments_count }}</span>
            </div>
        </div>

        {{-- Status Badge --}}
        <div class="w-[120px] flex justify-end">
            @if($listing->is_boosted)
                <div class="bg-[#122557] text-white text-[14px] font-medium px-4 py-1.5 rounded-full flex items-center space-x-1">
                    <img src="{{ asset('images/bolt.svg') }}" alt="Boosted" class="h-3 w-3 brightness-0 invert">
                    <span>Boosted</span>
                </div>
            @elseif($listing->status === 'In review')
                <div class="bg-[#ffd900] text-[#1e1d1d] text-[14px] font-medium px-4 py-1.5 rounded-full flex items-center space-x-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>In review</span>
                </div>
            @elseif($listing->status === 'Active')
                <div class="bg-like-green text-white text-[14px] font-medium px-4 py-1.5 rounded-full flex items-center space-x-1">
                    <img src="{{ asset('images/checkmark.svg') }}" alt="Active" class="h-3 w-3 brightness-0 invert">
                    <span>Active</span>
                </div>
            @else
                <div class="bg-gray-200 text-gray-700 text-[14px] font-medium px-4 py-1.5 rounded-full">
                    {{ $listing->status }}
                </div>
            @endif
        </div>
    </div>
</div>
