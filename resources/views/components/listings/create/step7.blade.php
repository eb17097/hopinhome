<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">Add photos</h3>
    <p class="text-base text-gray-600 mt-2">Adding photos helps renters understand the property better and makes your listing more attractive and trustworthy.</p>

    <div class="mt-8" x-data="photoUploader()">
        <!-- Reorder instruction banner (only when photos exist) -->
        <div class="mb-6 bg-off-white p-4 rounded-md flex items-center space-x-3" x-show="previews.length > 0">
            <img src="{{ asset('images/contact_support_blue.svg') }}" alt="Support" class="h-6 w-6">
            <p class="text-sm text-gray-600">
                Click on the arrows to <span class="font-medium text-black">reorder the photos.</span> The first photo will be your cover photo.
            </p>
        </div>

        <div class="flex justify-between items-center mb-4" x-show="previews.length > 0">
            <h4 class="text-sm font-medium text-black">Uploaded photos</h4>
            <span class="text-sm text-gray-500" x-text="(20 - previews.length) + ' photos remaining'"></span>
        </div>

        <!-- Label for initial state -->
        <div class="mb-2" x-show="previews.length === 0">
            <h4 class="text-sm font-medium text-black">Listing photos</h4>
        </div>

        <input type="file" name="photos[]" id="photos" @change="handleFileSelect" multiple class="sr-only" accept="image/*">

        <!-- List of uploaded photos -->
        <div style="width:520px; margin:auto;" class="space-y-4" x-show="previews.length > 0">
            <template x-for="(preview, index) in previews" :key="index">
                <div class="flex items-stretch space-x-0">
                    <!-- Image Area -->
                    <div class="relative flex-1" style="border: 1px solid lightgray; border-radius: 3px; overflow: hidden;">
                        <img :src="preview" class="w-full h-full object-cover">

                        <!-- Cover photo badge -->
                        <template x-if="index === 0">
                            <div class="absolute top-3 left-3 bg-black/40 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1 rounded">
                                Cover photo
                            </div>
                        </template>

                        <!-- Index badge -->
                        <template x-if="index > 0">
                            <div class="absolute top-3 left-3 bg-black/20 backdrop-blur-sm text-white text-xs font-medium px-2.5 py-1 rounded">
                                <span x-text="(index + 1) + ' / ' + previews.length"></span>
                            </div>
                        </template>
                    </div>

                    <!-- Controls Bar (Figma Style) -->
                    <div class="w-10 bg-white flex flex-col justify-between items-center">
                        <button type="button" @click="moveUp(index)" class="p-1 hover:bg-gray-50 rounded transition text-gray-400 hover:text-black" :class="index === 0 ? 'invisible' : ''">
                            <svg class="w-6 h-6 rotate-180" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
                            </svg>
                        </button>

                        <button type="button" @click="remove(index)" class="p-1 hover:bg-red-50 rounded transition text-gray-400 hover:text-red-500">
                            <img src="{{ asset('images/delete.svg') }}" alt="Delete" class="h-5 w-5">
                        </button>

                        <button type="button" @click="moveDown(index)" class="p-1 hover:bg-gray-50 rounded transition text-gray-400 hover:text-black" :class="index === previews.length - 1 ? 'invisible' : ''">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </template>
        </div>

        <!-- Initial Upload Box / Upload More Box -->
        <div class="mb-6">
            <label
                for="photos"
                style="margin-left: auto; margin-right:auto; position: relative;"
                class="flex flex-col items-center justify-center border-2 border-dashed rounded-md cursor-pointer transition-colors"
                :class="{
                    'border-electric-blue bg-white py-24': previews.length === 0,
                    'border-electric-blue bg-white py-12 mt-4 w-[480px] left-[-20px]': previews.length > 0,
                    'border-green-500 bg-green-50': isDragging
                }"
                @dragover.prevent="isDragging = true"
                @dragleave.prevent="isDragging = false"
                @drop.prevent="handleDrop">

                <div class="mb-2">
                    <img src="{{ asset('images/upload-icon.svg') }}" alt="Upload" class="w-[54px] h-[54px]">
                </div>

                <div class="text-center">
                    <span class="text-base font-medium text-black" x-text="previews.length === 0 ? (isDragging ? 'Drop files here' : 'Tap to upload your photos') : 'Tap to upload more photos'"></span>
                    <p class="text-sm text-gray-500 mt-1" x-text="previews.length === 0 ? 'Up to 20 photos' : (20 - previews.length) + ' photos remaining'"></p>
                </div>
            </label>
        </div>

        <!-- Suggestion banner at the bottom -->
        <div class="mt-4 bg-off-white p-4 rounded-md flex items-center space-x-3" x-show="previews.length === 0">
            <img src="{{ asset('images/contact_support_blue.svg') }}" alt="Support" class="h-6 w-6">
            <p class="text-sm text-gray-600">
                <span class="font-medium text-black">Suggestion:</span> Upload clear, high-quality photos of <span class="font-medium text-black">every room</span> to help your property stand out.
            </p>
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
                    const remaining = 20 - this.files.length;

                    newFileArray.slice(0, remaining).forEach(file => {
                        // Prevent duplicates
                        if (!this.files.some(f => f.name === file.name && f.size === file.size)) {
                            this.files.push(file);
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                this.previews.push(e.target.result);
                            };
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

                moveUp(index) {
                    if (index === 0) return;
                    this.swap(index, index - 1);
                },

                moveDown(index) {
                    if (index === this.previews.length - 1) return;
                    this.swap(index, index + 1);
                },

                swap(idx1, idx2) {
                    // Swap in previews array
                    const p = [...this.previews];
                    [p[idx1], p[idx2]] = [p[idx2], p[idx1]];
                    this.previews = p;

                    // Swap in files array
                    const f = [...this.files];
                    [f[idx1], f[idx2]] = [f[idx2], f[idx1]];
                    this.files = f;

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
</div>
