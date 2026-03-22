@props(['listing'])
@php
    $user = auth()->user();
    $isOwner = $user->isBusinessOwner();
@endphp

<a href="{{ $listing->status === 'Draft' ? route('property_manager.listings.preview', $listing) : route('listings.show', $listing) }}" class="px-[24px] py-[12px] border-b border-light-gray last:border-b-0 flex items-center justify-between group hover:bg-gray-50/50 transition-colors block">
    <div class="flex items-center space-x-[16px] min-w-0 pr-[16px] {{ $isOwner ? 'w-[320px]' : 'w-[440px]' }}">
        {{-- Thumbnail --}}
        <div class="w-[85px] h-[85px] rounded-[4px] overflow-hidden border border-light-gray shrink-0 relative">
            <img src="{{ $listing->images->first()?->image_url ?? asset('images/placeholder.png') }}" alt="{{ $listing->name }}" class="w-full h-full object-cover">
            @if($listing->is_boosted && $isOwner)
                <div class="absolute top-1 left-1 bg-[#122557] rounded-[4px] px-1.5 py-0.5 flex items-center space-x-1">
                    <img src="{{ asset('images/bolt.svg') }}" class="w-3 h-3 brightness-0 invert" alt="">
                    <span class="text-white text-[10px] font-medium">Boosted</span>
                </div>
            @endif
        </div>

        {{-- Info --}}
        <div class="min-w-0">
            <h3 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.28] truncate" title="{{ $listing->name ?: 'New listing' }}">{{ $listing->name ?: 'New listing' }}</h3>
            <div class="flex items-baseline mt-[2px]">
                <span class="text-[16px] font-medium text-[#1e1d1d]">AED {{ number_format($listing->price) }} <span class="text-[#464646] font-normal">{{ $listing->payment_option }}</span></span>
            </div>
            @if($listing->is_boosted && !$isOwner)
                <div class="mt-1 inline-flex items-center space-x-1 bg-[#122557] rounded-full px-2 py-0.5">
                    <img src="{{ asset('images/bolt.svg') }}" class="w-3 h-3 brightness-0 invert" alt="">
                    <span class="text-white text-[11px] font-medium">Boosted</span>
                </div>
            @endif
        </div>
    </div>

    {{-- Agent Column (Owner only) --}}
    @if($isOwner)
        <div class="flex items-center space-x-2 w-[200px] shrink-0">
            <div class="w-8 h-8 rounded-full border border-light-gray overflow-hidden shrink-0">
                <img src="{{ $listing->user->profile_photo_url ?? asset('images/user-placeholder.svg') }}" alt="" class="w-full h-full object-cover">
            </div>
            <div class="flex items-center space-x-1 min-w-0">
                <span class="text-[15px] font-medium text-[#1e1d1d] truncate">{{ $listing->user->name }}</span>
                @if($listing->user->email_verified_at)
                    <img src="{{ asset('images/verified_user.svg') }}" alt="Verified" class="w-4 h-4 shrink-0">
                @endif
            </div>
        </div>
    @endif

    <div class="flex items-center space-x-[40px]">
        {{-- Stats --}}
        <div class="flex items-center space-x-8">
            <div class="flex items-center space-x-[3px]">
                <img src="{{ asset('images/visibility_dark.svg') }}" alt="Views" class="w-4 h-4">
                <span class="text-[15px] text-[#1e1d1d] font-medium">{{ $listing->views_count }}</span>
            </div>
            <div class="flex items-center space-x-[3px]">
                <img src="{{ asset('images/chat_dark.svg') }}" alt="Messages" class="w-4 h-4">
                <span class="text-[15px] text-[#1e1d1d] font-medium">{{ $listing->comments_count }}</span>
            </div>
        </div>

        {{-- Status Badge --}}
        <div class="w-[120px] flex justify-end">
            @if($listing->status === 'In review')
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
