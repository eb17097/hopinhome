<x-property-manager-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Property Manager Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                                {{-- Left Column (Wider) --}}
                                <div class="lg:col-span-8 space-y-8">
                                    <div>
                                        <div class="flex items-center space-x-2 mb-4">
                                            <img src="{{ asset('images/speed.svg') }}" alt="Dashboard Icon" class="w-[30px] h-[30px]">
                                            <h2 class="text-[22px] font-medium text-black">Dashboard</h2>
                                        </div>

                                        <div class="bg-white border border-light-gray rounded-[8px] shadow-[0px_2px_8px_0px_rgba(0,0,0,0.04)] p-6">
                                            <div class="flex justify-between items-center mb-6">
                                                <div class="flex items-baseline space-x-2">
                                                    <h3 class="text-[18px] font-medium text-[#1e1d1d]">Analytics</h3>
                                                    <span class="text-[14px] text-[#464646]">Last 7 days</span>
                                                </div>
                                                <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow" class="w-[18px] h-[18px] brightness-0 opacity-70">
                                            </div>

                                            <div class="grid grid-cols-3 gap-6">
                                                <!-- Listing Views Card -->
                                                <div class="border border-light-gray rounded-[6px] p-4 h-[96px] flex flex-col justify-between relative overflow-hidden" style="background: radial-gradient(117.68% 96% at 0% 100%, rgba(16, 168, 16, 0.05) 0%, rgba(16, 168, 16, 0) 100%), #fff;">
                                                    <p class="text-[14px] text-[#464646]">Listing views</p>
                                                    <div class="flex items-end justify-between">
                                                        <span class="text-[32px] font-medium text-[#1e1d1d] leading-none">310</span>
                                                        <span class="bg-like-green text-white text-[12px] font-medium px-2 py-0.5 rounded-[3px]">+24%</span>
                                                    </div>
                                                </div>
                                                <!-- Profile Views Card -->
                                                <div class="border border-light-gray rounded-[6px] p-4 h-[96px] flex flex-col justify-between relative overflow-hidden" style="background: radial-gradient(117.68% 96% at 0% 100%, rgba(16, 168, 16, 0.05) 0%, rgba(16, 168, 16, 0) 100%), #fff;">
                                                    <p class="text-[14px] text-[#464646]">Profile views</p>
                                                    <div class="flex items-end justify-between">
                                                        <span class="text-[32px] font-medium text-[#1e1d1d] leading-none">21</span>
                                                        <span class="bg-like-green text-white text-[12px] font-medium px-2 py-0.5 rounded-[3px]">+43%</span>
                                                    </div>
                                                </div>
                                                <!-- Message Requests Card -->
                                                <div class="border border-light-gray rounded-[6px] p-4 h-[96px] flex flex-col justify-between relative overflow-hidden" style="background: radial-gradient(117.68% 96% at 0% 100%, rgba(237, 7, 7, 0.05) 0%, rgba(237, 7, 7, 0) 100%), #fff;">
                                                    <p class="text-[14px] text-[#464646]">Message requests</p>
                                                    <div class="flex items-end justify-between">
                                                        <span class="text-[32px] font-medium text-[#1e1d1d] leading-none">21</span>
                                                        <span class="bg-[#ed0707] text-white text-[12px] font-medium px-2 py-0.5 rounded-[3px]">-6%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- My listings section -->
                                    <div>
                                        @php
                                            $listings = Auth::user()->listings()->latest()->get(); // Fetch actual listings
                                        @endphp

                                        @if($listings->isNotEmpty())
                                            <div class="bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] overflow-hidden">
                                                {{-- Header --}}
                                                <div class="px-6 py-4 border-b border-light-gray flex justify-between items-center">
                                                    <h3 class="text-[18px] font-medium text-[#1e1d1d]">My listings</h3>
                                                    <a href="{{ route('property_manager.listings.index') }}">
                                                        <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow Forward" class="w-[18px] h-[18px] brightness-0 opacity-70">
                                                    </a>
                                                </div>

                                                {{-- Listing Rows --}}
                                                <div>
                                                    @foreach($listings as $listing)
                                                        <x-property_manager.property-manager-listing-card :listing="$listing" />
                                                    @endforeach
                                                </div>

                                                {{-- Footer --}}
                                                <div class="p-6 border-t border-light-gray">
                                                    <a href="{{ route('property_manager.listings.index') }}" class="w-full border border-light-gray rounded-[6px] py-4 flex justify-center items-center text-[18px] font-medium text-[#1e1d1d] hover:bg-gray-50 transition-colors">
                                                        View all listings
                                                    </a>
                                                </div>
                                            </div>
                                        @else
                                            <x-listings.empty-listings-state />
                                        @endif
                                    </div>

                                    <div class="flex gap-8">
                                        <x-property_manager.property-manager-listing-credits />

                                        <x-property_manager.property-manager-boost-credits />
                                    </div>

                                    <x-property_manager.property-manager-reviews />

                                    <x-property_manager.property-manager-current-plan />
                                </div>

                                {{-- Right Column (Sticky) --}}
                                <div class="lg:col-span-4 space-y-8 sticky top-8">
                                    <x-property_manager.property-manager-profile-summary />

                                    <x-property_manager.property-manager-setup-checklist />
                                </div>
            </div>
        </div>
    </div>
</x-property-manager-layout>
