<x-main-layout title="Onboarding - HopinHome">
    <div class="flex h-screen overflow-hidden bg-white" x-data="{ 
        photoPreview: null, 
        isLoading: false,
        triggerUpload() {
            this.$refs.photoInput.click();
        },
        handleFile(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.photoPreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        },
        upload() {
            const file = this.$refs.photoInput.files[0];
            const formData = new FormData();
            if (file) {
                formData.append('profile_photo', file);
            }

            this.isLoading = true;
            fetch('{{ route('onboarding.step3') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = data.redirect;
                }
            })
            .catch(err => {
                this.isLoading = false;
                console.error(err);
            });
        }
    }">
        <!-- Left Side -->
        <div class="w-full lg:w-1/2 flex flex-col p-8 lg:p-16 overflow-y-auto">
            <!-- Logo -->
            <div class="mb-12">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopinHome" class="h-8">
                </a>
            </div>

            <!-- Progress Bar -->
            <div class="w-full max-w-[560px] mb-16">
                <div class="h-1.5 w-full bg-[#e8e8e7] rounded-full overflow-hidden">
                    <div class="h-full bg-[#1447d4] rounded-full" style="width: 75%"></div>
                </div>
            </div>

            <!-- Heading -->
            <div class="max-w-[560px] w-full mx-auto lg:mx-0">
                <h1 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-2 leading-[1.28]">Upload a profile photo</h1>
                <p class="text-[16px] text-[#464646] mb-8 leading-[1.5]">This photo is visible only to property managers and helps them recognize you better.</p>

                <!-- Profile Picture Upload -->
                <div class="mb-6">
                    <label class="text-[14px] font-medium text-[#1e1d1d] block mb-2">Profile picture</label>
                    
                    <input type="file" x-ref="photoInput" @change="handleFile" class="hidden" accept="image/*">
                    
                    <div @click="triggerUpload" 
                        @dragover.prevent="$el.classList.add('border-[#1447d4]')" 
                        @dragleave.prevent="$el.classList.remove('border-[#1447d4]')"
                        @drop.prevent="
                            $el.classList.remove('border-[#1447d4]');
                            const file = $event.dataTransfer.files[0];
                            if (file) {
                                $refs.photoInput.files = $event.dataTransfer.files;
                                handleFile({ target: { files: [file] } });
                            }
                        "
                        class="w-full h-[204px] border-2 border-dashed border-[#e8e8e7] rounded-lg flex flex-col items-center justify-center cursor-pointer hover:border-[#1447d4] transition-all relative overflow-hidden group"
                        :class="photoPreview ? 'border-solid border-[#1447d4]' : ''">
                        
                        <template x-if="!photoPreview">
                            <div class="flex flex-col items-center">
                                <div class="w-[54px] h-[54px] bg-[#f9f9f8] rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-50 transition-colors">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 16V8M12 8L9 11M12 8L15 11M4 16.5V17.2C4 18.8802 4 19.7202 4.32698 20.362C4.6146 20.9265 5.07354 21.3854 5.63803 21.673C6.27976 22 7.11984 22 8.8 22H15.2C16.8802 22 17.7202 22 18.362 21.673C18.9265 21.3854 19.3854 20.9265 19.673 20.362C20 19.7202 20 18.8802 20 17.2V16.5M16 5.5C16 7.70914 14.2091 9.5 12 9.5C9.79086 9.5 8 7.70914 8 5.5C8 3.29086 9.79086 1.5 12 1.5C14.2091 1.5 16 3.29086 16 5.5Z" stroke="#1447D4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                                <p class="text-[16px] font-medium text-[#1e1d1d] mb-1">Tap to upload your photo</p>
                                <p class="text-[14px] text-[#464646]">Or simply drag your file here</p>
                            </div>
                        </template>

                        <template x-if="photoPreview">
                            <div class="w-full h-full flex items-center justify-center bg-gray-50">
                                <img :src="photoPreview" class="h-full w-auto object-contain">
                                <div class="absolute inset-0 bg-black bg-opacity-40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <p class="text-white font-medium">Change photo</p>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <!-- Suggestion Box -->
                <div class="flex items-start gap-4 p-5 bg-[#f9f9f8] rounded-lg mb-12">
                    <img src="{{ asset('images/contact_support_blue.svg') }}" alt="" class="w-7 h-7 shrink-0">
                    <p class="text-[14px] leading-[1.5] text-[#464646]">
                        <span class="font-medium text-[#1e1d1d]">Suggestion:</span>
                        Use an image where you are the only one in the frame so property managers can easily recognize you.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col lg:flex-row items-center gap-8">
                    <button @click="upload"
                    :disabled="isLoading"
                    class="w-full lg:w-40 bg-[#1447d4] text-white py-3.5 rounded-full font-medium text-[16px] tracking-[-0.48px] hover:bg-blue-800 transition-all flex justify-center items-center disabled:opacity-20">
                        <span x-show="!isLoading">Next</span>
                        <svg x-show="isLoading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </button>

                    <button @click="
                        isLoading = true;
                        fetch('{{ route('onboarding.step3') }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'success') {
                                window.location.href = data.redirect;
                            }
                        })
                    " class="text-[14px] text-[#464646] underline hover:text-[#1e1d1d] transition-colors">
                        Set up later
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Side (Blue) -->
        <div class="hidden lg:block w-1/2 bg-[#1447d4] relative">
            <div class="absolute inset-0 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('images/hopinhome_logo_white.svg') }}" alt="" class="w-full opacity-10 transform scale-150 rotate-[-15deg]">
            </div>
        </div>
    </div>
</x-main-layout>
