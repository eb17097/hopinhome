<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">Let’s start with the details</h3>
    <p class="text-base text-gray-600 mt-2">Fill in the basic information about your property.</p>

    <div class="mt-8">
        <label for="listing-name" class="block text-sm font-medium text-gray-700">Listing name</label>
        <div class="mt-1">
            <input type="text" name="listing-name" id="listing-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="e.g. Cozy Apartment with Great Views">
        </div>
    </div>

    <div class="mt-4 bg-off-white p-4 rounded-md flex items-start space-x-3">
        <img src="{{ asset('images/contact_support_blue.svg') }}" alt="Support" class="h-7 w-7">
        <p class="text-sm text-gray-600">This will be the primary title of the listing.</p>
    </div>

    <div class="mt-8">
        <div class="flex justify-between">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <span class="text-sm text-gray-500">1500 characters remaining</span>
        </div>
        <div class="mt-1">
            <textarea id="description" name="description" rows="4" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Write a description here"></textarea>
        </div>
    </div>

    <div class="mt-4 bg-off-white p-4 rounded-md flex items-start space-x-3">
        <img src="{{ asset('images/contact_support_blue.svg') }}" alt="Support" class="h-7 w-7">
        <p class="text-sm text-gray-600">
            <span class="font-medium text-black">Suggestion:</span>
            Mention key details such as the location, what’s nearby, the layout, and any unique features.
        </p>
    </div>
</div>
