<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">Add a video tour (optional)</h3>
    <p class="text-base text-gray-600 mt-2">A video tour makes it easier to understand the space, layout, and surroundings.</p>

    <div class="mt-10" x-data="videoUploader()">
        <label for="video_file" class="block text-sm font-medium text-black mb-1.5">Video tour</label>
        <div class="relative">
            <input type="file" name="video_file" id="video_file" @change="handleFileSelect" class="sr-only" accept="video/mp4,video/quicktime,video/x-ms-wmv,video/x-msvideo">

            <div x-show="!videoPreviewUrl">
                <label for="video_file" class="flex flex-col items-center justify-center h-[307px] border-2 border-dashed border-electric-blue rounded-md cursor-pointer bg-white">
                    <div class="flex flex-col items-center">
                        <img src="{{ asset('images/upload-icon.svg') }}" alt="Upload" class="w-[54px] h-[54px] mb-2">
                        <p class="text-base font-medium text-black">Tap to upload your video</p>
                        <p class="text-sm text-gray-600 mt-1">Max. length <span class="font-medium text-black">2 minutes</span></p>
                    </div>
                </label>
            </div>

            <div class="mt-4" x-show="videoPreviewUrl">
                <video :src="videoPreviewUrl" controls class="w-full rounded-md"></video>
                <button type="button" @click="removeVideo" class="mt-3 text-sm font-medium text-red-600 hover:text-red-800 flex items-center gap-1">
                    <img src="{{ asset('images/delete.svg') }}" class="w-4 h-4" alt="">
                    Remove video
                </button>
            </div>
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

    <div class="mt-4 bg-off-white p-[14px] rounded-md flex items-center space-x-3">
        <img src="{{ asset('images/contact_support_blue.svg') }}" alt="Support" class="h-7 w-7">
        <p class="text-sm text-gray-600 leading-[1.5]">
            <span class="font-medium text-black">Suggestion:</span>
            Please <span class="font-medium text-black">avoid adding music</span> and focus on showing the property clearly.
        </p>
    </div>
</div>
