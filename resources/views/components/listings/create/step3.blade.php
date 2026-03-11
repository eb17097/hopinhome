<div>
    <h3 class="text-[22px] font-medium text-black tracking-tight">Let’s start with the details</h3>
    <p class="text-base text-gray-600 mt-2">Fill in the basic information about your property.</p>

    <div class="mt-8">
        <label for="listing-name" class="block text-sm font-medium text-gray-700">Listing name</label>
        <div class="mt-1">
            <input type="text" name="name" id="listing-name" x-model="formData.name" class="h-[51px] p-[18px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full text-[16px] border-gray-300 rounded-[6px]" placeholder="e.g. Cozy Apartment with Great Views">
        </div>
    </div>

    <div class="mt-[10px] h-[53px] bg-off-white p-4 rounded-md flex items-center space-x-[8px]">
        <img src="{{ asset('images/contact_support_blue.svg') }}" alt="Support" class="h-7 w-7">
        <p class="text-sm text-gray-600">This will be the primary title of the listing.</p>
    </div>

    <div class="mt-[24px]">
        <div class="flex justify-between">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <span class="text-sm text-gray-500">1500 characters remaining</span>
        </div>
        <div class="mt-1">
            <textarea id="description" name="description" rows="4" x-model="formData.description" class="leading-[1.5] p-[18px] shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full text-[16px] border-gray-300 rounded-[6px]" placeholder="Write a description here"></textarea>
        </div>
    </div>

    <div class="mt-[10px] h-[53px] bg-off-white p-4 rounded-md flex items-center space-x-[8px]">
        <img src="{{ asset('images/contact_support_blue.svg') }}" alt="Support" class="h-7 w-7">
        <p class="text-sm text-gray-600">
            <span class="font-medium text-black">Suggestion:</span>
            Mention key details such as the location, what’s nearby, the layout, and any unique features.
        </p>
    </div>
</div>
