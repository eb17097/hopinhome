@props([
    'rating' => 4.7,
    'reviewCount' => 15,
    'distribution' => [
        5 => ['count' => 11, 'percentage' => 73.33],
        4 => ['count' => 4, 'percentage' => 26.66],
        3 => ['count' => 0, 'percentage' => 0],
        2 => ['count' => 0, 'percentage' => 0],
        1 => ['count' => 0, 'percentage' => 0],
    ],
    'borderless' => false
])

<div @class([
    'h-[233px] flex overflow-hidden',
    'bg-white border border-light-gray rounded-[8px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)]' => !$borderless
])>
    {{-- Left: Score Summary --}}
    <div class="w-[30%] flex flex-col items-center justify-center min-w-[236px] py-10">
        <div class="flex gap-1 mb-2">
            @for ($i = 1; $i <= 5; $i++)
                @if ($i <= floor($rating))
                    <img src="{{ asset('images/star_blue.svg') }}" alt="Star" class="w-[28px] h-[28px]">
                @elseif ($i == ceil($rating) && $rating != floor($rating))
                    {{-- Using star_filled as a placeholder for half star if it looks better, or just use star_blue for full stars for now --}}
                    <img src="{{ asset('images/star_blue.svg') }}" alt="Star" class="w-[28px] h-[28px]">
                @else
                    <img src="{{ asset('images/star_filled.svg') }}" alt="Star" class="w-[28px] h-[28px]">
                @endif
            @endfor
        </div>
        <div class="text-[64px] font-medium text-electric-blue leading-none">{{ number_format($rating, 1) }}</div>
        <div class="text-[14px] font-medium text-[#464646] mt-2 text-center">Based on {{ $reviewCount }} reviews</div>
    </div>

    {{-- Vertical Divider --}}
    <div class="w-px bg-light-gray"></div>

    {{-- Right: Bars --}}
    <div class="flex-grow p-[48px] flex flex-col justify-center gap-[8px]">
        @foreach (range(5, 1) as $stars)
            @php
                $data = $distribution[$stars] ?? ['count' => 0, 'percentage' => 0];
            @endphp
            <div class="flex items-center gap-[8px]">
                <div class="flex items-center">
                    <span class="w-[11px] text-[16px] font-medium text-[#464646]">{{ $stars }}</span>
                    <img src="{{ asset('images/star.svg') }}" alt="Star" class="w-[14px] h-[14px]">
                </div>
                <div class="flex-grow bg-[#d9d9d9] h-[5px] rounded-full overflow-hidden">
                    <div class="bg-navy-blue h-full rounded-full" style="width: {{ $data['percentage'] }}%"></div>
                </div>
                <span class="text-[16px] font-medium text-[#464646] text-right">{{ $data['count'] }}</span>
            </div>
        @endforeach
    </div>
</div>
