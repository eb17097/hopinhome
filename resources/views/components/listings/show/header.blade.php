@props(['listing'])

<div>
    <!-- Breadcrumbs -->
    <nav class="text-sm mb-4">
        <a href="/" class="text-gray-500 hover:text-gray-700">Home</a>
        <span class="text-gray-400 mx-2">/</span>
        <a href="{{ route('listings.index') }}" class="text-gray-500 hover:text-gray-700">Listings</a>
        <span class="text-gray-400 mx-2">/</span>
        <span class="text-gray-700">{{ $listing->name }}</span>
    </nav>

    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-medium text-black tracking-tight">{{ $listing->name }}</h1>
            <p class="text-base text-gray-600 mt-1">{{ $listing->address }}</p>
        </div>
        <div class="flex items-center space-x-4">
            <button class="p-2 rounded-full hover:bg-gray-100">
                <img src="{{ asset('images/share.svg') }}" alt="Share" class="w-6 h-6">
            </button>
            <button class="p-2 rounded-full hover:bg-gray-100">
                <img src="{{ asset('images/favorite.svg') }}" alt="Favorite" class="w-6 h-6">
            </button>
            <button class="p-2 rounded-full hover:bg-gray-100">
                <img src="{{ asset('images/flag.svg') }}" alt="Report" class="w-6 h-6">
            </button>
        </div>
    </div>
</div>
