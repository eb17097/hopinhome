<div x-data="{ show: false, photoPreview: null }" 
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
                <h3 class="text-[18px] font-medium text-[#1e1d1d]">Change profile picture</h3>
                <div class="w-6"></div> {{-- Spacer --}}
            </div>

            <div class="p-8">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
                    
                    <label class="block text-[16px] font-medium text-[#1e1d1d] mb-4">Profile picture</label>
                    
                    {{-- Upload Area --}}
                    <div class="relative">
                        <input type="file" name="photo" id="photo" class="hidden" accept="image/*" 
                               @change="const file = $event.target.files[0]; if (file) { const reader = new FileReader(); reader.onload = (e) => { photoPreview = e.target.result; }; reader.readAsDataURL(file); }">
                        
                        <label for="photo" class="flex flex-col items-center justify-center w-full h-[240px] border-2 border-dashed border-[#1447d4] rounded-[8px] cursor-pointer hover:bg-blue-50 transition-colors overflow-hidden">
                            <template x-if="!photoPreview">
                                <div class="flex flex-col items-center">
                                    <div class="w-12 h-12 bg-[#f0f4ff] rounded-full flex items-center justify-center mb-4 text-[#1447d4]">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                        </svg>
                                    </div>
                                    <p class="text-[18px] font-medium text-[#1e1d1d] mb-1">Tap to upload your photo</p>
                                    <p class="text-[14px] text-[#464646]">Or simply drag your file here</p>
                                </div>
                            </template>
                            <template x-if="photoPreview">
                                <img :src="photoPreview" class="w-full h-full object-cover">
                            </template>
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
                        <button type="submit" 
                                :disabled="!photoPreview"
                                :class="photoPreview ? 'bg-[#1447d4] hover:bg-[#04247b]' : 'bg-[#1447d4] opacity-20 cursor-not-allowed'"
                                class="w-full h-[48px] text-white font-medium rounded-full transition-all text-[16px]">
                            Next
                        </button>
                        <button type="button" @click="show = false" class="w-full text-center text-[14px] font-medium text-[#464646] underline decoration-solid">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>