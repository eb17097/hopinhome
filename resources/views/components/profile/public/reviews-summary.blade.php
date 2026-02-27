@props(['user'])

<div class="bg-white border border-light-gray rounded-[8px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] flex overflow-hidden">
    {{-- Left: Score --}}
    <div class="w-[30%] flex flex-col items-center justify-center py-10">
        <div class="flex gap-1 mb-2">
            @for ($i = 0; $i < 5; $i++)
                <img src="{{ asset('images/star_filled.svg') }}" alt="Star" class="w-7 h-7" onerror="this.src='{{ asset('images/star.svg') }}'">
            @endfor
        </div>
        <div class="text-[64px] font-medium text-electric-blue leading-none">{{ number_format($user->rating, 1) }}</div>
        <div class="text-[14px] font-medium text-[#464646] mt-2 text-center">Based on {{ $user->review_count }} reviews</div>
    </div>

    {{-- Divider --}}
    <div class="w-px bg-light-gray my-10"></div>

    {{-- Right: Bars --}}
    <div class="flex-grow p-10 flex flex-col justify-center gap-3">
        @foreach ([5, 4, 3, 2, 1] as $star)
            @php
                $count = $user->reviews_stats[$star] ?? 0;
                $percentage = $user->review_count > 0 ? ($count / $user->review_count) * 100 : 0;
            @endphp
            <div class="flex items-center gap-3">
                <div class="flex items-center gap-1 w-8">
                    <span class="text-[16px] font-medium text-[#464646]">{{ $star }}</span>
                    <img src="{{ asset('images/star_filled.svg') }}" alt="Star" class="w-[14px] h-[14px] opacity-70">
                </div>
                <div class="flex-grow bg-[#d9d9d9] h-[5px] rounded-full overflow-hidden">
                    <div class="bg-navy-blue h-full rounded-full" style="width: {{ $percentage }}%"></div>
                </div>
                <span class="text-[16px] font-medium text-[#464646] w-6 text-right">{{ $count }}</span>
            </div>
        @endforeach
    </div>
</div>
