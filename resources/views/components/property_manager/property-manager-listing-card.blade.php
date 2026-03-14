@props(['listing'])

<a href="{{ route('listings.show', $listing) }}" class="px-[24px] py-[12px] border-b border-light-gray last:border-b-0 flex items-center justify-between group hover:bg-gray-50/50 transition-colors block">
    <div class="flex items-center space-x-[16px] min-w-0 pr-[16px] w-[440px]">
        {{-- Thumbnail --}}
        <div class="w-[85px] h-[85px] rounded-[4px] overflow-hidden border border-light-gray shrink-0">
            <img src="{{ $listing->images->first()?->image_url ?? asset('images/placeholder.png') }}" alt="{{ $listing->name }}" class="w-full h-full object-cover">
        </div>

        {{-- Info --}}
        <div class="min-w-0">
            <h3 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.28] truncate" title="{{ $listing->name }}">{{ $listing->name }}</h3>
            <div class="flex items-baseline mt-[2px]">
                <span class="text-[16px] font-medium text-[#1e1d1d]">AED {{ number_format($listing->price) }} <span class="text-[#464646] font-normal">{{ $listing->payment_option }}</span></span>
            </div>
        </div>
    </div>

    <div class="flex items-center space-x-[40px]">
        {{-- Stats --}}
        <div class="flex items-center space-x-8">
            <div class="flex items-center space-x-[3px]">
                <img src="{{ asset('images/visibility_dark.svg') }}" alt="Views" class="w-4 h-4">
                <span class="text-[15px] text-[#1e1d1d] font-medium">{{ $listing->views_count }}357</span>
            </div>
            <div class="flex items-center space-x-[3px]">
                <img src="{{ asset('images/chat_dark.svg') }}" alt="Messages" class="w-4 h-4">
                <span class="text-[15px] text-[#1e1d1d] font-medium">{{ $listing->comments_count }}16</span>
            </div>
        </div>

        {{-- Status Badge --}}
        <div class="w-[120px] flex justify-end">
            @if($listing->is_boosted)
                <div class="h-[26px] bg-[#122557] text-white text-[14px] font-medium px-[12px] rounded-full flex items-center space-x-[2px]">
                    <img src="{{ asset('images/bolt.svg') }}" alt="Boosted" class="h-[15px] w-[15px] brightness-0 invert">
                    <span>Boosted</span>
                </div>
            @elseif($listing->status === 'In review')
                <div class="h-[26px] bg-[#ffd900] text-[#1e1d1d] text-[14px] font-medium px-[12px] rounded-full flex items-center space-x-[2px]">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>In review</span>
                </div>
            @elseif($listing->status === 'Active')
                <div class="h-[26px] bg-like-green text-white text-[14px] font-medium px-[12px] rounded-full flex items-center space-x-[2px]">
                    <img src="{{ asset('images/checkmark.svg') }}" alt="Active" class="h-[18px] w-[18px] brightness-0 invert">
                    <span>Active</span>
                </div>
            @else
                <div class="h-[26px] bg-gray-200 text-gray-700 text-[14px] font-medium px-[12px] rounded-full flex items-center space-x-[2px]">
                    {{ $listing->status }}
                </div>
            @endif
        </div>
    </div>
</a>
