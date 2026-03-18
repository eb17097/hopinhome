@props(['review'])

<div class="bg-white border border-light-gray rounded-[8px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] px-[24px] py-[26px] relative">
    {{-- Stars --}}
    <div class="flex mb-[16px]">
        @for ($i = 0; $i < 5; $i++)
            <img src="{{ $i < $review->rating ? asset('images/star_blue.svg') : asset('images/star_blue_empty.svg') }}"
                 alt="Star" class="w-[21px] h-[21px]">
        @endfor
    </div>

    {{-- Report Flag --}}
    <button class="absolute top-6 right-6">
        <img src="{{ asset('images/flag.svg') }}" alt="Report" class="w-[25px] h-[25px]">
    </button>

    {{-- Comment --}}
    <p class="text-[14px] text-[#464646] leading-[1.5] mb-[18px] min-h-[63px]">
        {{ $review->comment }}
    </p>

    {{-- Reviewer --}}
    <div class="mt-auto">
        <h4 class="text-[16px] font-medium text-[#1e1d1d]">{{ $review->reviewer_name }}</h4>
        <p class="text-[14px] text-[#464646]">{{ $review->date }}</p>
    </div>
</div>
