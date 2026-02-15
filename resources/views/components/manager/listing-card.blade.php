@props(['listing'])

<div class="bg-white border border-light-gray rounded-lg shadow-sm">
    @if($listing->is_boosted)
    <div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white text-sm px-4 py-2 rounded-t-lg flex items-center space-x-2">
        <img src="{{ asset('images/bolt.svg') }}" alt="Boosted" class="h-4 w-4">
        <span>10x boosted for 3 more days</span>
    </div>
    @endif

    <div class="p-4">
        <div class="flex items-start space-x-4">
            <img src="{{ $listing->images->first()?->image_url ?? asset('images/placeholder_image_1.png') }}" alt="{{ $listing->name }}" class="w-20 h-20 object-cover rounded-md">
            <div class="flex-1">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="text-lg font-medium text-black">{{ $listing->name }}</h3>
                        <p class="text-sm text-gray-600">{{ $listing->address }}</p>
                    </div>
                    <button>
                        <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                    </button>
                </div>
                <div class="flex items-center space-x-2 mt-2">
                    <span class="text-base font-medium text-black">AED {{ number_format($listing->price) }}</span>
                    <span class="text-xs text-gray-500">{{ $listing->payment_option }}</span>
                </div>
            </div>
        </div>

        <hr class="my-4">

        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4 text-sm text-gray-600">
                <div class="flex items-center space-x-1">
                    <img src="{{ asset('images/visibility.svg') }}" alt="Views" class="h-4 w-4">
                    <span>{{ $listing->views ?? 0 }}</span>
                </div>
                <div class="flex items-center space-x-1">
                    <img src="{{ asset('images/chat_light.svg') }}" alt="Messages" class="h-4 w-4">
                    <span>{{ $listing->messages ?? 0 }}</span>
                </div>
            </div>

            <div class="flex items-center space-x-2">
                <a href="#" class="text-sm font-medium text-electric-blue">View</a>
                <a href="#" class="text-sm font-medium text-gray-700">Edit</a>

                @if($listing->status === 'Active')
                    <span class="bg-like-green text-white text-xs font-medium px-3 py-1 rounded-full flex items-center space-x-1">
                        <img src="{{ asset('images/checkmark.svg') }}" alt="Active" class="h-3 w-3">
                        <span>Active</span>
                    </span>
                @elseif($listing->status === 'In review')
                    <span class="bg-yellow-400 text-black text-xs font-medium px-3 py-1 rounded-full">In review</span>
                @elseif($listing->status === 'Declined')
                    <span class="bg-red-500 text-white text-xs font-medium px-3 py-1 rounded-full">Declined</span>
                @else
                    <span class="bg-gray-200 text-gray-700 text-xs font-medium px-3 py-1 rounded-full">{{ $listing->status }}</span>
                @endif
            </div>
        </div>
    </div>
</div>
