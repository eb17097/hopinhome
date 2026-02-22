<div x-data="profilePhotoModal()" 
     @open-profile-photo-modal.window="show = true"
     x-show="show" 
     class="fixed inset-0 z-50 overflow-y-auto" 
     style="display: none;">
    
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        {{-- Background overlay --}}
        <div x-show="show" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             @click="show = false"
             class="fixed inset-0 transition-opacity bg-black bg-opacity-40"></div>

        {{-- Modal panel --}}
        <div x-show="show" 
             x-transition:enter="ease-out duration-300" 
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave="ease-in duration-200" 
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
             class="inline-block w-full max-w-[560px] my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] rounded-[14px]">
            
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-[#e8e8e7] flex items-center justify-between">
                <button @click="show = false" class="text-[#1e1d1d] hover:opacity-70 transition-opacity">
                    <img src="{{ asset('images/close.svg') }}" class="w-6 h-6" alt="Close">
                </button>
                <h3 class="text-[18px] font-medium text-[#1e1d1d]" x-text="step === 'crop' ? 'Crop photo' : 'Change profile picture'"></h3>
                <div class="w-6"></div> {{-- Spacer --}}
            </div>

            <div class="p-8">
                <form id="profilePhotoForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
                    <input type="file" name="photo" id="photo" class="hidden" accept="image/*" @change="handleFileSelect">
                    
                    {{-- Upload Step --}}
                    <div x-show="step === 'upload'">
                        <label class="block text-[16px] font-medium text-[#1e1d1d] mb-4">Profile picture</label>
                        
                        {{-- Upload Area --}}
                        <div class="relative">
                            <label for="photo" class="flex flex-col items-center justify-center w-full h-[240px] border-2 border-dashed border-[#1447d4] rounded-[8px] cursor-pointer hover:bg-blue-50 transition-colors overflow-hidden">
                                <div class="flex flex-col items-center">
                                    <div class="w-12 h-12 bg-[#f0f4ff] rounded-full flex items-center justify-center mb-4 text-[#1447d4]">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                        </svg>
                                    </div>
                                    <p class="text-[18px] font-medium text-[#1e1d1d] mb-1">Tap to upload your photo</p>
                                    <p class="text-[14px] text-[#464646]">Or simply drag your file here</p>
                                </div>
                            </label>
                        </div>

                        {{-- Suggestion Box --}}
                        <div class="mt-8 p-4 bg-[#f9f9f8] rounded-[8px] flex items-start gap-3">
                            <img src="{{ asset('images/info.svg') }}" class="w-5 h-5 mt-0.5" alt="Info">
                            <p class="text-[14px] leading-[1.5] text-[#464646]">
                                <span class="font-medium text-[#1e1d1d]">Suggestion:</span> Use a clear, high-quality image of yourself so that other users can easily recognize you.
                            </p>
                        </div>

                        {{-- Actions --}}
                        <div class="mt-10 space-y-4">
                            <button type="button" @click="show = false" class="w-full text-center text-[14px] font-medium text-[#464646] underline decoration-solid">
                                Cancel
                            </button>
                        </div>
                    </div>

                    {{-- Crop Step --}}
                    <div x-show="step === 'crop'" style="display: none;">
                        <div class="w-full h-[320px] bg-[#f9f9f8] rounded-[8px] overflow-hidden relative">
                            <img id="cropper-image" src="" alt="Picture" class="max-w-full">
                        </div>

                        {{-- Zoom Slider --}}
                        <div class="flex items-center gap-4 mt-6">
                            <img src="{{ asset('images/zoom_out.svg') }}" class="w-5 h-5 opacity-80 cursor-pointer" alt="-" @click="sliderValue = Math.max(0, sliderValue - 10); updateZoomFromSlider()">
                            <input type="range" min="0" max="100" x-model="sliderValue" @input="updateZoomFromSlider" 
                                   class="w-full h-1 bg-[#e8e8e7] rounded-lg appearance-none cursor-pointer custom-range-slider"
                                   :style="'background: linear-gradient(to right, #1447d4 ' + sliderValue + '%, #e8e8e7 ' + sliderValue + '%)'">
                            <img src="{{ asset('images/add_zoom.svg') }}" class="w-5 h-5 opacity-80 cursor-pointer" alt="+" @click="sliderValue = Math.min(100, Number(sliderValue) + 10); updateZoomFromSlider()">
                        </div>

                        {{-- Actions --}}
                        <div class="mt-8 space-y-4">
                            <button type="button" @click="confirmCrop" 
                                    class="w-full h-[48px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px]">
                                Confirm
                            </button>
                            <button type="button" @click="cancelCrop" class="w-full text-center text-[14px] font-medium text-[#464646] underline decoration-solid hover:text-black">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Make crop box circular */
    .cropper-view-box,
    .cropper-face {
        border-radius: 50%;
    }
    
    /* Blue outline for crop box */
    .cropper-view-box {
        outline: 2px solid #1447d4;
        outline-color: #1447d4;
    }

    /* Hide standard grid and handles for a cleaner look */
    .cropper-dashed,
    .cropper-point,
    .cropper-line {
        display: none !important;
    }

    /* Darken background slightly more */
    .cropper-modal {
        background-color: rgba(0, 0, 0, 0.4);
    }
    
    /* Custom Range Slider Styling */
    .custom-range-slider {
        -webkit-appearance: none;
    }
    .custom-range-slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 20px;
        width: 20px;
        border-radius: 50%;
        background: #ffffff;
        border: 2px solid #1447d4;
        cursor: pointer;
        box-shadow: 0 0 2px rgba(0,0,0,0.2);
    }
</style>

<script>
    function profilePhotoModal() {
        return {
            show: false,
            step: 'upload', // 'upload' or 'crop'
            photoPreview: null,
            cropper: null,
            sliderValue: 0,
            minZoom: 0,
            maxZoom: 3,

            init() {
                this.$watch('show', value => {
                    if (!value) {
                        this.reset();
                    }
                });
            },

            reset() {
                this.step = 'upload';
                this.photoPreview = null;
                document.getElementById('photo').value = '';
                if (this.cropper) {
                    this.cropper.destroy();
                    this.cropper = null;
                }
                this.sliderValue = 0;
            },

            handleFileSelect(event) {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                    this.step = 'crop';
                    this.$nextTick(() => {
                        this.initCropper();
                    });
                };
                reader.readAsDataURL(file);
            },

            initCropper() {
                const image = document.getElementById('cropper-image');
                image.src = this.photoPreview;
                
                if (this.cropper) {
                    this.cropper.destroy();
                }

                this.cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    dragMode: 'move',
                    autoCropArea: 0.8,
                    cropBoxMovable: false,
                    cropBoxResizable: false,
                    toggleDragModeOnDblclick: false,
                    guides: false,
                    center: false,
                    highlight: false,
                    background: false,
                    ready: () => {
                        const canvasData = this.cropper.getCanvasData();
                        // Setup zoom bounds
                        this.minZoom = canvasData.width / canvasData.naturalWidth;
                        this.maxZoom = this.minZoom * 4; 
                        this.sliderValue = 0;
                    },
                    zoom: (e) => {
                        const ratio = e.detail.ratio;
                        let val = ((ratio - this.minZoom) / (this.maxZoom - this.minZoom)) * 100;
                        this.sliderValue = Math.max(0, Math.min(100, val));
                    }
                });
            },

            updateZoomFromSlider() {
                if (this.cropper) {
                    const ratio = this.minZoom + ((this.sliderValue / 100) * (this.maxZoom - this.minZoom));
                    this.cropper.zoomTo(ratio);
                }
            },

            cancelCrop() {
                this.reset();
            },

            confirmCrop() {
                if (!this.cropper) return;
                
                // Get the cropped canvas (square)
                const canvas = this.cropper.getCroppedCanvas({
                    width: 400,
                    height: 400,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                canvas.toBlob((blob) => {
                    // Create a new File object from the blob
                    const file = new File([blob], 'profile_cropped.png', { type: 'image/png' });
                    
                    // Replace the file in the hidden input using DataTransfer
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    document.getElementById('photo').files = dataTransfer.files;

                    // Submit the form
                    document.getElementById('profilePhotoForm').submit();
                }, 'image/png');
            }
        }
    }
</script>