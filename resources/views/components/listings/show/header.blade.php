@props(['listing'])

<div class="mb-8">
    <div class="flex justify-between items-center mb-4">
        <div>
            <div class="flex items-center text-sm text-gray-500">
                <a href="{{ route('listings.index') }}" class="hover:text-gray-700">Dubai</a>
                <span class="mx-2">/</span>
                <a href="#" class="hover:text-gray-700">Apartments for Rent</a>
                <span class="mx-2">/</span>
                <span>{{ $listing->title }}</span>
            </div>
            <h1 class="text-3xl font-medium text-gray-900 mt-2">{{ $listing->title }}</h1>
        </div>
        <div class="flex items-center space-x-4">
            <button>
                <img src="{{ asset('images/share.svg') }}" alt="Share" class="w-6 h-6">
            </button>
            <button>
                <img src="{{ asset('images/favorite.svg') }}" alt="Favorite" class="w-6 h-6">
            </button>
            <button>
                <img src="{{ asset('images/flag_2.svg') }}" alt="Report" class="w-6 h-6">
            </button>
        </div>
    </div>
</div>
