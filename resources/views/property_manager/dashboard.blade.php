<x-property-manager-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Property Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-8">
                <div>
                    <div class="flex items-center space-x-2 mb-6">
                        <img src="{{ asset('images/speed.svg') }}" alt="Dashboard Icon" class="w-[30px] h-[30px]">
                        <h2 class="text-[22px] font-medium text-black">Dashboard</h2>
                    </div>

                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-medium text-black">Analytics</h3>
                            <span class="text-sm text-gray-500">Last 7 days</span>
                        </div>

                        <div class="grid grid-cols-3 gap-6">
                            <!-- Listing Views Card -->
                            <div class="bg-white border border-light-gray rounded-lg shadow-sm p-4">
                                <p class="text-sm text-gray-600">Listing views</p>
                                <div class="flex items-end justify-between mt-1">
                                    <span class="text-3xl font-medium text-black">310</span>
                                    <span class="bg-like-green text-white text-xs font-medium px-2 py-0.5 rounded-full">+24%</span>
                                </div>
                            </div>
                            <!-- Profile Views Card -->
                            <div class="bg-white border border-light-gray rounded-lg shadow-sm p-4">
                                <p class="text-sm text-gray-600">Profile views</p>
                                <div class="flex items-end justify-between mt-1">
                                    <span class="text-3xl font-medium text-black">21</span>
                                    <span class="bg-like-green text-white text-xs font-medium px-2 py-0.5 rounded-full">+43%</span>
                                </div>
                            </div>
                            <!-- Message Requests Card -->
                            <div class="bg-white border border-light-gray rounded-lg shadow-sm p-4">
                                <p class="text-sm text-gray-600">Message requests</p>
                                <div class="flex items-end justify-between mt-1">
                                    <span class="text-3xl font-medium text-black">21</span>
                                    <span class="bg-red-500 text-white text-xs font-medium px-2 py-0.5 rounded-full">-6%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- My listings section -->
                <div>
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-medium text-black tracking-tight">My listings</h2>
                        <a href="{{ route('property_manager.listings.index') }}" class="text-sm font-medium text-electric-blue hover:underline">View all listings</a>
                    </div>
                    <div class="space-y-6">
                        @php
                            $listings = Auth::user()->listings()->latest()->get(); // Fetch actual listings
                        @endphp
                        @forelse($listings as $listing)
                            <x-property_manager.property-manager-listing-card :listing="$listing" />
                        @empty
                            <x-listings.empty-listings-state />
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-property-manager-layout>