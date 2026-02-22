<x-renter-layout>
    <x-header />
    <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
        <div class="flex">
            <div class="w-1/4">
                <x-renter.renter-sidebar />
            </div>
            <div class="w-3/4 pl-12">
                <a href="{{ route('renter.index') }}" class="inline-flex items-center text-navy-blue text-base font-medium mb-4">
                    <img alt="arrow forward" class="h-5 w-5 transform rotate-180 mr-2" src="{{ asset('images/arrow_forward_dark_blue.svg') }}">
                    Back to dashboard
                </a>
                <h2 class="text-3xl font-medium text-black tracking-tight mb-6">
                    My listings
                </h2>

                <!-- Session Status -->
                @if(session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif
                
                <x-listings.listing-filter-buttons />

                {{-- Conditional rendering based on whether listings exist --}}
                @if($listings->isEmpty())
                    <x-listings.empty-listings-state />
                @else
                    {{-- Display listings here --}}
                    <div class="space-y-6 mt-8">
                    @foreach($listings as $listing)
                        <x-renter.renter-listing-card :listing="$listing" />
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
</x-renter-layout>