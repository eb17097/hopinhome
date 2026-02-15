<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">Add a video tour (optional)</h3>
    <p class="text-base text-gray-600 mt-2">A video tour makes it easier to understand the space, layout, and surroundings.</p>

    <div class="mt-8">
        <label for="video_url" class="block text-sm font-medium text-gray-700">Video URL</label>
        <div class="mt-1">
            <input type="text" name="video_url" id="video_url" x-model="formData.video_url" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="https://www.youtube.com/watch?v=...">
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
