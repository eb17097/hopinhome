<div>
    <h3 class="text-2xl font-medium text-black tracking-tight">Add photos</h3>
    <p class="text-base text-gray-600 mt-2">Adding photos helps renters understand the property better and makes your listing more attractive and trustworthy.</p>

    <div class="mt-8" x-data="photoUploader()">
        <!-- Reorder instruction banner -->
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

        <input type="file" name="photos[]" id="photos" @change="handleFileSelect" multiple class="sr-only" accept="image/*">
        
        <!-- List of uploaded photos -->
        <div class="space-y-4" x-show="previews.length > 0">
            <template x-for="(preview, index) in previews" :key="index">
                <div class="flex items-stretch space-x-0 rounded-md overflow-hidden border border-gray-100 shadow-sm">
                    <!-- Image Area -->
                    <div class="relative flex-1 aspect-[16/9] md:aspect-[21/9] overflow-hidden bg-gray-100">
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
                    <div class="w-10 bg-white border-l border-gray-100 flex flex-col justify-between py-2 items-center">
                        <button type="button" @click="moveUp(index)" class="p-1 hover:bg-gray-50 rounded transition text-gray-400 hover:text-black" :class="index === 0 ? 'invisible' : ''">
                            <svg class="w-6 h-6 rotate-180" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"/>
                            </svg>
                        </button>
                        
                        <button type="button" @click="remove(index)" class="p-1 hover:bg-red-50 rounded transition text-gray-400 hover:text-red-500">
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                             </svg>
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
        <div class="mt-6">
            <label 
                for="photos" 
                class="flex flex-col items-center justify-center w-full py-12 border-2 border-dashed rounded-md cursor-pointer transition-colors"
                :class="{'border-electric-blue bg-white': !isDragging, 'border-green-500 bg-green-50': isDragging}"
                @dragover.prevent="isDragging = true"
                @dragleave.prevent="isDragging = false"
                @drop.prevent="handleDrop">
                
                <div class="p-3 bg-electric-blue/10 rounded-full mb-3" x-show="previews.length === 0">
                    <svg class="mx-auto h-12 w-12 text-electric-blue" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                
                <div class="p-3 bg-electric-blue/10 rounded-full mb-3" x-show="previews.length > 0">
                    <svg class="w-6 h-6 text-electric-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>

                <div class="text-center">
                    <span class="text-base font-medium text-black" x-text="previews.length === 0 ? (isDragging ? 'Drop files here' : 'Tap to upload or drag & drop') : 'Tap to upload more photos'"></span>
                    <p class="text-sm text-gray-500 mt-1" x-text="previews.length === 0 ? 'Up to 20 photos' : (20 - previews.length) + ' photos remaining'"></p>
                </div>
            </label>
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
