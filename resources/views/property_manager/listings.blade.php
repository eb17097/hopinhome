<x-property-manager-layout>
    <div class="px-6 py-[24px]">
        <div class="flex justify-between items-center mb-[24px]">
            <div class="flex items-center space-x-[10px]">
                <img src="{{ asset('images/apartment_black.svg') }}" alt="" class="w-[30px] h-[30px]">
                <h1 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] leading-[1.28]">My listings</h1>
            </div>
            <a href="{{ route('property_manager.listings.create') }}" class="bg-electric-blue text-white px-[32px] py-[10.5px] rounded-full flex items-center space-x-[6px] hover:opacity-90 transition-opacity">
                <img src="{{ asset('images/add.svg') }}" alt="" class="w-[17px] h-[17px] brightness-0 invert">
                <span class="text-[16px] font-medium tracking-[-0.48px] leading-[1.18]">Create a listing</span>
            </a>
        </div>

        <!-- Search and Filters -->
        <form action="{{ route('property_manager.listings.index') }}" method="GET" id="filter-form" class="mb-[16px]">
            <div class="flex items-end gap-[16px]">
                <div class="flex-1">
                    <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px] leading-[1.3]">Search</label>
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search listings by name" class="leading-[1.3] py-[12px] w-full h-[44px] px-[14px] border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] focus:outline-none focus:ring-1 focus:ring-electric-blue placeholder:text-[#464646] text-[15px]">
                    </div>
                </div>
                <div class="w-[163px]">
                    <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px] leading-[1.3]">Status</label>
                    <x-custom-select
                        name="status"
                        :options="array_merge(['All status' => 'All status'], array_combine($statuses, $statuses))"
                        :selected="request('status', 'All status')"
                    />
                </div>
                <div class="w-[163px]">
                    <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px] leading-[1.3]">Property type</label>
                    <x-custom-select
                        name="property_type"
                        :options="array_merge(['All types' => 'All types'], array_combine($propertyTypes, $propertyTypes))"
                        :selected="request('property_type', 'All types')"
                    />
                </div>
                <button type="submit" class="w-[180px] bg-electric-blue text-white h-[44px] px-[32px] rounded-[6px] font-medium tracking-[-0.48px] hover:opacity-90 transition-opacity text-[16px] border border-electric-blue">
                    Search
                </button>
            </div>

            <!-- Sorting and Count -->
            <div class="flex justify-between items-center mt-[24px]">
                <p class="text-[15px] font-medium text-[#1e1d1d] leading-[1.3]">
                    Showing {{ $listings->firstItem() ?? 0 }}-{{ $listings->lastItem() ?? 0 }} of {{ $listings->total() }} results
                </p>
                <div class="flex items-center space-x-[12px]">
                    <span class="text-[15px] font-medium text-[#1e1d1d] leading-[1.3]">Sort by</span>
                    <div class="w-[180px]">
                        <x-custom-select
                            name="sort"
                            height="h-[39px]"
                            :options="['latest' => 'Date created (Desc)', 'oldest' => 'Date created (Asc)']"
                            :selected="request('sort', 'latest')"
                            onchange="this.closest('form').submit()"
                        />
                    </div>
                </div>
            </div>
        </form>

        <!-- Table -->
        <div class="bg-white border border-light-gray rounded-[8px] shadow-[0px_2px_8px_0px_rgba(0,0,0,0.04)] overflow-hidden">
            <div class="bg-[#f9f9f8] border-b border-light-gray h-[50px] flex items-center px-[24px]">
                <div class="w-[450px] text-[14px] font-medium text-[#1e1d1d]">Property</div>
                <div class="w-[150px] text-[14px] font-medium text-[#1e1d1d]">Property type</div>
                <div class="w-[100px] text-[14px] font-medium text-[#1e1d1d]">Views</div>
                <div class="w-[100px] text-[14px] font-medium text-[#1e1d1d]">Messages</div>
                <div class="w-[150px] text-[14px] font-medium text-[#1e1d1d]">Status</div>
                <div class="w-[150px] text-[14px] font-medium text-[#1e1d1d]">Created</div>
                <div class="flex-1"></div>
            </div>

            @forelse($listings as $listing)
                <div class="border-b border-light-gray last:border-b-0 h-[124px] flex items-center px-[24px] group hover:bg-gray-50/50 transition-colors">
                    <div class="w-[450px] flex items-center space-x-[16px]">
                        <div class="w-[100px] h-[100px] rounded-[4px] overflow-hidden border border-light-gray shrink-0">
                            <img src="{{ $listing->images->first()?->image_url ?? asset('images/placeholder.png') }}" alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="space-y-[4px] min-w-0">
                            <h3 class="text-[16px] font-medium text-[#1e1d1d] truncate max-w-[300px] leading-[1.5]" title="{{ $listing->name ?? $listing->address }}">
                                {{ $listing->name ?? $listing->address }}
                            </h3>
                            <p class="text-[15px] font-medium text-[#1e1d1d] leading-[1.3]">
                                <span class="text-[#1e1d1d]">AED {{ number_format($listing->price) }}</span>
                                <span class="text-[#464646] font-normal"> Yearly</span>
                            </p>
                            @if($listing->is_boosted)
                                <div class="inline-flex items-center space-x-[4px] px-[12px] h-[26px] rounded-full text-[14px] font-medium text-white shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] mt-[8px]" style="background: linear-gradient(-29.56deg, #0a1739 0%, #122557 99.42%)">
                                    <img src="{{ asset('images/bolt.svg') }}" class="w-[14px] h-[14px] brightness-0 invert" alt="">
                                    <span>Boosted</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="w-[150px]">
                        <span class="bg-[#f9f9f8] px-[10px] py-[4px] rounded-[4px] text-[14px] text-[#464646] font-normal leading-[1.3]">
                            {{ $listing->property_type ?? 'Apartment' }}
                        </span>
                    </div>
                    <div class="w-[100px] text-[15px] text-[#464646] font-normal leading-[1.3]">
                        {{ $listing->views_count ?: '-' }}
                    </div>
                    <div class="w-[100px] text-[15px] text-[#464646] font-normal leading-[1.3]">
                        {{ $listing->comments_count ?: '-' }}
                    </div>
                    <div class="w-[150px]">
                        @if($listing->status === 'In review')
                            <div class="inline-flex items-center space-x-[4px] bg-[#ffd900] h-[26px] px-[12px] rounded-full text-[14px] font-medium text-[#1e1d1d] leading-[1.3]">
                                <svg class="w-[18px] h-[18px]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>In review</span>
                            </div>
                        @elseif($listing->status === 'Active')
                            <div class="inline-flex items-center space-x-[4px] bg-like-green h-[26px] px-[12px] rounded-full text-[14px] font-medium text-white leading-[1.3]">
                                <img src="{{ asset('images/check.svg') }}" class="w-[18px] h-[18px] brightness-0 invert" alt="">
                                <span>Active</span>
                            </div>
                        @elseif($listing->status === 'Declined')
                            <div class="inline-flex items-center space-x-[4px] bg-[#ed0707] h-[26px] px-[12px] rounded-full text-[14px] font-medium text-white leading-[1.3]">
                                <img src="{{ asset('images/close.svg') }}" class="w-[18px] h-[18px] brightness-0 invert" alt="">
                                <span>Declined</span>
                            </div>
                        @elseif($listing->status === 'Expired')
                            <div class="inline-flex items-center space-x-[4px] bg-[#f9f9f8] h-[26px] px-[12px] rounded-full text-[14px] font-medium text-[#464646] leading-[1.3]">
                                <span>Expired</span>
                            </div>
                        @else
                            <div class="inline-flex items-center bg-[#f9f9f8] h-[26px] px-[12px] rounded-full text-[14px] font-medium text-[#464646] leading-[1.3]">
                                <span>{{ $listing->status }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="w-[150px] text-[15px] text-[#464646] font-normal leading-[1.3]">
                        {{ $listing->created_at->format('M d, Y') }}
                    </div>
                    <div class="flex-1 flex justify-end">
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" @click.away="open = false" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                                <img src="{{ asset('images/dots.svg') }}" class="w-[24px] h-[24px]" alt="">
                            </button>
                            <div x-show="open"
                                 x-cloak
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute right-0 mt-2 w-[249px] bg-white rounded-[8px] border border-light-gray shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] z-[100] overflow-hidden">
                                <div class="py-2">
                                    <a href="{{ route('listings.show', $listing) }}" class="flex items-center space-x-[10px] px-[14px] py-[10px] hover:bg-gray-50 transition-colors">
                                        <img src="{{ asset('images/apartment_black.svg') }}" class="w-[18px] h-[18px]" alt="">
                                        <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">View listing</span>
                                    </a>
                                    <button class="w-full flex items-center space-x-[10px] px-[14px] py-[10px] hover:bg-gray-50 transition-colors text-left">
                                        <img src="{{ asset('images/bolt.svg') }}" class="w-[18px] h-[18px]" alt="">
                                        <span class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Boost listing</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="h-[200px] flex flex-col items-center justify-center space-y-4">
                    <p class="text-[#464646] text-[16px]">No listings found.</p>
                    <a href="{{ route('property_manager.listings.create') }}" class="text-electric-blue font-medium hover:underline">Create your first listing</a>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($listings->hasPages())
            <div class="mt-[40px] flex justify-between items-center pb-[40px]">
                <div class="flex items-center space-x-[16px] text-[15px] text-[#1e1d1d]">
                    <span class="font-medium">Rows per page</span>
                    <div class="w-[89px]">
                        <x-custom-select
                            name="per_page"
                            height="h-[39px]"
                            :options="['10' => '10', '20' => '20', '50' => '50']"
                            :selected="request('per_page', '10')"
                            onchange="document.getElementById('filter-form').submit()"
                        />
                    </div>
                </div>

                <div class="flex items-center space-x-[32px]">
                    <span class="text-[15px] font-medium text-[#1e1d1d]">
                        Page {{ $listings->currentPage() }} of {{ $listings->lastPage() }}
                    </span>
                    <div class="flex space-x-[10px]">
                        {{-- First Page --}}
                        <a href="{{ $listings->url(1) }}"
                           class="w-[39px] h-[39px] flex items-center justify-center bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] {{ $listings->onFirstPage() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50' }}">
                            <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] rotate-90" alt="">
                            <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] rotate-90 -ml-[12px]" alt="">
                        </a>
                        {{-- Previous Page --}}
                        <a href="{{ $listings->previousPageUrl() }}"
                           class="w-[39px] h-[39px] flex items-center justify-center bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] {{ $listings->onFirstPage() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50' }}">
                            <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] rotate-90" alt="">
                        </a>
                        {{-- Next Page --}}
                        <a href="{{ $listings->nextPageUrl() }}"
                           class="w-[39px] h-[39px] flex items-center justify-center bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] {{ $listings->hasMorePages() ? 'hover:bg-gray-50' : 'opacity-50 cursor-not-allowed' }}">
                            <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] -rotate-90" alt="">
                        </a>
                        {{-- Last Page --}}
                        <a href="{{ $listings->url($listings->lastPage()) }}"
                           class="w-[39px] h-[39px] flex items-center justify-center bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] {{ $listings->hasMorePages() ? 'hover:bg-gray-50' : 'opacity-50 cursor-not-allowed' }}">
                            <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] -rotate-90" alt="">
                            <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] -rotate-90 -ml-[12px]" alt="">
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-property-manager-layout>
