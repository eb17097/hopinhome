<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">What type of listing are you adding?</h3>
    <p class="text-base text-gray-600 mt-2">Choose the property type.</p>

    <div class="space-y-4 mt-8">
        @foreach(['Apartment', 'Villa', 'House', 'Townhouse', 'Hotel apartment', 'Penthouse'] as $type)
            <div class="border border-light-gray rounded-md p-4 flex items-center justify-between hover:bg-gray-50 cursor-pointer">
                <div class="flex items-center space-x-4">
                    <img src="{{ asset('images/' . strtolower(str_replace(' ', '_', $type)) . '.svg') }}" alt="{{ $type }}" class="w-12 h-12">
                    <div>
                        <h4 class="text-base font-medium text-black">{{ $type }}</h4>
                        <p class="text-sm text-gray-600">
                            @switch($type)
                                @case('Apartment')
                                    Self-contained residential unit
                                    @break
                                @case('Villa')
                                    Spacious luxury residence
                                    @break
                                @case('House')
                                    Standalone residential property
                                    @break
                                @case('Townhouse')
                                    Multi-level attached home
                                    @break
                                @case('Hotel apartment')
                                    Serviced long-term unit
                                    @break
                                @case('Penthouse')
                                    Top-floor luxury unit
                                    @break
                            @endswitch
                        </p>
                    </div>
                </div>
                <div class="w-6 h-6 rounded-full border border-light-gray flex items-center justify-center">
                    <div class="w-3 h-3 rounded-full bg-electric-blue hidden"></div>
                </div>
            </div>
        @endforeach
    </div>
</div>
