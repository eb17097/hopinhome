@props(['initialPhoto' => null])

<div x-data="profilePhotoUploader()"
     class="w-full"
     @onboarding-photo-cropped.window="handlePhotoCropped($event)">

    <input type="file" id="onboarding-photo-input" name="photo" class="hidden" accept="image/*" @change="handleFileSelect">

    <div class="mb-6">
        <label class="text-[14px] font-medium text-[#1e1d1d] block mb-2">Profile picture</label>

        {{-- Upload/Display Box --}}
        <div @click="!hasPhoto ? triggerUpload() : null"
            :class="hasPhoto ? 'border-solid' : 'border-dashed cursor-pointer hover:bg-blue-50'"
            class="w-full h-[204px] border border-[#1447d4] rounded-lg flex flex-col items-center justify-center transition-all overflow-hidden bg-white relative">

            {{-- Photo Exists --}}
            <template x-if="hasPhoto">
                <div class="w-full h-full flex items-center justify-center bg-white p-4">
                    <div class="w-[172px] h-[172px] rounded-full overflow-hidden border border-[#e8e8e7]">
                        <img :src="photoPreview" alt="Profile" class="w-full h-full object-cover">
                    </div>
                </div>
            </template>

            {{-- No Photo --}}
            <template x-if="!hasPhoto">
                <div class="flex flex-col items-center">
{{--                    <div class="w-[54px] h-[54px] mb-4">--}}
{{--                        <svg width="54" height="54" viewBox="0 0 54 54" fill="none" xmlns="http://www.w3.org/2000/svg">--}}
{{--                            <rect width="54" height="54" rx="27" fill="#F0F4FF"/>--}}
{{--                            <path d="M27 31V23M27 23L24 26M27 23L30 26M19 31.5V32.2C19 33.8802 19 34.7202 19.327 35.362C19.6146 35.9265 20.0735 36.3854 20.638 36.673C21.2798 37 22.1198 37 23.8 37H30.2C31.8802 37 32.7202 37 33.362 36.673C33.9265 36.3854 34.3854 35.9265 34.673 35.362C35 34.7202 35 33.8802 35 32.2V31.5M31 20.5C31 22.7091 29.2091 24.5 27 24.5C24.7909 24.5 23 22.7091 23 20.5C23 18.2909 24.7909 16.5 27 16.5C29.2091 16.5 31 18.2909 31 20.5Z" stroke="#1447D4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>--}}
{{--                        </svg>--}}
{{--                    </div>--}}
                    <div class="mb-2">
                        <img src="{{ asset('images/upload-icon.svg') }}" alt="Upload" class="w-[54px] h-[54px]">
                    </div>
                    <p class="text-[16px] font-medium text-[#1e1d1d] mb-1">Tap to upload your photo</p>
                    <p class="text-[14px] text-[#464646]">Or simply drag your file here</p>
                </div>
            </template>
        </div>
    </div>

    {{-- Action Buttons (Only when photo exists) --}}
    <div x-show="hasPhoto" class="grid grid-cols-2 gap-6 mb-12">
        <button type="button" @click="removePhoto" class="flex items-center justify-center gap-3 h-[44px] border border-[#e8e8e7] rounded-[4px] text-[#1e1d1d] font-medium hover:bg-gray-50 transition-colors">
            <img src="{{ asset('images/close.svg') }}" class="w-5 h-5" alt="">
            <span>Remove photo</span>
        </button>
        <button type="button" @click="editCurrentPhoto" class="flex items-center justify-center gap-3 h-[44px] border border-[#e8e8e7] rounded-[4px] text-[#1e1d1d] font-medium hover:bg-gray-50 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            <span>Edit photo</span>
        </button>
    </div>

    {{-- Suggestion Box (Only when NO photo exists) --}}
    <div x-show="!hasPhoto" class="flex items-start gap-4 p-5 bg-[#f9f9f8] rounded-lg mb-12">
        <img src="{{ asset('images/contact_support_blue.svg') }}" alt="" class="w-7 h-7 shrink-0">
        <p class="text-[14px] leading-[1.5] text-[#464646]">
            <span class="font-medium text-[#1e1d1d]">Suggestion:</span>
            Use an image where you are the only one in the frame so property managers can easily recognize you.
        </p>
    </div>

    <script>
        function profilePhotoUploader() {
            return {
                hasPhoto: {{ $initialPhoto ? 'true' : 'false' }},
                photoPreview: '{{ $initialPhoto }}',
                originalSource: '{{ $initialPhoto }}', // Store the uncropped/original source
                croppedBlob: null,

                triggerUpload() {
                    document.getElementById('onboarding-photo-input').click();
                },

                editCurrentPhoto() {
                    if (this.originalSource) {
                        this.$dispatch('open-onboarding-photo-modal', {
                            preview: this.originalSource,
                            isReEdit: true
                        });
                    }
                },

                handleFileSelect(event) {
                    const file = event.target.files[0];
                    if (!file) return;

                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.originalSource = e.target.result; // Save as the new original
                        this.$dispatch('open-onboarding-photo-modal', {
                            preview: e.target.result,
                            file: file
                        });
                    };
                    reader.readAsDataURL(file);
                },

                handlePhotoCropped(event) {
                    this.croppedBlob = event.detail.blob;
                    this.photoPreview = event.detail.preview;
                    this.hasPhoto = true;

                    // Update hidden input for form submission
                    const file = new File([this.croppedBlob], 'profile_cropped.png', { type: 'image/png' });
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    document.getElementById('onboarding-photo-input').files = dataTransfer.files;

                    this.$dispatch('photo-updated', { hasPhoto: true });
                },

                removePhoto() {
                    this.hasPhoto = false;
                    this.photoPreview = null;
                    this.originalSource = null;
                    this.croppedBlob = null;
                    document.getElementById('onboarding-photo-input').value = '';
                    this.$dispatch('photo-updated', { hasPhoto: false });
                }
            }
        }
    </script>
</div>
