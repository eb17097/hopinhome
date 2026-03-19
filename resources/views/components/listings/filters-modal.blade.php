<div 
    x-show="isModalOpen" 
    x-cloak 
    @keydown.escape.window="isModalOpen = false"
    class="fixed inset-0 z-[100] overflow-y-auto" 
    aria-labelledby="modal-title" 
    role="dialog" 
    aria-modal="true"
>
    <!-- Overlay -->
    <div 
        x-show="isModalOpen"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="isModalOpen = false"
        class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
    ></div>

    <!-- Modal Panel -->
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
        <div 
            x-show="isModalOpen"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="relative transform overflow-hidden rounded-[14px] bg-white text-left shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] transition-all sm:my-8 sm:w-full sm:max-w-[792px]"
        >
            <!-- Header -->
            <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <button @click="isModalOpen = false" class="text-[#1447D4] hover:text-blue-700 transition-colors">
                        <img src="{{ asset('images/arrow_left_blue.svg') }}" alt="Back" class="w-6 h-6">
                    </button>
                    <h3 class="text-[20px] font-medium text-[#1E1D1D] flex items-center gap-2">
                        Search & Filters
                        <span class="bg-[#1447D4] text-white text-[12px] w-6 h-6 flex items-center justify-center rounded-full">3</span>
                    </h3>
                </div>
                <button class="text-[16px] text-gray-500 hover:text-gray-700 transition-colors">Clear all</button>
            </div>

            <!-- Content -->
            <div class="px-10 py-8 space-y-10 max-h-[70vh] overflow-y-auto">
                <!-- Location Section -->
                <div>
                    <h4 class="text-[18px] font-medium text-[#1E1D1D] mb-4">Location</h4>
                    <div class="relative flex items-center bg-white border border-gray-200 rounded-lg h-[56px] px-4 py-2 transition-all duration-200 gap-3">
                        <img src="{{ asset('images/location_on.svg') }}" alt="Location" class="w-6 h-6 text-gray-400">
                        <div class="flex items-center gap-2 flex-grow overflow-hidden">
                            <span class="bg-[#F9F9F8] border border-gray-200 rounded-md px-3 py-1 text-[16px] text-gray-700 flex items-center shrink-0">
                                Dubai
                                <img src="{{ asset('images/close.svg') }}" alt="Remove" class="w-4 h-4 ml-2 cursor-pointer">
                            </span>
                            <input type="text" placeholder="Enter City or Location" class="flex-grow border-none focus:ring-0 text-gray-700 placeholder-[#464646] text-[16px] p-0 bg-transparent">
                        </div>
                    </div>
                </div>

                <!-- Property Type Section -->
                <div>
                    <h4 class="text-[18px] font-medium text-[#1E1D1D] mb-4">Property type</h4>
                    <div class="grid grid-cols-3 gap-4">
                        @foreach([
                            ['name' => 'Apartment', 'icon' => 'apartment_big.svg', 'selected' => false],
                            ['name' => 'Villa', 'icon' => 'villa.svg', 'selected' => true],
                            ['name' => 'House', 'icon' => 'house.svg', 'selected' => true],
                            ['name' => 'Townhouse', 'icon' => 'townhouse.svg', 'selected' => false],
                            ['name' => 'Hotel apartment', 'icon' => 'hotel_apartment.svg', 'selected' => false],
                            ['name' => 'Penthouse', 'icon' => 'penthouse.svg', 'selected' => false],
                        ] as $type)
                            <div class="flex flex-col items-center justify-center gap-3 p-6 border rounded-[8px] cursor-pointer transition-all relative h-[160px] {{ $type['selected'] ? 'border-[#1447D4] bg-blue-50/30' : 'border-gray-100' }}">
                                @if($type['selected'])
                                    <div class="absolute -top-1.5 -right-1.5 size-6 bg-[#1447D4] rounded-full flex items-center justify-center shadow-sm z-10">
                                        <img src="{{ asset('images/check.svg') }}" class="size-3 brightness-0 invert" alt="">
                                    </div>
                                @endif
                                <div class="size-[48px] flex items-center justify-center">
                                    <div class="w-full h-full" style="mask-image: url({{ asset('images/' . $type['icon']) }}); -webkit-mask-image: url({{ asset('images/' . $type['icon']) }}); mask-size: contain; -webkit-mask-size: contain; mask-repeat: no-repeat; -webkit-mask-repeat: no-repeat; mask-position: center; -webkit-mask-position: center; background-color: {{ $type['selected'] ? '#1447D4' : '#04247B' }}"></div>
                                </div>
                                <span class="text-[16px] font-medium text-center {{ $type['selected'] ? 'text-[#1447D4]' : 'text-gray-700' }}">{{ $type['name'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-10 py-6 border-t border-gray-100 flex justify-center">
                <button class="w-full max-w-[712px] h-[56px] bg-[#1447D4] text-white rounded-full flex items-center justify-center gap-2 text-[18px] font-medium hover:bg-blue-700 transition-colors shadow-lg">
                    <img src="{{ asset('images/search.svg') }}" alt="Search" class="w-5 h-5 brightness-0 invert">
                    Show properties
                </button>
            </div>
        </div>
    </div>
</div>
