@props(['listing'])
@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
@endphp

<div class="w-[390px] h-[312px] bg-white rounded-[8px] shadow-[0px_2px_10px_0px_rgba(0,0,0,0.1)] sticky top-[120px]">
    <div class="p-[20px] pb-[16px]">
        <div class="flex justify-between items-end">
            <div class="flex items-end gap-[4px]">
                <span class="text-[32px] font-semibold text-black tracking-[-0.64px] leading-[1.28]">AED {{ number_format($listing->price) }}</span>
                <span class="text-[14px] font-medium text-black leading-[1.5]">Yearly</span>
            </div>
            {{-- The Figma design for the booking card itself does not show the user avatar in this position --}}
        </div>

        <hr class="w-[358px] h-px bg-[#E8E8E7] my-[20px]">

        <div class="space-y-[12px]">
            <div class="flex justify-between items-center">
                <span class="text-[16px] text-[#464646] leading-[1.3]">Rental period</span>
                <span class="font-medium text-black leading-[1.3]">{{ Str::title($listing->payment_option) }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-[16px] text-[#464646] leading-[1.3]">Utilities</span>
                <span class="font-medium text-black leading-[1.3]">{{ Str::title($listing->utilities_option) }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-[16px] text-[#464646] leading-[1.3]">Security deposit</span>
                <span class="font-medium text-black leading-[1.3]">AED {{ number_format($listing->price * 0.1) }}</span>
            </div>
        </div>

        <button class="w-full h-[52px] bg-[#1447D4] rounded-[29.5px] flex items-center justify-center gap-[10px] mt-[32px] hover:bg-blue-700 transition">
            <img src="{{ asset('images/send.svg') }}" alt="Send message" class="w-[17px] h-[17px]">
            <span class="text-[16px] font-medium text-white tracking-[-0.48px] leading-[1.22]">Send a message</span>
        </button>

        <p class="text-[14px] text-[#464646] text-center leading-[1.5] mt-[16px]">Send a message request to the property manager</p>
    </div>
</div>
