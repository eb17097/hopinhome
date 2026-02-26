@props(['action' => null, 'redirectTo' => null])

<div x-data="onboardingProfilePhotoModal()"
     @open-onboarding-photo-modal.window="handleOpen($event)"
     x-show="show"
     class="fixed inset-0 z-[60] overflow-y-auto"
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
             class="inline-block w-full max-w-[586px] my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] rounded-[14px]">

            {{-- Header --}}
            <div class="px-6 py-5 flex items-center justify-center relative">
                <h3 class="text-[18px] font-medium text-[#1e1d1d]">
                    Crop photo
                </h3>
            </div>
            <div class="w-full h-px bg-[#e8e8e7]"></div>

            <div class="p-8">
                {{-- Crop Area --}}
                <div class="w-full h-[397px] bg-[#f9f9f8] rounded-[8px] overflow-hidden relative mb-12">
                    <img id="onboarding-cropper-image" src="" alt="Picture" class="max-w-full" crossorigin="anonymous">
                </div>

                {{-- Zoom Slider --}}
                <div class="flex items-center gap-4 mb-12">
                    <img src="{{ asset('images/zoom_out.svg') }}" class="w-6 h-6 opacity-80 cursor-pointer" alt="-" @click="sliderValue = Math.max(0, sliderValue - 10); updateZoomFromSlider()">
                    <div class="relative w-full h-1.5 flex items-center">
                        <input type="range" min="0" max="100" x-model="sliderValue" @input="updateZoomFromSlider"
                               class="w-full h-1.5 bg-[#e8e8e7] rounded-lg appearance-none cursor-pointer custom-range-slider-onboarding"
                               :style="'background: linear-gradient(to right, #1447d4 ' + sliderValue + '%, #e8e8e7 ' + sliderValue + '%)'">
                    </div>
                    <img src="{{ asset('images/zoom_in.svg') }}" class="w-6 h-6 opacity-80 cursor-pointer" alt="+" @click="sliderValue = Math.min(100, Number(sliderValue) + 10); updateZoomFromSlider()">
                </div>

                {{-- Actions --}}
                <div class="space-y-6">
                    <button type="button" @click="confirmCrop"
                            class="w-full h-[51px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px]">
                        Confirm
                    </button>
                    <button type="button" @click="show = false" class="w-full text-center text-[16px] text-[#464646] hover:text-[#1e1d1d] transition-colors">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Make crop box circular */
    #onboarding-cropper-image + .cropper-container .cropper-view-box,
    #onboarding-cropper-image + .cropper-container .cropper-face {
        border-radius: 50%;
    }

    /* Blue outline for crop box */
    #onboarding-cropper-image + .cropper-container .cropper-view-box {
        outline: 2px solid #1447d4;
        outline-color: #1447d4;
    }

    /* Hide standard grid and handles for a cleaner look */
    #onboarding-cropper-image + .cropper-container .cropper-dashed,
    #onboarding-cropper-image + .cropper-container .cropper-point,
    #onboarding-cropper-image + .cropper-container .cropper-line {
        display: none !important;
    }

    /* Darken background slightly more */
    #onboarding-cropper-image + .cropper-container .cropper-modal {
        background-color: rgba(0, 0, 0, 0.4);
    }

    /* Custom Range Slider Styling */
    .custom-range-slider-onboarding {
        -webkit-appearance: none;
    }
    .custom-range-slider-onboarding::-webkit-slider-thumb {
        -webkit-appearance: none;
        height: 24px;
        width: 24px;
        border-radius: 50%;
        background: #ffffff;
        border: 2px solid #1447d4;
        cursor: pointer;
        box-shadow: 0 0 2px rgba(0,0,0,0.2);
    }
</style>

<script>
    function onboardingProfilePhotoModal() {
        let cropperInstance = null;
        let originalFile = null;

        return {
            show: false,
            sliderValue: 50,
            minZoom: 0,
            maxZoom: 3,
            photoPreview: null,

            handleOpen(event) {
                this.photoPreview = event.detail.preview;
                this.show = true;
                
                this.$nextTick(() => {
                    this.initCropper();
                });
            },

            initCropper() {
                const image = document.getElementById('onboarding-cropper-image');
                if (!image) return;

                // Cleanup any existing instance
                if (cropperInstance) {
                    cropperInstance.destroy();
                    cropperInstance = null;
                }

                const self = this;
                const runSetup = () => {
                    requestAnimationFrame(() => {
                        cropperInstance = new Cropper(image, {
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
                            ready() {
                                const canvasData = cropperInstance.getCanvasData();
                                // In viewMode 1, Cropper automatically calculates the minimum zoom 
                                // that keeps the image covering the crop box.
                                self.minZoom = canvasData.width / canvasData.naturalWidth;
                                self.maxZoom = self.minZoom * 3;
                                self.sliderValue = 0; // Start at min zoom
                                self.updateZoomFromSlider();
                            },
                            zoom(e) {
                                // Enforce zoom limits
                                if (e.detail.ratio > self.maxZoom) {
                                    e.preventDefault();
                                    cropperInstance.zoomTo(self.maxZoom);
                                    return;
                                }
                                if (e.detail.ratio < self.minZoom) {
                                    e.preventDefault();
                                    cropperInstance.zoomTo(self.minZoom);
                                    return;
                                }
                                const ratio = e.detail.ratio;
                                let val = ((ratio - self.minZoom) / (self.maxZoom - self.minZoom)) * 100;
                                self.sliderValue = Math.max(0, Math.min(100, val));
                            }
                        });
                    });
                };

                // Remove existing onload to prevent leaks/conflicts
                image.onload = null;

                // Force re-load if it's already the same src, or wait for load
                if (image.src === this.photoPreview && image.complete) {
                    runSetup();
                } else {
                    image.onload = runSetup;
                    image.src = this.photoPreview;
                }
            },

            updateZoomFromSlider() {
                if (cropperInstance) {
                    const ratio = this.minZoom + ((this.sliderValue / 100) * (this.maxZoom - this.minZoom));
                    cropperInstance.zoomTo(ratio);
                }
            },

            confirmCrop() {
                if (!cropperInstance) return;

                const canvas = cropperInstance.getCroppedCanvas({
                    width: 400,
                    height: 400,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                canvas.toBlob((blob) => {
                    this.$dispatch('onboarding-photo-cropped', {
                        blob: blob,
                        preview: canvas.toDataURL('image/png')
                    });
                    this.show = false;
                }, 'image/png');
            }
        }
    }
</script>
