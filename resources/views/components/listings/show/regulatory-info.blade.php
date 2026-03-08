@props(['listing'])

<div>
    <div class="flex items-center space-x-2">
        <h3 class="text-lg font-medium text-black">Regulatory information</h3>
    </div>

    <div class="flex mt-[8px]">
        <div class="grid flex-1 grid-cols-1 mr-[48px] leading-[1.3]">
            <div class="flex justify-between border-b items-center py-[10px]">
                <span class="text-gray-600">Permit number</span>
                <span class="font-medium text-black">12345678912</span>
            </div>
            <div class="flex justify-between border-b items-center py-[10px]">
                <span class="text-gray-600">Zone name</span>
                <span class="font-medium text-black">Marsa Dubai</span>
            </div>
            <div class="flex justify-between border-b items-center py-[10px]">
                <span class="text-gray-600">Agency name</span>
                <span class="font-medium text-black">EXAMPLE PROPERTIES</span>
            </div>
            <div class="flex justify-between border-b items-center py-[10px]">
                <span class="text-gray-600">Agent license no.</span>
                <span class="font-medium text-black">31139</span>
            </div>
            <div class="flex justify-between items-center py-[10px]">
                <span class="text-gray-600">Broker license no.</span>
                <span class="font-medium text-black">57053</span>
            </div>
        </div>
        <div class="text-center mt-[10px]">
            <div class="inline-block">
                <img src="{{ asset('images/qr_2.png') }}" alt="Trakheesi permit QR code" class="w-[160px] h-[160px]">
                <p class="text-center text-base font-medium text-black mt-[8px] leading-[1.3]">Trakheesi permit</p>
            </div>
        </div>
    </div>



    <div class="mt-[22px] bg-off-white p-[20px] pr-[24px] h-[80px] rounded-md flex items-center">
        <img src="{{ asset('images/lock.svg') }}" alt="Lock" class="w-[40px] h-[40px] flex-shrink-0">
        <p class="ml-[16px] text-[16px] text-gray-700 leading-[1.5]">
            These details from the Dubai Land Department <span class="font-medium">help protect</span>  renters by confirming that the property and broker are <span class="font-medium text-black">licensed and legally registered</span> in the UAE.
        </p>
    </div>
</div>
