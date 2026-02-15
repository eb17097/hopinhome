<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">Listing publishing</h3>
    <p class="text-base text-gray-600 mt-2">Set up publishing settings</p>

    <input type="hidden" name="duration" x-model="formData.duration">
    <input type="hidden" name="renewal_type" x-model="formData.renewal_type">

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
            @foreach([30, 60, 90] as $duration)
            <div @click="formData.duration = {{ $duration }}" :class="{'border-electric-blue bg-blue-50': formData.duration === {{ $duration }} }" class="border border-light-gray rounded-md p-4 text-center cursor-pointer transition-colors">
                <div class="flex justify-end items-center">
                    <span class="text-sm font-medium text-gray-600 mr-1">{{ $duration / 30 }}</span>
                    <img src="{{ asset('images/toll_gray.svg') }}" alt="Toll" class="h-4 w-4">
                </div>
                <p class="text-base font-medium text-black mt-2">{{ $duration }} days</p>
                <p class="text-sm text-gray-600">
                    @switch($duration)
                        @case(30) Standard @break
                        @case(60) Extended @break
                        @case(90) Long term @break
                    @endswitch
                </p>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mt-8">
        <label class="block text-sm font-medium text-gray-700">Renewal settings</label>
        <p class="text-sm text-gray-600 mt-1">Listing renewal acts as a republished listing that counts as published today</p>
        <div class="grid grid-cols-3 gap-4 mt-4">
            @foreach(['Monthly', 'Bi-weekly', 'Weekly'] as $type)
            <div @click="formData.renewal_type = '{{ $type }}'" :class="{'border-electric-blue bg-blue-50': formData.renewal_type === '{{ $type }}'}" class="border border-light-gray rounded-md p-4 text-center cursor-pointer transition-colors">
                <p class="text-base font-medium text-black mt-2">{{ $type }}</p>
                <p class="text-sm text-gray-600">
                    @switch($type)
                        @case('Monthly') 1 credit / mo. @break
                        @case('Bi-weekly') 2 credits / mo. @break
                        @case('Weekly') 4 credits / mo. @break
                    @endswitch
                </p>
            </div>
            @endforeach
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
