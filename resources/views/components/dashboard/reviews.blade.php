<div class="bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] overflow-hidden">
    {{-- Header --}}
    <div class="px-6 py-4 border-b border-light-gray flex justify-between items-center">
        <h3 class="leading-[1.28] tracking-[-0.36px] text-[18px] font-medium text-[#1e1d1d]">My reviews</h3>
        <img src="{{ asset('images/arrow_forward.svg') }}" alt="Arrow Forward" class="w-[18px] h-[18px] brightness-0 opacity-70">
    </div>

    {{-- Content: Use the reusable summary card --}}
    <x-reviews.review-summary-card borderless />
</div>
