@props(['action' => null, 'redirectTo' => null])

<x-modals.layout
    name="profile-photo"
    title="Change profile picture"
    maxWidth="560px"
    closeIcon="images/close.svg"
    paddingClass="p-8"
    x-data="profilePhotoModal()"
>
    <form id="profilePhotoForm" action="{{ $action ?? route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(!isset($action)) @method('PATCH') @endif
        <input type="hidden" name="redirect_to" value="{{ $redirectTo ?? url()->current() }}">
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
                <button type="button" @click="close()" class="w-full text-center text-[14px] font-medium text-[#464646] underline decoration-solid">
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
                <img src="{{ asset('images/zoom_in.svg') }}" class="w-5 h-5 opacity-80 cursor-pointer" alt="+" @click="sliderValue = Math.min(100, Number(sliderValue) + 10); updateZoomFromSlider()">
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

        {{-- Preview Step --}}
        <div x-show="step === 'preview'" style="display: none;">
            <p class="text-[16px] font-medium text-[#1e1d1d] mb-4">New profile picture</p>

            <div class="w-full h-[280px] border border-[#e8e8e7] rounded-[12px] flex items-center justify-center bg-white mb-6">
                <div class="w-[200px] h-[200px] rounded-full overflow-hidden border border-[#e8e8e7]">
                    <img :src="croppedPreview" class="w-full h-full object-cover" alt="Preview">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-10">
                <button type="button" @click="removePhoto" class="flex items-center justify-center gap-[6px] px-[32px] py-[12px] border border-[#ed0707] rounded-[6px] text-[#ed0707] text-[16px] font-medium tracking-[-0.48px] hover:bg-red-50 transition-colors">
                    <img src="{{ asset('images/close.svg') }}" class="w-5 h-5 brightness-0 [filter:invert(13%)_sepia(97%)_saturate(5764%)_hue-rotate(357deg)_brightness(89%)_contrast(106%)]" alt="Remove">
                    Remove photo
                </button>
                <button type="button" @click="step = 'crop'" class="flex items-center justify-center gap-[6px] px-[32px] py-[12px] border border-[#e8e8e7] rounded-[6px] text-[#1e1d1d] text-[16px] font-medium tracking-[-0.48px] hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                    </svg>
                    Crop photo
                </button>
            </div>

            <div class="space-y-4">
                <button type="button" @click="savePhoto"
                        class="w-full h-[52px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px]">
                    Save
                </button>
                <button type="button" @click="close()" class="w-full text-center text-[14px] font-medium text-[#464646] underline decoration-solid hover:text-black">
                    Cancel
                </button>
            </div>
        </div>
    </form>
</x-modals.layout>

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
        let cropperInstance = null; // Store outside reactive data to avoid Alpine Proxy issues
        let finalBlob = null;

        return {
            show: false,
            step: 'upload', // 'upload', 'crop', or 'preview'
            photoPreview: null,
            croppedPreview: null,
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

            close() {
                this.show = false;
            },

            reset() {
                this.step = 'upload';
                this.photoPreview = null;
                this.croppedPreview = null;
                finalBlob = null;
                const photoInput = document.getElementById('photo');
                if (photoInput) photoInput.value = '';
                
                if (cropperInstance) {
                    cropperInstance.destroy();
                    cropperInstance = null;
                }
                
                // Fully recreate image element on reset to guarantee a clean slate
                const oldImage = document.getElementById('cropper-image');
                if (oldImage) {
                    const newImage = document.createElement('img');
                    newImage.id = 'cropper-image';
                    newImage.className = 'max-w-full';
                    newImage.alt = 'Picture';
                    oldImage.parentNode.replaceChild(newImage, oldImage);
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
                if (cropperInstance) {
                    cropperInstance.destroy();
                    cropperInstance = null;
                }

                // Completely recreate the image element to wipe any leftover cropper state
                const oldImage = document.getElementById('cropper-image');
                const newImage = document.createElement('img');
                newImage.id = 'cropper-image';
                newImage.className = 'max-w-full';
                newImage.alt = 'Picture';
                oldImage.parentNode.replaceChild(newImage, oldImage);

                // Wait for the image to load before initializing Cropper
                newImage.onload = () => {
                    // Force the browser to complete layout calculations before Cropper measures the element
                    requestAnimationFrame(() => {
                        cropperInstance = new Cropper(newImage, {
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
                                // Force zoom out fully in viewMode 1 to capture the min zoom
                                cropperInstance.zoomTo(0);
                                const imageData = cropperInstance.getImageData();
                                const minRatio = imageData.width / imageData.naturalWidth;
                                
                                this.minZoom = minRatio;
                                this.maxZoom = minRatio * 3;
                                this.sliderValue = 0; // Start at absolute min zoom
                                this.updateZoomFromSlider();
                            },
                            zoom: (e) => {
                                // Enforce zoom limits
                                if (e.detail.ratio > this.maxZoom) {
                                    e.preventDefault();
                                    cropperInstance.zoomTo(this.maxZoom);
                                    return;
                                }
                                if (e.detail.ratio < this.minZoom) {
                                    e.preventDefault();
                                    cropperInstance.zoomTo(this.minZoom);
                                    return;
                                }

                                const ratio = e.detail.ratio;
                                let val = ((ratio - this.minZoom) / (this.maxZoom - this.minZoom)) * 100;
                                this.sliderValue = Math.max(0, Math.min(100, val));
                            }
                        });
                    });
                };
                
                newImage.src = this.photoPreview;
            },

            updateZoomFromSlider() {
                if (cropperInstance) {
                    const ratio = this.minZoom + ((this.sliderValue / 100) * (this.maxZoom - this.minZoom));
                    cropperInstance.zoomTo(ratio);
                }
            },

            cancelCrop() {
                this.reset();
            },

            removePhoto() {
                this.reset();
            },

            confirmCrop() {
                if (!cropperInstance) return;

                const canvas = cropperInstance.getCroppedCanvas({
                    width: 400,
                    height: 400,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                this.croppedPreview = canvas.toDataURL('image/png');

                canvas.toBlob((blob) => {
                    finalBlob = blob;
                    this.step = 'preview';
                }, 'image/png');
            },

            savePhoto() {
                if (!finalBlob) return;

                const file = new File([finalBlob], 'profile_cropped.png', { type: 'image/png' });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                document.getElementById('photo').files = dataTransfer.files;

                document.getElementById('profilePhotoForm').submit();
            }
        }
    }
</script>
