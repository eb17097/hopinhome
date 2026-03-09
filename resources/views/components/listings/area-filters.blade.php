<div class="flex flex-wrap gap-3 mb-[20px]">
    @php
        $areas = [
            ['name' => 'Downtown Dubai', 'active' => true],
            ['name' => 'Dubai Marina', 'active' => false],
            ['name' => 'Jumeirah Village Circle (JVC)', 'active' => false],
            ['name' => 'Business Bay', 'active' => false],
            ['name' => 'Arabian Ranches', 'active' => false],
        ];
    @endphp

    @foreach($areas as $area)
        <button class="h-[40px] px-[18px] py-[10px] rounded-full text-base font-normal flex items-center justify-center transition-colors duration-300 whitespace-nowrap {{ $area['active'] ? 'bg-electric-blue text-white border border-electric-blue' : 'bg-white text-electric-blue border border-electric-blue hover:bg-blue-50' }}">
            {{ $area['name'] }}
        </button>
    @endforeach
</div>
