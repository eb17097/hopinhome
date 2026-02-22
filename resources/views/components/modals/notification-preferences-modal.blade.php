<div x-data="{ 
        show: false,
        pushNotifications: true,
        emailNotifications: false,
        selectAll: false,
        marketing: true,
        announcements: false,
        newsletter: false,
        toggleSelectAll() {
            this.marketing = this.selectAll;
            this.announcements = this.selectAll;
            this.newsletter = this.selectAll;
        },
        updateSelectAll() {
            this.selectAll = this.marketing && this.announcements && this.newsletter;
        }
     }" 
     @open-notification-preferences-modal.window="show = true"
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
             class="inline-block w-full max-w-[444px] my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] rounded-[14px]">
            
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-[#e8e8e7] flex items-center justify-between relative">
                <button @click="show = false" class="text-[#1447d4] hover:opacity-70 transition-opacity z-10">
                    <img src="{{ asset('images/close.svg') }}" class="w-6 h-6 brightness-0 [filter:invert(22%)_sepia(77%)_saturate(5734%)_hue-rotate(219deg)_brightness(85%)_contrast(95%)]" alt="Close">
                </button>
                <h3 class="absolute inset-0 flex items-center justify-center text-[18px] font-medium text-[#1e1d1d] pointer-events-none">
                    Notification preferences
                </h3>
                <div class="w-6"></div>
            </div>

            <div class="p-8">
                <div class="mb-8">
                    <h4 class="text-[18px] font-medium text-[#1e1d1d] mb-4">Choose where you get notified</h4>
                    <div class="space-y-4">
                        {{-- Push Notifications --}}
                        <div class="flex items-center justify-between">
                            <span class="text-[16px] text-[#1e1d1d]">Push notifications</span>
                            <button @click="pushNotifications = !pushNotifications" 
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                                    :class="pushNotifications ? 'bg-[#1447d4]' : 'bg-[#e8e8e7]'">
                                <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                      :class="pushNotifications ? 'translate-x-5' : 'translate-x-0'"></span>
                            </button>
                        </div>
                        {{-- Email Notifications --}}
                        <div class="flex items-center justify-between">
                            <span class="text-[16px] text-[#1e1d1d]">Email notifications</span>
                            <button @click="emailNotifications = !emailNotifications" 
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                                    :class="emailNotifications ? 'bg-[#1447d4]' : 'bg-[#e8e8e7]'">
                                <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                      :class="emailNotifications ? 'translate-x-5' : 'translate-x-0'"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="text-[18px] font-medium text-[#1e1d1d] mb-4">Choose which notifications you receive</h4>
                    <div class="space-y-4">
                        {{-- Select All --}}
                        <div class="flex items-center justify-between">
                            <span class="text-[16px] text-[#1e1d1d]">Select all</span>
                            <button @click="selectAll = !selectAll; toggleSelectAll()" 
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                                    :class="selectAll ? 'bg-[#1447d4]' : 'bg-[#e8e8e7]'">
                                <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                      :class="selectAll ? 'translate-x-5' : 'translate-x-0'"></span>
                            </button>
                        </div>
                        {{-- Marketing --}}
                        <div class="flex items-center justify-between">
                            <span class="text-[16px] text-[#1e1d1d]">Marketing</span>
                            <button @click="marketing = !marketing; updateSelectAll()" 
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                                    :class="marketing ? 'bg-[#1447d4]' : 'bg-[#e8e8e7]'">
                                <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                      :class="marketing ? 'translate-x-5' : 'translate-x-0'"></span>
                            </button>
                        </div>
                        {{-- Announcements --}}
                        <div class="flex items-center justify-between">
                            <span class="text-[16px] text-[#1e1d1d]">Announcements & updates</span>
                            <button @click="announcements = !announcements; updateSelectAll()" 
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                                    :class="announcements ? 'bg-[#1447d4]' : 'bg-[#e8e8e7]'">
                                <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                      :class="announcements ? 'translate-x-5' : 'translate-x-0'"></span>
                            </button>
                        </div>
                        {{-- Monthly newsletter --}}
                        <div class="flex items-center justify-between">
                            <span class="text-[16px] text-[#1e1d1d]">Monthly newsletter</span>
                            <button @click="newsletter = !newsletter; updateSelectAll()" 
                                    class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                                    :class="newsletter ? 'bg-[#1447d4]' : 'bg-[#e8e8e7]'">
                                <span class="pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                      :class="newsletter ? 'translate-x-5' : 'translate-x-0'"></span>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <button @click="show = false" 
                            class="w-full h-[52px] bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px]">
                        Save changes
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>