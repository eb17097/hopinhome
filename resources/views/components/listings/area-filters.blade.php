<div class="flex flex-wrap gap-3 mb-8">
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
        <button class="px-[18px] py-[10px] rounded-full text-base font-normal flex items-center justify-center transition-colors duration-300 whitespace-nowrap {{ $area['active'] ? 'bg-blue-600 text-white border border-blue-600' : 'bg-white text-blue-600 border border-blue-600 hover:bg-blue-50' }}">
            {{ $area['name'] }}
        </button>
    @endforeach
</div>
