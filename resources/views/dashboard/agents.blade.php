<x-professional-layout>
    <div class="px-6 py-[24px]">
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

        <!-- Search and Filters -->
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

            <!-- Sorting and Count -->
            <div class="flex justify-between items-center mt-[24px]">
                <p class="text-[15px] font-medium text-[#1e1d1d] leading-[1.3]">
                    Showing 1-5 of 16 results
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

        <!-- Table -->
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
                {{-- Agent 1: Jane Smith (Invite sent) --}}
                <div class="h-[104px] flex items-center px-[24px] group hover:bg-gray-50/50 transition-colors">
                    <div class="flex items-center space-x-[16px] flex-1 min-w-0">
                        <div class="w-[64px] h-[64px] rounded-full border border-light-gray overflow-hidden shrink-0 bg-[#f0f0f0] flex items-center justify-center">
                            <img src="{{ asset('images/user-placeholder.svg') }}" alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="min-w-0 flex items-center space-x-3">
                            <div>
                                <h3 class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Jane Smith</h3>
                                <p class="text-[14px] text-[#464646] truncate">jane@example.com</p>
                            </div>
                            <div class="bg-[#f9f9f8] px-3 py-1 rounded-full flex items-center space-x-1.5 border border-light-gray h-[26px]">
                                <img src="{{ asset('images/schedule.svg') }}" class="w-4 h-4 opacity-70" alt="">
                                <span class="text-[14px] text-[#464646] font-medium whitespace-nowrap">Invite sent</span>
                            </div>
                        </div>
                    </div>
                    <div class="w-[120px] flex items-center space-x-1 text-[15px] text-[#464646]">
                        <img src="{{ asset('images/sidebar_star.svg') }}" class="w-4 h-4 opacity-40 grayscale" alt="">
                        <span>-</span>
                    </div>
                    <div class="w-[120px] text-[15px] text-[#464646]">-</div>
                    <div class="w-[150px] text-[15px] text-[#464646]">-</div>
                    <div class="w-[150px] text-[15px] text-[#464646]">-</div>
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

                {{-- Agent 2: Lauren Whitfield --}}
                <div class="h-[104px] flex items-center px-[24px] group hover:bg-gray-50/50 transition-colors">
                    <div class="flex items-center space-x-[16px] flex-1 min-w-0">
                        <div class="w-[64px] h-[64px] rounded-full border border-light-gray overflow-hidden shrink-0">
                            <img src="{{ asset('images/user-placeholder.svg') }}" alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center space-x-1">
                                <h3 class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Lauren Whitfield</h3>
                                <img src="{{ asset('images/verified_user.svg') }}" class="w-4 h-4" alt="">
                            </div>
                            <p class="text-[14px] text-[#464646] truncate">lauren@example.com</p>
                        </div>
                    </div>
                    <div class="w-[120px] flex items-center space-x-1">
                        <img src="{{ asset('images/sidebar_star.svg') }}" class="w-4 h-4" alt="">
                        <span class="text-[15px] font-medium text-[#1e1d1d]">4.9</span>
                    </div>
                    <div class="w-[120px] text-[15px] font-medium text-[#1e1d1d]">34</div>
                    <div class="w-[150px] text-[15px] font-medium text-[#1e1d1d]">5/20</div>
                    <div class="w-[150px] text-[15px] font-medium text-[#1e1d1d]">5/10</div>
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

                {{-- Agent 3: Marcus Delaney --}}
                <div class="h-[104px] flex items-center px-[24px] group hover:bg-gray-50/50 transition-colors">
                    <div class="flex items-center space-x-[16px] flex-1 min-w-0">
                        <div class="w-[64px] h-[64px] rounded-full border border-light-gray overflow-hidden shrink-0">
                            <img src="{{ asset('images/user-placeholder.svg') }}" alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center space-x-1">
                                <h3 class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Marcus Delaney</h3>
                                <img src="{{ asset('images/verified_user.svg') }}" class="w-4 h-4" alt="">
                            </div>
                            <p class="text-[14px] text-[#464646] truncate">marcus@example.com</p>
                        </div>
                    </div>
                    <div class="w-[120px] flex items-center space-x-1">
                        <img src="{{ asset('images/sidebar_star.svg') }}" class="w-4 h-4" alt="">
                        <span class="text-[15px] font-medium text-[#1e1d1d]">4.9</span>
                    </div>
                    <div class="w-[120px] text-[15px] font-medium text-[#1e1d1d]">18</div>
                    <div class="w-[150px] text-[15px] font-medium text-[#1e1d1d]">6/20</div>
                    <div class="w-[150px] text-[15px] font-medium text-[#1e1d1d]">6/10</div>
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

                {{-- Agent 4: Travis Kensington --}}
                <div class="h-[104px] flex items-center px-[24px] group hover:bg-gray-50/50 transition-colors">
                    <div class="flex items-center space-x-[16px] flex-1 min-w-0">
                        <div class="w-[64px] h-[64px] rounded-full border border-light-gray overflow-hidden shrink-0">
                            <img src="{{ asset('images/user-placeholder.svg') }}" alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center space-x-1">
                                <h3 class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Travis Kensington</h3>
                                <img src="{{ asset('images/verified_user.svg') }}" class="w-4 h-4" alt="">
                            </div>
                            <p class="text-[14px] text-[#464646] truncate">travis@example.com</p>
                        </div>
                    </div>
                    <div class="w-[120px] flex items-center space-x-1">
                        <img src="{{ asset('images/sidebar_star.svg') }}" class="w-4 h-4" alt="">
                        <span class="text-[15px] font-medium text-[#1e1d1d]">4.9</span>
                    </div>
                    <div class="w-[120px] text-[15px] font-medium text-[#1e1d1d]">12</div>
                    <div class="w-[150px] text-[15px] font-medium text-[#1e1d1d]">8/20</div>
                    <div class="w-[150px] text-[15px] font-medium text-[#1e1d1d]">7/10</div>
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

                {{-- Agent 5: Olivia Marston --}}
                <div class="h-[104px] flex items-center px-[24px] group hover:bg-gray-50/50 transition-colors">
                    <div class="flex items-center space-x-[16px] flex-1 min-w-0">
                        <div class="w-[64px] h-[64px] rounded-full border border-light-gray overflow-hidden shrink-0">
                            <img src="{{ asset('images/user-placeholder.svg') }}" alt="" class="w-full h-full object-cover">
                        </div>
                        <div class="min-w-0">
                            <div class="flex items-center space-x-1">
                                <h3 class="text-[16px] font-medium text-[#1e1d1d] leading-[1.5]">Olivia Marston</h3>
                                <img src="{{ asset('images/verified_user.svg') }}" class="w-4 h-4" alt="">
                            </div>
                            <p class="text-[14px] text-[#464646] truncate">olivia@example.com</p>
                        </div>
                    </div>
                    <div class="w-[120px] flex items-center space-x-1">
                        <img src="{{ asset('images/sidebar_star.svg') }}" class="w-4 h-4" alt="">
                        <span class="text-[15px] font-medium text-[#1e1d1d]">4.9</span>
                    </div>
                    <div class="w-[120px] text-[15px] font-medium text-[#1e1d1d]">8</div>
                    <div class="w-[150px] text-[15px] font-medium text-[#1e1d1d]">18/20</div>
                    <div class="w-[150px] text-[15px] font-medium text-[#1e1d1d]">6/10</div>
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
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-[40px] flex justify-between items-center pb-[40px]">
            <div class="flex items-center space-x-[16px] text-[15px] text-[#1e1d1d]">
                <span class="font-medium">Rows per page</span>
                <div class="w-[89px]">
                    <x-custom-select
                        name="per_page"
                        height="h-[39px]"
                        :options="['5' => '5', '10' => '10', '20' => '20']"
                        :selected="'5'"
                    />
                </div>
            </div>

            <div class="flex items-center space-x-[32px]">
                <span class="text-[15px] font-medium text-[#1e1d1d]">
                    Page 1 of 3
                </span>
                <div class="flex space-x-[10px]">
                    <button class="w-[39px] h-[39px] flex items-center justify-center bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] opacity-50 cursor-not-allowed">
                        <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] rotate-90" alt="">
                        <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] rotate-90 -ml-[12px]" alt="">
                    </button>
                    <button class="w-[39px] h-[39px] flex items-center justify-center bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] opacity-50 cursor-not-allowed">
                        <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] rotate-90" alt="">
                    </button>
                    <button class="w-[39px] h-[39px] flex items-center justify-center bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] hover:bg-gray-50">
                        <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] -rotate-90" alt="">
                    </button>
                    <button class="w-[39px] h-[39px] flex items-center justify-center bg-white border border-light-gray rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)] hover:bg-gray-50">
                        <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] -rotate-90" alt="">
                        <img src="{{ asset('images/chevron.svg') }}" class="w-[20px] h-[20px] -rotate-90 -ml-[12px]" alt="">
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-professional-layout>
