@props(['review'])

<div class="bg-white border border-light-gray rounded-[8px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] p-6 relative">
    {{-- Stars --}}
    <div class="flex gap-[4px] mb-6">
        @for ($i = 0; $i < 5; $i++)
            <img src="{{ $i < $review->rating ? asset('images/star_filled.svg') : asset('images/star.svg') }}" 
                 alt="Star" class="w-[21px] h-[21px]">
        @endfor
    </div>

    {{-- Report Flag --}}
    <button class="absolute top-6 right-6">
        <img src="{{ asset('images/flag.svg') }}" alt="Report" class="w-[25px] h-[25px] opacity-60">
    </button>

    {{-- Comment --}}
    <p class="text-[14px] text-[#464646] leading-[1.5] mb-6 min-h-[63px]">
        {{ $review->comment }}
    </p>

    {{-- Reviewer --}}
    <div class="mt-auto">
        <h4 class="text-[16px] font-medium text-[#1e1d1d]">{{ $review->reviewer_name }}</h4>
        <p class="text-[14px] text-[#464646] mt-1">{{ $review->date }}</p>
    </div>
</div>
