<div class="bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] overflow-hidden">
    {{-- Header --}}
    <div class="px-6 py-4 border-b border-light-gray flex justify-between items-center">
        <h3 class="text-[18px] font-medium text-[#1e1d1d]">My reviews</h3>
        <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow Forward" class="w-4 h-4">
    </div>

    {{-- Content --}}
    <div class="flex">
        {{-- Left: Score Summary --}}
        <div class="w-[30%] p-10 flex flex-col items-center justify-center">
            <div class="flex space-x-1 mb-4">
                @for ($i = 0; $i < 4; $i++)
                    <img alt="star" class="h-6 w-6" src="{{ asset('images/star_filled.svg') }}">
                @endfor
                {{-- Half or empty star --}}
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 17.27L18.18 21L16.54 13.97L22 9.24L14.81 8.63L12 2L9.19 8.63L2 9.24L7.46 13.97L5.82 21L12 17.27Z" stroke="#1447D4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </path>
                </svg>
            </div>
            <p class="text-[64px] font-medium text-electric-blue leading-none">4.7</p>
            <p class="text-[14px] text-[#464646] mt-4">Based on 15 reviews</p>
        </div>

        {{-- Vertical Divider --}}
        <div class="w-[1px] bg-light-gray my-6"></div>

        {{-- Right: Bars --}}
        <div class="flex-grow p-10 flex flex-col justify-center space-y-3">
            @php
                $stats = [
                    ['stars' => 5, 'count' => 11, 'width' => '73%'],
                    ['stars' => 4, 'count' => 4, 'width' => '27%'],
                    ['stars' => 3, 'count' => 0, 'width' => '0%'],
                    ['stars' => 2, 'count' => 0, 'width' => '0%'],
                    ['stars' => 1, 'count' => 0, 'width' => '0%'],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1 w-8">
                        <span class="text-[14px] font-medium text-[#1e1d1d]">{{ $stat['stars'] }}</span>
                        <img alt="star" class="h-3 w-3" src="{{ asset('images/star_filled.svg') }}">
                    </div>
                    <div class="flex-grow bg-[#e8e8e7] rounded-full h-[6px]">
                        @if ($stat['count'] > 0)
                            <div class="bg-navy-blue h-[6px] rounded-full" style="width: {{ $stat['width'] }}"></div>
                        @endif
                    </div>
                    <span class="text-[14px] text-[#1e1d1d] w-6 text-right">{{ $stat['count'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</div>
