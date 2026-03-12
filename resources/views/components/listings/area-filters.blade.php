<div class="flex flex-wrap gap-3 mb-[20px]">
    @php
        $currentLocation = request('location');
        $areas = [
            ['name' => 'Downtown Dubai'],
            ['name' => 'Dubai Marina'],
            ['name' => 'Jumeirah Village Circle (JVC)'],
            ['name' => 'Business Bay'],
            ['name' => 'Arabian Ranches'],
        ];
    @endphp

    @foreach($areas as $area)
        @php
            $slug = strtolower(str_replace(' ', '-', $area['name']));
            $isActive = $currentLocation === $area['name'] || request()->route('location') === $slug;
        @endphp
        <a href="{{ route('listings.search', ['location' => $slug]) }}" 
           class="h-[40px] px-[18px] py-[10px] rounded-full text-base font-normal flex items-center justify-center transition-colors duration-300 whitespace-nowrap {{ $isActive ? 'bg-electric-blue text-white border border-electric-blue' : 'bg-white text-electric-blue border border-electric-blue hover:bg-blue-50' }}">
            {{ $area['name'] }}
        </a>
    @endforeach
</div>
