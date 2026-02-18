<div class="bg-white border border-light-gray rounded-lg shadow-sm p-6">
    <div class="flex justify-between items-center">
        <h3 class="text-lg font-medium text-black">Setup checklist</h3>
        <div class="flex items-center gap-2">
            <span class="text-sm text-gray-600">4/5</span> {{-- Adjusted to reflect property manager tasks --}}
            <div class="w-28 bg-light-gray rounded-full h-1.5">
                <div class="bg-blue-600 h-1.5 rounded-full" style="width: 80%"></div> {{-- Adjusted progress --}}
            </div>
        </div>
    </div>
    <div class="mt-4 space-y-3">
        <div class="bg-off-white rounded-md p-4 flex items-center gap-4">
            <img alt="checkmark" class="h-6 w-6" src="{{ asset('images/checkmark.svg') }}">
            <span class="font-medium text-base text-black">Verify your phone number</span>
        </div>
        <div class="bg-off-white rounded-md p-4 flex items-center gap-4">
            <img alt="checkmark" class="h-6 w-6" src="{{ asset('images/checkmark.svg') }}">
            <span class="font-medium text-base text-black">Write a bio</span>
        </div>
        <div class="bg-off-white rounded-md p-4 flex items-center gap-4">
            <img alt="checkmark" class="h-6 w-6" src="{{ asset('images/checkmark.svg') }}">
            <span class="font-medium text-base text-black">Upload a profile photo</span>
        </div>
        <div class="bg-off-white rounded-md p-4 flex items-center gap-4">
            <img alt="checkmark" class="h-6 w-6" src="{{ asset('images/checkmark.svg') }}">
            <span class="font-medium text-base text-black">Publish your first listing</span>
        </div>
        <div class="bg-white border border-light-gray rounded-md p-4 flex items-center gap-4">
            <div class="w-6 h-6 rounded-full border border-light-gray"></div>
            <div>
                <span class="font-medium text-base text-black">Enable notifications</span>
                <p class="text-sm text-gray-600">Stay updated on messages & news</p>
            </div>
            <img alt="info" class="h-5 w-5 ml-auto" src="{{ asset('images/info.svg') }}">
        </div>
    </div>
    <div class="text-center mt-4">
        <button class="text-sm text-gray-600 underline">Hide completed steps</button>
    </div>
</div>