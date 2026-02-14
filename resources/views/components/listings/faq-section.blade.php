<div x-data="{ activeAccordion: 1 }">
    <h3 class="text-2xl font-medium text-gray-900 mb-6">Frequently asked questions</h3>

    <div class="border-t border-gray-200">
        <div class="border-b border-gray-200">
            <button @click="activeAccordion = activeAccordion === 1 ? null : 1" class="flex justify-between items-center w-full py-5 text-left focus:outline-none">
                <span class="text-gray-900 font-medium">How much does it cost to rent an apartment in Dubai?</span>
                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="activeAccordion === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div x-show="activeAccordion === 1" x-collapse class="pb-5 text-gray-500 leading-relaxed text-sm">
                Furnished apartments are convenient for short-term stays, while unfurnished apartments are more cost-effective for long-term tenants who prefer to personalize their space. Prices vary significantly based on location and amenities.
            </div>
        </div>

        <div class="border-b border-gray-200">
            <button @click="activeAccordion = activeAccordion === 2 ? null : 2" class="flex justify-between items-center w-full py-5 text-left focus:outline-none">
                <span class="text-gray-900 font-medium">Is it better to rent a furnished or unfurnished apartment?</span>
                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="activeAccordion === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div x-show="activeAccordion === 2" x-collapse class="pb-5 text-gray-500 leading-relaxed text-sm">
                It depends on your stay duration. Furnished is easier for quick moves, while unfurnished offers better value long-term.
            </div>
        </div>

        <div class="border-b border-gray-200">
            <button @click="activeAccordion = activeAccordion === 3 ? null : 3" class="flex justify-between items-center w-full py-5 text-left focus:outline-none">
                <span class="text-gray-900 font-medium">What documents are required to rent an apartment in Dubai?</span>
                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="activeAccordion === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div x-show="activeAccordion === 3" x-collapse class="pb-5 text-gray-500 leading-relaxed text-sm">
                Typically you need your Emirates ID, Passport copy, Residency Visa, and a cheque book for rental payments.
            </div>
        </div>

        <div class="border-b border-gray-200">
            <button @click="activeAccordion = activeAccordion === 4 ? null : 4" class="flex justify-between items-center w-full py-5 text-left focus:outline-none">
                <span class="text-gray-900 font-medium">Are utility bills included in the rent?</span>
                <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200" :class="activeAccordion === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
            <div x-show="activeAccordion === 4" x-collapse class="pb-5 text-gray-500 leading-relaxed text-sm">
                Usually, DEWA (water & electricity) and internet are separate, unless specified as "Bills Included" (common in hotel apartments).
            </div>
        </div>
    </div>
</div>
