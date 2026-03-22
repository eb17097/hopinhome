<x-professional-layout>
    <div x-data class="px-6 py-[24px]">
        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-[24px]">
            <div class="flex items-center space-x-[10px]">
                <img src="{{ asset('images/group.svg') }}" alt="" class="w-[30px] h-[30px] brightness-0">
                <h1 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] leading-[1.28]">Agents</h1>
            </div>
            <button @click="$dispatch('open-add-agent-modal')" class="bg-electric-blue text-white px-[32px] py-[10.5px] rounded-full flex items-center space-x-[6px] hover:opacity-90 transition-opacity">
                <img src="{{ asset('images/add.svg') }}" alt="" class="w-[17px] h-[17px] brightness-0 invert">
                <span class="text-[16px] font-medium tracking-[-0.48px] leading-[1.18]">Add agent</span>
            </button>
        </div>

        {{-- Search and Filters --}}
        <div class="mb-[16px]">
            <div class="flex items-end gap-[16px]">
                <div class="flex-1">
                    <label class="block text-[15px] font-medium text-[#1e1d1d] mb-[6px] leading-[1.3]">Search</label>
                    <div class="relative">
                        <input type="text" placeholder="Search agents by name or email address" class="leading-[1.3] py-[12px] w-full h-[44px] px-[14px] border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] focus:outline-none focus:ring-1 focus:ring-electric-blue placeholder:text-[#464646] text-[15px]">
                    </div>
                </div>
                <button class="w-[180px] bg-electric-blue text-white h-[44px] px-[32px] rounded-[6px] font-medium tracking-[-0.48px] hover:opacity-90 transition-opacity text-[16px] border border-electric-blue">
                    Search
                </button>
            </div>

            {{-- Sorting and Count --}}
            <div class="flex justify-between items-center mt-[24px]">
                <p class="text-[15px] font-medium text-[#1e1d1d] leading-[1.3]">
                    Showing {{ $agents->firstItem() ?? 0 }}-{{ $agents->lastItem() ?? 0 }} of {{ $agents->total() }} results
                </p>
                <div class="flex items-center space-x-[12px]">
                    <span class="text-[15px] font-medium text-[#1e1d1d] leading-[1.3]">Sort by</span>
                    <div class="w-[180px]">
                        <x-custom-select
                            name="sort"
                            height="h-[39px]"
                            :options="['date_added' => 'Date added']"
                            :selected="'date_added'"
                        />
                    </div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="bg-white border border-light-gray rounded-[8px] shadow-[0px_2px_8px_0px_rgba(0,0,0,0.04)] overflow-hidden">
            <div class="bg-[#f9f9f8] border-b border-light-gray h-[50px] flex items-center px-[24px]">
                <div class="flex-1 min-w-0 text-[14px] font-medium text-[#1e1d1d]">Agent</div>
                <div class="w-[120px] text-[14px] font-medium text-[#1e1d1d]">Rating</div>
                <div class="w-[120px] text-[14px] font-medium text-[#1e1d1d]">Active listings</div>
                <div class="w-[150px] text-[14px] font-medium text-[#1e1d1d]">Listing credits</div>
                <div class="w-[150px] text-[14px] font-medium text-[#1e1d1d]">Boost credits</div>
                <div class="w-[40px]"></div>
            </div>

            <div class="divide-y divide-light-gray">
                @forelse($agents as $agent)
                    <div class="h-[104px] flex items-center px-[24px] group hover:bg-gray-50/50 transition-colors">
                        <div class="flex items-center space-x-[16px] flex-1 min-w-0">
                            <div class="w-[64px] h-[64px] rounded-full border border-light-gray overflow-hidden shrink-0">
                                <img src="{{ $agent->getProfilePhotoUrl() }}" alt="" class="w-full h-full object-cover">
                            </div>
                            <div class="min-w-0 flex items-center space-x-3">
                                <div>
                                    <h3 class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">{{ $agent->name }}</h3>
                                    <p class="text-[14px] text-[#464646] truncate">{{ $agent->email }}</p>
                                </div>
                                @if($agent->status === 'invited')
                                    <div class="bg-[#f9f9f8] px-3 py-1 rounded-full flex items-center space-x-1.5 border border-light-gray h-[26px]">
                                        <img src="{{ asset('images/schedule.svg') }}" class="w-4 h-4 opacity-70" alt="">
                                        <span class="text-[14px] text-[#464646] font-medium whitespace-nowrap">Invite sent</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="w-[120px] flex items-center space-x-1 text-[15px] text-[#464646]">
                            @if($agent->status === 'active')
                                <img src="{{ asset('images/sidebar_star.svg') }}" class="w-4 h-4" alt="">
                                <span class="font-medium text-[#1e1d1d]">4.9</span>
                            @else
                                <img src="{{ asset('images/sidebar_star.svg') }}" class="w-4 h-4 opacity-40 grayscale" alt="">
                                <span>-</span>
                            @endif
                        </div>
                        <div class="w-[120px] text-[15px] {{ $agent->status === 'active' ? 'font-medium text-[#1e1d1d]' : 'text-[#464646]' }}">
                            {{ $agent->status === 'active' ? '0' : '-' }}
                        </div>
                        <div class="w-[150px] text-[15px] {{ $agent->status === 'active' ? 'font-medium text-[#1e1d1d]' : 'text-[#464646]' }}">
                            {{ $agent->status === 'active' ? '0/' . ($agent->listing_limit ?? '50') : '-' }}
                        </div>
                        <div class="w-[150px] text-[15px] {{ $agent->status === 'active' ? 'font-medium text-[#1e1d1d]' : 'text-[#464646]' }}">
                            {{ $agent->status === 'active' ? '0/' . ($agent->boost_limit ?? '10') : '-' }}
                        </div>
                        <div class="flex justify-end relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.away="open = false" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                                <img src="{{ asset('images/dots_vertical.svg') }}" class="w-6 h-6" alt="">
                            </button>
                            <div x-show="open" x-cloak class="absolute right-0 top-full mt-1 w-[200px] bg-white rounded-[8px] border border-light-gray shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] z-[100] overflow-hidden">
                                <a href="#" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-50 text-[15px] text-[#1e1d1d]">
                                    <img src="{{ asset('images/account_circle.svg') }}" class="w-5 h-5 opacity-70" alt="">
                                    <span>View agent</span>
                                </a>
                                <a href="#" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-50 text-[15px] text-[#1e1d1d]">
                                    <img src="{{ asset('images/edit_square.svg') }}" class="w-5 h-5 opacity-70" alt="">
                                    <span>Edit profile</span>
                                </a>
                                <a href="#" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-50 text-[15px] text-[#1e1d1d]">
                                    <img src="{{ asset('images/swap_vert.svg') }}" class="w-5 h-5 opacity-70" alt="">
                                    <span>Adjust credit limits</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="h-[200px] flex flex-col items-center justify-center space-y-4">
                        <p class="text-[#464646] text-[16px]">No agents found.</p>
                        <button @click="$dispatch('open-add-agent-modal')" class="text-electric-blue font-medium hover:underline">Add your first agent</button>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Pagination --}}
        @if($agents->hasPages())
            <div class="mt-[40px] flex justify-between items-center pb-[40px]">
                <div class="flex items-center space-x-[16px] text-[15px] text-[#1e1d1d]">
                    <span class="font-medium">Rows per page</span>
                    <div class="w-[89px]">
                        <x-custom-select
                            name="per_page"
                            height="h-[39px]"
                            :options="['10' => '10', '20' => '20', '50' => '50']"
                            :selected="$agents->perPage()"
                        />
                    </div>
                </div>

                <div class="flex items-center space-x-[32px]">
                    <span class="text-[15px] font-medium text-[#1e1d1d]">
                        Page {{ $agents->currentPage() }} of {{ $agents->lastPage() }}
                    </span>
                    <div class="flex space-x-[10px]">
                        <a href="{{ $agents->url(1) }}" class="w-[39px] h-[39px] flex items-center justify-center bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] {{ $agents->onFirstPage() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50' }}">
                            <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] rotate-90" alt="">
                            <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] rotate-90 -ml-[12px]" alt="">
                        </a>
                        <a href="{{ $agents->previousPageUrl() }}" class="w-[39px] h-[39px] flex items-center justify-center bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] {{ $agents->onFirstPage() ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50' }}">
                            <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] rotate-90" alt="">
                        </a>
                        <a href="{{ $agents->nextPageUrl() }}" class="w-[39px] h-[39px] flex items-center justify-center bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] {{ $agents->hasMorePages() ? 'hover:bg-gray-50' : 'opacity-50 cursor-not-allowed' }}">
                            <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] -rotate-90" alt="">
                        </a>
                        <a href="{{ $agents->url($agents->lastPage()) }}" class="w-[39px] h-[39px] flex items-center justify-center bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] {{ $agents->hasMorePages() ? 'hover:bg-gray-50' : 'opacity-50 cursor-not-allowed' }}">
                            <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] -rotate-90" alt="">
                            <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] -rotate-90 -ml-[12px]" alt="">
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-professional-layout>
