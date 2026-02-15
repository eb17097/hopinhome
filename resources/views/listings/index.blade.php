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
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                    @foreach($listings as $listing)
                        <x-listings.listing-card :listing="$listing" />
                    @endforeach
                </div>
                <div class="mt-8">
                    <a href="{{ route('listings.create') }}" class="bg-electric-blue text-white font-medium px-8 py-3 rounded-md flex items-center justify-center space-x-2 hover:bg-blue-700 transition w-full">
                        <img alt="add" class="h-4 w-4" src="{{ asset('images/add.svg') }}">
                        <span>Create a new listing</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
    <x-listings.listing-mobile-navbar />
    <x-footer />
</x-manager-layout>