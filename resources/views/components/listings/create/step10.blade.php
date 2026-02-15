<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">Listing publishing</h3>
    <p class="text-base text-gray-600 mt-2">Set up publishing settings</p>

    <div class="mt-8 bg-off-white p-4 rounded-md flex items-center justify-between">
        <span class="text-sm font-medium text-black">Listing credits available</span>
        <div class="flex items-center space-x-2">
            <span class="text-lg font-medium text-black">12</span>
            <img src="{{ asset('images/toll.svg') }}" alt="Toll" class="h-6 w-6">
        </div>
    </div>

    <div class="mt-8">
        <label class="block text-sm font-medium text-gray-700">Listing duration</label>
        <p class="text-sm text-gray-600 mt-1">Choose the total amount of days to show this listing before having to extend it.</p>
        <div class="grid grid-cols-3 gap-4 mt-4">
            <div class="border border-light-gray rounded-md p-4 text-center">
                <div class="flex justify-end items-center">
                    <span class="text-sm font-medium text-gray-600 mr-1">1</span>
                    <img src="{{ asset('images/toll_gray.svg') }}" alt="Toll" class="h-4 w-4">
                </div>
                <p class="text-base font-medium text-black mt-2">30 days</p>
                <p class="text-sm text-gray-600">Standard</p>
            </div>
            <div class="border border-light-gray rounded-md p-4 text-center">
                <div class="flex justify-end items-center">
                    <span class="text-sm font-medium text-gray-600 mr-1">2</span>
                    <img src="{{ asset('images/toll_gray.svg') }}" alt="Toll" class="h-4 w-4">
                </div>
                <p class="text-base font-medium text-black mt-2">60 days</p>
                <p class="text-sm text-gray-600">Extended</p>
            </div>
            <div class="border border-light-gray rounded-md p-4 text-center">
                <div class="flex justify-end items-center">
                    <span class="text-sm font-medium text-gray-600 mr-1">3</span>
                    <img src="{{ asset('images/toll_gray.svg') }}" alt="Toll" class="h-4 w-4">
                </div>
                <p class="text-base font-medium text-black mt-2">90 days</p>
                <p class="text-sm text-gray-600">Long term</p>
            </div>
        </div>
    </div>

    <div class="mt-8">
        <label class="block text-sm font-medium text-gray-700">Renewal settings</label>
        <p class="text-sm text-gray-600 mt-1">Listing renewal acts as a republished listing that counts as published today</p>
        <div class="grid grid-cols-3 gap-4 mt-4">
            <div class="border border-light-gray rounded-md p-4 text-center">
                <p class="text-base font-medium text-black mt-2">Monthly</p>
                <p class="text-sm text-gray-600">1 credit / mo.</p>
            </div>
            <div class="border border-light-gray rounded-md p-4 text-center">
                <p class="text-base font-medium text-black mt-2">Bi-weekly</p>
                <p class="text-sm text-gray-600">2 credits / mo.</p>
            </div>
            <div class="border border-light-gray rounded-md p-4 text-center">
                <p class="text-base font-medium text-black mt-2">Weekly</p>
                <p class="text-sm text-gray-600">4 credits / mo.</p>
            </div>
        </div>
    </div>

    <hr class="my-8">

    <div class="flex justify-between items-center">
        <span class="text-lg font-medium text-black">Listing cost</span>
        <div class="flex items-center space-x-2">
            <span class="text-lg font-medium text-black">0</span>
            <img src="{{ asset('images/toll.svg') }}" alt="Toll" class="h-6 w-6">
        </div>
    </div>
</div>
