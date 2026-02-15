<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">Add a video tour (optional)</h3>
    <p class="text-base text-gray-600 mt-2">A video tour makes it easier to understand the space, layout, and surroundings.</p>

    <div class="mt-8">
        <label for="video" class="block text-sm font-medium text-gray-700">Video tour</label>
        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-electric-blue rounded-md">
            <div class="space-y-1 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="flex text-sm text-gray-600">
                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-electric-blue hover:text-blue-700 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                        <span>Tap to upload your video</span>
                        <input id="file-upload" name="file-upload" type="file" class="sr-only">
                    </label>
                </div>
                <p class="text-xs text-gray-500">Max. length 2 minutes</p>
            </div>
        </div>
    </div>

    <div class="mt-4 bg-off-white p-4 rounded-md flex items-start space-x-3">
        <img src="{{ asset('images/contact_support_blue.svg') }}" alt="Support" class="h-7 w-7">
        <p class="text-sm text-gray-600">
            <span class="font-medium text-black">Suggestion:</span>
            Please avoid adding music and focus on showing the property clearly.
        </p>
    </div>
</div>
