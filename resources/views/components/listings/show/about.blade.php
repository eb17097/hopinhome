@props(['listing'])

@php
    $descriptionLength = strlen($listing->description);
    $isLongDescription = $descriptionLength > 300;
@endphp

<div x-data="{ open: false }">
    <h3 class="text-[18px] font-medium text-black tracking-[-0.36px] leading-[1.28]">About this apartment</h3>
    <div class="mt-[20px] text-[16px] text-[#282828] leading-[1.5] whitespace-pre-wrap" 
         @if($isLongDescription) :class="{ 'max-h-[72px] overflow-hidden': !open }" @endif
         style="word-break: break-word;">
        @foreach(explode("\n", $listing->description) as $paragraph)
            <p class="mb-[18px]">{{ $paragraph }}</p>
        @endforeach
    </div>
    @if($isLongDescription)
        <button @click="open = !open" class="mt-[20px] text-[#1447D4] font-medium flex items-center gap-[8px]">
            <span class="text-[16px] tracking-[-0.48px] leading-[1.22]" x-text="open ? 'Read less' : 'Read the full description'"></span>
            <img src="{{ asset('images/arrow_downward.svg') }}" alt="Arrow" class="size-[18px] transition-transform" :class="{ 'transform rotate-180': open }">
        </button>
    @endif
</div>
