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
                                        <div class="space-y-6">
                                            @php
                                                $listings = Auth::user()->listings()->latest()->get(); // Fetch actual listings
                                            @endphp
                                            @forelse($listings as $listing)
                                                <div class="flex justify-between items-center mb-6">
                                                    <h2 class="text-2xl font-medium text-black tracking-tight">My listings</h2>
                                                    <a href="{{ route('property_manager.index') }}" class="text-sm font-medium text-electric-blue hover:underline">View all listings</a>
                                                </div>
                                                <x-property_manager.property-manager-listing-card :listing="$listing" />
                                            @empty
                                                <x-listings.empty-listings-state />
                                            @endforelse
                                        </div>
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
