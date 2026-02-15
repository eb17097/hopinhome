@props(['listing'])

<div class="mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-medium text-gray-900">Regulatory information</h2>
        <img src="{{ asset('images/info.svg') }}" alt="Info" class="w-6 h-6">
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <div class="flex justify-between py-2 border-b">
                <span>Permit number</span>
                <span class="font-medium">12345678912</span>
            </div>
            <div class="flex justify-between py-2 border-b">
                <span>Zone name</span>
                <span class="font-medium">Marsa Dubai</span>
            </div>
            <div class="flex justify-between py-2 border-b">
                <span>Agency name</span>
                <span class="font-medium">EXAMPLE PROPERTIES</span>
            </div>
            <div class="flex justify-between py-2 border-b">
                <span>Agent license no.</span>
                <span class="font-medium">31139</span>
            </div>
            <div class="flex justify-between py-2">
                <span>Broker license no.</span>
                <span class="font-medium">57053</span>
            </div>
        </div>
        <div class="flex flex-col items-center justify-center">
            <img src="{{ asset('images/qr-code.svg') }}" alt="QR Code" class="w-32 h-32">
            <span class="text-sm text-gray-500 mt-2">Trakheesi permit</span>
        </div>
    </div>
</div>
