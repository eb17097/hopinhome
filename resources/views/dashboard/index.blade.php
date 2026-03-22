<x-professional-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ Auth::user()->isBusinessOwner() ? __('Business Owner Dashboard') : __('Property Manager Dashboard') }}
        </h2>
    </x-slot>

    <div>
        <div class="mx-auto">
            <div class="flex gap-[35px]">
                {{-- Left Column (Wider) --}}
                <div class="w-[768px] space-y-[24px] pl-[24px] pt-[24px] pb-[112px]">
                    {{-- 1. Analytics (Shared) --}}
                    <div>
                        <div class="flex items-center space-x-2 mb-[21px]">
                            <img src="{{ asset('images/speed.svg') }}" alt="Dashboard Icon" class="w-[30px] h-[30px]">
                            <h2 class="text-[22px] font-medium text-[#1E1D1D]">Dashboard</h2>
                        </div>
                        <x-dashboard.analytics />
                    </div>

                    {{-- 2. My Listings (Shared) --}}
                    <div>
                        @if($listings->isNotEmpty())
                            <div class="bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] overflow-hidden">
                                {{-- Header --}}
                                <div class="px-[24px] py-[20px] border-b border-light-gray flex justify-between items-center">
                                    <h3 class="text-[18px] font-medium text-[#1e1d1d]">{{ Auth::user()->isBusinessOwner() ? __('Listings') : __('My listings') }}</h3>
                                    @php
                                        $listingsRoute = Auth::user()->isPropertyManager() ? route('property_manager.listings.index') : '#';
                                    @endphp
                                    <a href="{{ $listingsRoute }}">
                                        <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow Forward" class="w-[18px] h-[18px] brightness-0 opacity-70">
                                    </a>
                                </div>

                                {{-- Listing Rows --}}
                                <div>
                                    @foreach($listings as $listing)
                                        <x-dashboard.listing-card :listing="$listing" />
                                    @endforeach
                                </div>

                                {{-- Footer --}}
                                <div class="p-6 border-t border-light-gray">
                                    <a href="{{ $listingsRoute }}" class="leading-[1.18] tracking-[-0.48px] h-[51px] w-full border border-light-gray rounded-[6px] py-4 flex justify-center items-center text-[16px] font-medium text-[#1e1d1d] hover:bg-gray-50 transition-colors">
                                        View all listings
                                    </a>
                                </div>
                            </div>
                        @else
                            <x-listings.empty-listings-state />
                        @endif
                    </div>

                    {{-- Role-Specific Sequence --}}
                    @if(Auth::user()->isBusinessOwner())
                        {{-- 3. Agents (Owner) --}}
                        <x-business_owner.agents-block />
                        
                        {{-- 4. Credits (Owner) --}}
                        <div class="bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)]">
                            <div class="px-6 py-[11px] border-b border-light-gray flex justify-between items-center">
                                <h2 class="text-[18px] font-medium leading-[1.28] tracking-[-0.36px] text-[#1e1d1d]">Credits</h2>
                                <button class="min-w-[160px] h-[40px] px-[18px] border border-light-gray rounded-full text-[16px] leading-[1.5] font-medium text-[#1e1d1d] hover:bg-gray-50 transition">
                                    Show details
                                </button>
                            </div>
                            <div class="p-6">
                                <div class="flex gap-[16px] mb-[20px]">
                                    <x-dashboard.listing-credits />
                                    <x-dashboard.boost-credits />
                                </div>
                                <p class="text-center text-[14px] text-[#464646]">
                                    Credits reset automatically every billing cycle <span class="font-medium text-[#1e1d1d]">on the 15th.</span>
                                </p>
                            </div>
                        </div>
                    @else
                        {{-- 3. Credits (Manager) --}}
                        <div class="bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)]">
                            <div class="px-6 py-[11px] border-b border-light-gray flex justify-between items-center">
                                <h2 class="text-[18px] font-medium leading-[1.28] tracking-[-0.36px] text-[#1e1d1d]">Credits</h2>
                                <button class="min-w-[160px] h-[40px] px-[18px] border border-light-gray rounded-full text-[16px] leading-[1.5] font-medium text-[#1e1d1d] hover:bg-gray-50 transition">
                                    Show details
                                </button>
                            </div>
                            <div class="p-6">
                                <div class="flex gap-[16px] mb-[20px]">
                                    <x-dashboard.listing-credits />
                                    <x-dashboard.boost-credits />
                                </div>
                                <p class="text-center text-[14px] text-[#464646]">
                                    Credits reset automatically every billing cycle <span class="font-medium text-[#1e1d1d]">on the 15th.</span>
                                </p>
                            </div>
                        </div>

                        {{-- 4. Reviews (Manager) --}}
                        <x-dashboard.reviews />
                    @endif

                    {{-- 5. Current Plan (Shared) --}}
                    <x-dashboard.current-plan />
                </div>

                {{-- Right Column (Sticky) --}}
                <div class="min-w-[358px] space-y-[24px] mt-[77px]">
                    <x-dashboard.profile-summary />
                    <x-dashboard.setup-checklist />
                </div>
            </div>
        </div>
    </div>
</x-professional-layout>
