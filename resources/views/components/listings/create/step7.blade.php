<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">Add photos</h3>
    <p class="text-base text-gray-600 mt-2">Adding photos helps renters understand the property better and makes your listing more attractive and trustworthy.</p>

    <div class="mt-8" x-data="photoPicker()">
        <label class="block text-sm font-medium text-gray-700">Upload photos</label>
        <div class="mt-1">
            <input type="file" name="photos[]" id="photos" @change="handleFileSelect" multiple class="sr-only" accept="image/*">
            <label for="photos" class="flex justify-center px-6 pt-5 pb-6 border-2 border-dashed border-electric-blue rounded-md cursor-pointer">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <span class="font-medium text-electric-blue">Tap to upload your photos</span>
                    </div>
                    <p class="text-xs text-gray-500">Up to 20 photos</p>
                </div>
            </label>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4" x-show="previews.length > 0">
            <template x-for="(preview, index) in previews" :key="index">
                <div class="relative">
                    <img :src="preview" class="h-48 w-full object-cover rounded-md">
                    <button type="button" @click="remove(index)" class="absolute top-2 right-2 bg-white rounded-full p-1 shadow-md">
                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            </template>
        </div>
    </div>

    <script>
        function photoPicker() {
            return {
                previews: [],
                handleFileSelect(event) {
                    this.previews = [];
                    const files = event.target.files;
                    for (let i = 0; i < files.length; i++) {
                        const reader = new FileReader();
                        reader.onload = (e) => {
                            this.previews.push(e.target.result);
                        };
                        reader.readAsDataURL(files[i]);
                    }
                },
                remove(index) {
                    // This is tricky as we can't directly manipulate the FileList.
                    // For a real app, you'd need a more robust solution to manage the files themselves.
                    // For this UI, we will just remove the preview. The controller will get what's left.
                    this.previews.splice(index, 1);
                    const dt = new DataTransfer();
                    const input = document.getElementById('photos');
                    const { files } = input;
                    for(let i=0; i < files.length; i++) {
                        if (i !== index) {
                            dt.items.add(files[i]);
                        }
                    }
                    input.files = dt.files;
                }
            }
        }
    </script>

    <div class="mt-4 bg-off-white p-4 rounded-md flex items-start space-x-3">
        <img src="{{ asset('images/contact_support_blue.svg') }}" alt="Support" class="h-7 w-7">
        <p class="text-sm text-gray-600">
            <span class="font-medium text-black">Suggestion:</span>
            Upload clear, high-quality photos of every room to help your property stand out.
        </p>
    </div>
</div>
