@props(['listing'])

<div class="bg-white border border-light-gray rounded-lg shadow-sm">
    @if($listing->boosted)
    <div class="bg-gradient-to-r from-navy-blue to-electric-blue text-white text-sm font-medium px-4 py-2 rounded-t-lg flex items-center space-x-2">
        <img alt="bolt" class="h-4 w-4" src="{{ asset('images/bolt.svg') }}">
        <span>10x boosted for 3 more days</span>
    </div>
    @endif
    <div class="p-4">
        <div class="flex space-x-4">
            <img src="{{ $listing->image_url ?? asset('images/placeholder_image_4.png') }}" alt="{{ $listing->title }}" class="w-20 h-20 object-cover rounded-md">
            <div>
                <h3 class="text-lg font-medium text-black">{{ $listing->title }}</h3>
                <p class="text-sm text-gray-600">{{ $listing->city }}</p>
                <p class="text-base font-bold text-electric-blue mt-1">${{ number_format($listing->price) }} <span class="text-xs font-normal text-gray-600">Yearly</span></p>
            </div>
        </div>
        <hr class="my-4 border-light-gray">
        <div class="flex justify-between items-center">
            <div class="flex space-x-4">
                <div class="flex items-center space-x-1">
                    <img alt="visibility" class="h-4 w-4" src="{{ asset('images/visibility_black.svg') }}">
                    <span class="text-sm font-medium text-black">357</span>
                </div>
                <div class="flex items-center space-x-1">
                    <img alt="chat" class="h-4 w-4" src="{{ asset('images/chat_black.svg') }}">
                    <span class="text-sm font-medium text-black">13</span>
                </div>
            </div>
            <div class="px-3 py-1 rounded-full text-sm font-medium
                @switch($listing->status)
                    @case('Active')
                        bg-green-100 text-green-800
                        @break
                    @case('In review')
                        bg-yellow-100 text-yellow-800
                        @break
                    @case('Draft')
                        bg-gray-100 text-gray-800
                        @break
                    @case('Expired')
                        bg-gray-100 text-gray-800
                        @break
                    @case('Declined')
                        bg-red-100 text-red-800
                        @break
                @endswitch
            ">
                {{ $listing->status }}
            </div>
        </div>
    </div>
</div>