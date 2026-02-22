<div x-data="{ 
        show: false, 
        bio: '{{ addslashes(auth()->user()->bio ?? '') }}', 
        maxLength: 500,
        get remaining() {
            return this.maxLength - this.bio.length;
        }
     }" 
     @open-edit-bio-modal.window="show = true; bio = '{{ addslashes(auth()->user()->bio ?? '') }}';"
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
            <div class="px-6 py-4 border-b border-[#e8e8e7] flex items-center justify-between relative">
                <button type="button" @click="show = false" class="text-[#1447d4] hover:opacity-70 transition-opacity z-10">
                    <img src="{{ asset('images/close.svg') }}" class="w-6 h-6 brightness-0 [filter:invert(22%)_sepia(77%)_saturate(5734%)_hue-rotate(219deg)_brightness(85%)_contrast(95%)]" alt="Close">
                </button>
                <h3 class="absolute inset-0 flex items-center justify-center text-[18px] font-medium text-[#1e1d1d] pointer-events-none">
                    Edit bio
                </h3>
                <div class="w-6"></div> {{-- Spacer --}}
            </div>

            <div class="p-8">
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="redirect_to" value="{{ url()->current() }}">
                    
                    <div class="flex justify-between items-end mb-2">
                        <label for="bio" class="block text-[16px] font-medium text-[#1e1d1d]">Bio</label>
                        <span class="text-[14px] text-[#8c8c8c]" x-text="remaining + ' characters remaining'"></span>
                    </div>
                    
                    <textarea 
                        name="bio" 
                        id="bio" 
                        x-model="bio"
                        maxlength="500"
                        rows="6"
                        class="w-full px-4 py-4 border border-[#e8e8e7] rounded-[8px] focus:ring-1 focus:ring-[#1447d4] focus:border-[#1447d4] outline-none transition-colors text-[16px] text-[#1e1d1d] leading-[1.5] resize-none"
                        placeholder="Tell us about yourself..."
                    ></textarea>

                    {{-- Suggestion Box --}}
                    <div class="mt-6 p-4 bg-[#f9f9f8] rounded-[8px] flex items-start gap-3">
                        <img src="{{ asset('images/contact_support_blue.svg') }}" class="w-6 h-6 mt-0.5" alt="Info">
                        <p class="text-[14px] leading-[1.5] text-[#464646]">
                            <span class="font-medium text-[#1e1d1d]">Suggestion:</span> Share a bit about yourself—where you're from, whether you have any pets, and what you do for a living.
                        </p>
                    </div>

                    {{-- Actions --}}
                    <div class="mt-8">
                        <button type="submit" 
                                class="w-full h-[52px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px]">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>