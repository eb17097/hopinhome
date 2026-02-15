<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">Add photos</h3>
    <p class="text-base text-gray-600 mt-2">Adding photos helps renters understand the property better and makes your listing more attractive and trustworthy.</p>

    <div class="mt-8" x-data="photoUploader()">
        <input type="file" name="photos[]" id="photos" @change="handleFileSelect" multiple class="sr-only" accept="image/*">
        
        <label 
            for="photos" 
            class="flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-md cursor-pointer transition-colors"
            :class="{'border-electric-blue': !isDragging, 'border-green-500 bg-green-50': isDragging}"
            @dragover.prevent="isDragging = true"
            @dragleave.prevent="isDragging = false"
            @drop.prevent="handleDrop">
            <div class="space-y-1 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
                <div class="flex text-sm text-gray-600">
                    <span class="font-medium text-electric-blue" x-text="isDragging ? 'Drop files here' : 'Tap to upload or drag & drop'"></span>
                </div>
                <p class="text-xs text-gray-500">Up to 20 photos</p>
            </div>
        </label>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4" x-show="previews.length > 0">
            <template x-for="(preview, index) in previews" :key="index">
                <div class="relative">
                    <img :src="preview" class="h-48 w-full object-cover rounded-md">
                    <button type="button" @click="remove(index)" class="absolute top-2 right-2 bg-white rounded-full p-1 shadow-md hover:bg-gray-100 transition">
                        <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            </template>
        </div>
    </div>

    <script>
        function photoUploader() {
            return {
                files: [],
                previews: [],
                isDragging: false,
                
                handleFileSelect(event) {
                    this.addFiles(event.target.files);
                },
                
                handleDrop(event) {
                    this.isDragging = false;
                    this.addFiles(event.dataTransfer.files);
                },

                addFiles(newFiles) {
                    const newFileArray = Array.from(newFiles);
                    newFileArray.forEach(file => {
                        // Prevent duplicates
                        if (!this.files.some(f => f.name === file.name && f.size === file.size)) {
                            this.files.push(file);
                            const reader = new FileReader();
                            reader.onload = (e) => this.previews.push(e.target.result);
                            reader.readAsDataURL(file);
                        }
                    });
                    this.updateFileInput();
                },

                remove(index) {
                    this.files.splice(index, 1);
                    this.previews.splice(index, 1);
                    this.updateFileInput();
                },

                updateFileInput() {
                    const dataTransfer = new DataTransfer();
                    this.files.forEach(file => dataTransfer.items.add(file));
                    document.getElementById('photos').files = dataTransfer.files;
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
