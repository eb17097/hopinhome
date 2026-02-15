<div class="mt-16">
    <h2 class="text-3xl font-medium text-gray-900 mb-8">Frequently asked questions</h2>
    <div class="space-y-4">
        <div x-data="{ open: false }" class="border-b">
            <button @click="open = !open" class="w-full flex justify-between items-center py-4">
                <span class="font-medium">How much does it cost to rent an apartment in Dubai?</span>
                <img src="{{ asset('images/keyboard_arrow_down.svg') }}" alt="Arrow" class="w-6 h-6 transform transition-transform" :class="{'rotate-180': open}">
            </button>
            <div x-show="open" class="pb-4 text-gray-600">
                <p>Furnished apartments are convenient for short-term stays, while unfurnished apartments are more cost-effective for long-term tenants who prefer to personalize their space.</p>
            </div>
        </div>
        <div x-data="{ open: false }" class="border-b">
            <button @click="open = !open" class="w-full flex justify-between items-center py-4">
                <span class="font-medium">Is it better to rent a furnished or unfurnished apartment?</span>
                <img src="{{ asset('images/keyboard_arrow_down.svg') }}" alt="Arrow" class="w-6 h-6 transform transition-transform" :class="{'rotate-180': open}">
            </button>
            <div x-show="open" class="pb-4 text-gray-600">
                <p>The cost varies greatly depending on the location, size, and amenities. You can find a wide range of options to fit your budget.</p>
            </div>
        </div>
        <div x-data="{ open: false }" class="border-b">
            <button @click="open = !open" class="w-full flex justify-between items-center py-4">
                <span class="font-medium">What documents are required to rent an apartment in Dubai?</span>
                <img src="{{ asset('images/keyboard_arrow_down.svg') }}" alt="Arrow" class="w-6 h-6 transform transition-transform" :class="{'rotate-180': open}">
            </button>
            <div x-show="open" class="pb-4 text-gray-600">
                <p>Typically, you will need your passport, residence visa, and Emirates ID. Some landlords may require a security deposit and post-dated checks for rent.</p>
            </div>
        </div>
        <div x-data="{ open: false }" class="border-b">
            <button @click="open = !open" class="w-full flex justify-between items-center py-4">
                <span class="font-medium">Are utility bills included in the rent?</span>
                <img src="{{ asset('images/keyboard_arrow_down.svg') }}" alt="Arrow" class="w-6 h-6 transform transition-transform" :class="{'rotate-180': open}">
            </button>
            <div x-show="open" class="pb-4 text-gray-600">
                <p>This depends on the rental agreement. In most cases, utilities like electricity, water, and internet are not included and must be paid separately.</p>
            </div>
        </div>
    </div>
</div>
