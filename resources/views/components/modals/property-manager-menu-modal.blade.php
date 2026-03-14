<div x-data="{ open: false }" 
     @open-property-manager-menu.window="open = true"
     @keydown.escape.window="open = false"
     x-show="open" 
     x-cloak
     class="fixed inset-0 z-[100] overflow-y-auto" 
     aria-labelledby="modal-title" 
     role="dialog" 
     aria-modal="true">
    
    {{-- Backdrop --}}
    <div x-show="open" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="open = false" 
         class="fixed inset-0 bg-black bg-opacity-10 transition-opacity"></div>

    <div class="flex min-h-full items-start justify-end p-4 text-center sm:p-0">
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-[-20px]"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-[-20px]"
             class="relative transform overflow-hidden rounded-[8px] bg-white text-left shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] transition-all sm:my-[74px] sm:mr-6 w-full max-w-[326px] p-6 border border-light-gray">
            
            <div class="flex flex-col gap-4">
                {{-- Settings Section --}}
                <div class="flex flex-col">
                    <p class="text-[12px] font-medium text-[#464646] mb-1">Settings</p>
                    <div class="flex flex-col">
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-[10px] py-[10px] rounded-[4px] hover:bg-gray-50 transition-colors">
                            <img src="{{ asset('images/account_circle.svg') }}" class="w-[18px] h-[18px]" alt="">
                            <span class="text-[16px] font-medium text-[#1e1d1d]">Profile settings</span>
                        </a>
                        <button @click.prevent="$dispatch('open-regional-preferences-modal'); open = false" class="flex items-center gap-[10px] py-[10px] rounded-[4px] hover:bg-gray-50 transition-colors text-left w-full">
                            <img src="{{ asset('images/language_sidebar.svg') }}" class="w-[18px] h-[18px]" alt="">
                            <span class="text-[16px] font-medium text-[#1e1d1d]">Regional preferences</span>
                        </button>
                    </div>
                </div>

                {{-- Articles Section --}}
                <div class="flex flex-col">
                    <p class="text-[12px] font-medium text-[#464646] mb-1">Articles</p>
                    <div class="flex flex-col">
                        <a href="#" class="py-[10px] rounded-[4px] hover:bg-gray-50 transition-colors text-[16px] font-medium text-[#1e1d1d]">Insights</a>
                        <a href="#" class="py-[10px] rounded-[4px] hover:bg-gray-50 transition-colors text-[16px] font-medium text-[#1e1d1d]">News</a>
                        <a href="#" class="py-[10px] rounded-[4px] hover:bg-gray-50 transition-colors text-[16px] font-medium text-[#1e1d1d]">Community articles</a>
                        <a href="#" class="py-[10px] rounded-[4px] hover:bg-gray-50 transition-colors text-[16px] font-medium text-[#1e1d1d]">Tips & Resources</a>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex flex-col gap-4 mt-2">
                    <a href="{{ route('home') }}" class="bg-electric-blue text-white font-medium h-[51px] rounded-[6px] flex items-center justify-center gap-[6px] hover:opacity-90 transition-all text-[16px] tracking-[-0.48px]">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="brightness-0 invert">
                            <path d="M19 8l-4 4h3c0 3.31-2.69 6-6 6-1.01 0-1.97-.25-2.8-.7l-1.46 1.46C8.97 19.54 10.43 20 12 20c4.42 0 8-3.58 8-8h3l-4-4zM6 12c0-3.31 2.69-6 6-6 1.01 0 1.97.25 2.8.7l1.46-1.46C15.03 4.46 13.57 4 12 4c-4.42 0-8 3.58-8 8H1l4 4 4-4H6z" fill="currentColor"/>
                        </svg>
                        Switch to renter
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="border border-light-gray bg-white text-[#1e1d1d] font-medium h-[51px] rounded-[6px] flex items-center justify-center hover:bg-gray-50 transition-all text-[16px] tracking-[-0.48px] w-full">
                            Sign out
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
