@props(['listing'])

<div>
    <div class="flex items-center space-x-2">
        <h3 class="text-lg font-medium text-black">Regulatory information</h3>
        <img src="{{ asset('images/info.svg') }}" alt="Info" class="w-5 h-5">
    </div>

    <div class="flex mt-4">
        <div class="grid flex-1 grid-cols-1 gap-x-8 mr-6">
            <div class="flex justify-between border-b items-center">
                <span class="text-gray-600">Permit number</span>
                <span class="font-medium text-black">12345678912</span>
            </div>
            <div class="flex justify-between border-b items-center">
                <span class="text-gray-600">Zone name</span>
                <span class="font-medium text-black">Marsa Dubai</span>
            </div>
            <div class="flex justify-between border-b items-center">
                <span class="text-gray-600">Agency name</span>
                <span class="font-medium text-black">EXAMPLE PROPERTIES</span>
            </div>
            <div class="flex justify-between border-b items-center">
                <span class="text-gray-600">Agent license no.</span>
                <span class="font-medium text-black">31139</span>
            </div>
            <div class="flex justify-between border-b items-center">
                <span class="text-gray-600">Broker license no.</span>
                <span class="font-medium text-black">57053</span>
            </div>
        </div>
        <div class="text-center">
            <div class="inline-block">
                <img src="{{ asset('images/trakheesi_qr_code.png') }}" alt="Trakheesi permit QR code" class="w-48 h-48">
                <p class="text-center text-base font-medium text-black">Trakheesi permit</p>
            </div>
        </div>
    </div>



    <div class="mt-6 bg-off-white p-4 rounded-md flex items-center space-x-4">
        <img src="{{ asset('images/lock.svg') }}" alt="Lock" class="w-8 h-8 flex-shrink-0">
        <p class="text-sm text-gray-700">
            These details from the <span class="font-medium">Dubai Land Department</span> help protect renters by confirming that the property and broker are <span class="font-medium text-black">licensed and legally registered</span> in the UAE.
        </p>
    </div>
</div>
