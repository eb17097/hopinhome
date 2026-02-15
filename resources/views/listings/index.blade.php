<x-manager-layout>
    <x-header />
    <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
        <div class="flex">
            <div class="w-1/4">
                <x-manager.sidebar />
            </div>
            <div class="w-3/4 pl-12">
                <a href="{{ route('dashboard') }}" class="inline-flex items-center text-navy-blue text-base font-medium mb-4">
                    <img alt="arrow forward" class="h-5 w-5 transform rotate-180 mr-2" src="{{ asset('images/arrow_forward_dark_blue.svg') }}">
                    Back to dashboard
                </a>
                <h2 class="text-3xl font-medium text-black tracking-tight mb-6">
                    My listings
                </h2>
                <x-listings.listing-filter-buttons />

                {{-- Conditional rendering based on whether listings exist --}}
                @if($listings->isEmpty())
                    <x-listings.empty-listings-state />
                @else
                    {{-- Display listings here --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                        @foreach($listings as $listing)
                            <div class="bg-white border border-light-gray rounded-lg shadow-sm p-4">
                                <h3 class="text-lg font-medium text-black">{{ $listing->title }}</h3>
                                <p class="text-sm text-gray-600">{{ $listing->city }}</p>
                                <p class="text-base font-bold text-electric-blue mt-2">${{ number_format($listing->price) }}</p>
                                <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}" class="w-full h-32 object-cover rounded-md mt-4">
                                <div class="flex justify-end mt-4">
                                    <a href="{{ route('listings.show', $listing) }}" class="text-electric-blue hover:underline text-sm font-medium">View Details</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    <x-listings.listing-mobile-navbar />
    <x-footer />
</x-manager-layout>