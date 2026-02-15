<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">Add a video tour (optional)</h3>
    <p class="text-base text-gray-600 mt-2">A video tour makes it easier to understand the space, layout, and surroundings.</p>

    <div class="mt-8" x-data="videoUploader()">
        <label for="video_file" class="block text-sm font-medium text-gray-700">Upload a video</label>
        <div class="mt-1">
            <input type="file" name="video_file" id="video_file" @change="handleFileSelect" class="sr-only" accept="video/mp4,video/quicktime,video/x-ms-wmv,video/x-msvideo">
            <label for="video_file" class="flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-electric-blue rounded-md cursor-pointer">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9A2.25 2.25 0 0 0 13.5 5.25h-9A2.25 2.25 0 0 0 2.25 7.5v9A2.25 2.25 0 0 0 4.5 18.75Z" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <span class="font-medium text-electric-blue">Tap to upload a video</span>
                    </div>
                    <p class="text-xs text-gray-500">MP4, MOV, WMV, AVI up to 50MB</p>
                </div>
            </label>
        </div>

        <div class="mt-4" x-show="videoPreviewUrl">
            <video :src="videoPreviewUrl" controls class="w-full rounded-md"></video>
            <button type="button" @click="removeVideo" class="mt-2 text-sm font-medium text-red-600 hover:text-red-800">Remove video</button>
        </div>
    </div>

    <script>
        function videoUploader() {
            return {
                videoPreviewUrl: null,
                handleFileSelect(event) {
                    const file = event.target.files[0];
                    if (file) {
                        this.videoPreviewUrl = URL.createObjectURL(file);
                    }
                },
                removeVideo() {
                    this.videoPreviewUrl = null;
                    document.getElementById('video_file').value = '';
                }
            }
        }
    </script>

    <div class="mt-4 bg-off-white p-4 rounded-md flex items-start space-x-3">
        <img src="{{ asset('images/contact_support_blue.svg') }}" alt="Support" class="h-7 w-7">
        <p class="text-sm text-gray-600">
            <span class="font-medium text-black">Suggestion:</span>
            Please avoid adding music and focus on showing the property clearly.
        </p>
    </div>
</div>
