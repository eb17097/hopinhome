<div class="flex justify-between items-center mb-[24px]">
    <span class="text-gray-600 text-sm">859 properties</span>
    <div class="flex items-center gap-2">
        <span class="text-[14px] text-gray-600">Sort by:</span>
        <div class="relative" x-data="{
            open: false,
            selected: 'Most popular',
            options: ['Most popular', 'Price: Low to High', 'Price: High to Low', 'Newest']
        }">
            <!-- Trigger -->
            <div @click="open = !open"
                 @click.away="open = false"
                 class="flex items-center justify-between w-[160px] h-[39px] py-[9px] px-4 bg-white border border-gray-200 rounded-[4px] shadow-sm text-[16px] text-gray-700 cursor-pointer hover:border-gray-300 transition-colors select-none">
                <span x-text="selected" class="truncate leading-[1.3]"></span>
                <img src="{{ asset('images/chevron.svg') }}"
                     alt="Dropdown arrow"
                     class="w-[16px] transition-transform duration-200"
                     :class="open ? 'rotate-180' : ''">
            </div>

            <!-- Dropdown Panel -->
            <div x-show="open"
                 x-cloak
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 class="text-[16px] w-[160px] absolute right-0 mt-1 bg-white border border-gray-200 rounded-[4px] shadow-lg z-50 py-1 overflow-hidden">
                <template x-for="option in options" :key="option">
                    <div @click="selected = option; open = false; $dispatch('sort-changed', option)"
                         class="w-[160px] px-4 py-2 text-[16px] cursor-pointer hover:bg-gray-50 transition-colors"
                         :class="selected === option ? 'text-[#1447D4] font-medium' : 'text-gray-700'">
                        <span x-text="option"></span>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>
