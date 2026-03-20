@props(['question', 'id'])

<div class="border-b border-gray-200 py-[20px] px-[16px]">
    <button @click="activeAccordion = activeAccordion === {{ $id }} ? null : {{ $id }}"
            class="flex justify-between items-center w-full text-left focus:outline-none">
        <span class="text-[#1E1D1D] font-medium leading-[1.28] tracking-[-0.36px] text-[18px]">{{ $question }}</span>
        <svg class="w-5 h-5 text-gray-500 transform transition-transform duration-200"
             :class="activeAccordion === {{ $id }} ? 'rotate-180' : ''"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
        </svg>
    </button>
    <div x-show="activeAccordion === {{ $id }}" x-collapse class="pb-[12px] pt-[12px] text-[#464646] leading-[1.5] text-[16px]">
        {{ $slot }}
    </div>
</div>
