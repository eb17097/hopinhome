<div x-data="{ 
        hasNotifications: {{ (auth()->user()?->notificationSettings?->push_enabled || auth()->user()?->notificationSettings?->email_enabled) ? 'true' : 'false' }} 
     }"
     @notifications-updated.window="hasNotifications = $event.detail.hasNotifications"
     class="bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] px-[16px] py-[28px]">
    <div class="flex justify-between items-center mb-[25px]">
        <h3 class="text-[18px] font-medium text-[#1e1d1d]">Setup checklist</h3>
        <div class="flex items-center gap-4">
            <span class="text-[14px] text-[#464646]" x-text="hasNotifications ? '5/5' : '4/5'">4/5</span>
            <div class="w-[114px] bg-[#e8e8e7] rounded-full h-[6px]">
                <div class="bg-electric-blue h-[6px] rounded-full transition-all duration-500" :style="hasNotifications ? 'width: 100%' : 'width: 80%'"></div>
            </div>
        </div>
    </div>
    <div class="space-y-[12px]">
        @php
            $completedSteps = [
                'Verify your phone number',
                'Write a bio',
                'Upload a profile photo',
                'Publish your first listing',
            ];
        @endphp

        @foreach($completedSteps as $step)
            <div @if($step === 'Upload a profile photo') @click="$dispatch('open-profile-photo-modal')"
                 @elseif($step === 'Write a bio') @click="$dispatch('open-edit-bio-modal')" @endif
                 class="bg-[#f9f9f8] rounded-[6px] p-4 flex items-center gap-4 {{ in_array($step, ['Upload a profile photo', 'Write a bio']) ? 'cursor-pointer hover:bg-gray-100' : '' }} transition-colors">
                <div class="w-6 h-6 rounded-full bg-like-green flex items-center justify-center shrink-0">
                    <img alt="checkmark" class="h-4 w-4" src="{{ asset('images/checkmark.svg') }}">
                </div>
                <span class="font-medium text-[16px] text-[#1e1d1d]">{{ $step }}</span>
            </div>
        @endforeach

        <div @click="$dispatch('open-notification-preferences-modal')"
             :class="hasNotifications ? 'bg-[#f9f9f8] border-transparent' : 'bg-white border-light-gray'"
             class="relative border rounded-[6px] px-[16px] py-[14px] flex items-center gap-[10px] cursor-pointer hover:bg-gray-50 transition-colors">
            
            <template x-if="!hasNotifications">
                <div class="w-6 h-6 rounded-full border border-light-gray flex items-center justify-center shrink-0">
                    <div class="w-5 h-5 rounded-full border border-light-gray/20"></div>
                </div>
            </template>
            
            <template x-if="hasNotifications">
                <div class="w-6 h-6 rounded-full bg-like-green flex items-center justify-center shrink-0">
                    <img alt="checkmark" class="h-4 w-4" src="{{ asset('images/checkmark.svg') }}">
                </div>
            </template>

            <div class="flex-grow">
                <span class="font-medium text-[16px] text-[#1e1d1d]">Enable notifications</span>
                <p x-show="!hasNotifications" class="text-[14px] text-[#464646]">Stay updated on messages & news</p>
            </div>
            <img x-show="!hasNotifications" alt="info" class="absolute top-1/2 -translate-y-1/2 right-[16px] h-[22px] w-[22px]" src="{{ asset('images/info.svg') }}">
        </div>
    </div>
    <div class="text-center mt-[24px]">
        <button class="text-[14px] text-[#464646] underline hover:text-black transition-colors">Hide completed steps</button>
    </div>
</div>
