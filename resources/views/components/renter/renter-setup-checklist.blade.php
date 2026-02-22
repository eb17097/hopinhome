@php
    $user = auth()->user();
    $settings = $user->notificationSettings;
    
    $hasPhoto = $user->profile_photo_url ? true : false;
    $hasBio = !empty($user->bio);
    $hasEmailVerified = $user->hasVerifiedEmail();
    
    $initialNotifications = $settings && (
        $settings->push_enabled || 
        $settings->email_enabled || 
        $settings->marketing_enabled || 
        $settings->announcements_enabled || 
        $settings->newsletter_enabled
    );
@endphp

<div x-data="{ 
        hasPhoto: {{ $hasPhoto ? 'true' : 'false' }},
        hasBio: {{ $hasBio ? 'true' : 'false' }},
        hasEmailVerified: true,
        hasNotifications: {{ $initialNotifications ? 'true' : 'false' }},
        get completedCount() {
            return (this.hasEmailVerified ? 1 : 0) + 
                   (this.hasBio ? 1 : 0) + 
                   (this.hasPhoto ? 1 : 0) + 
                   (this.hasNotifications ? 1 : 0);
        },
        get progressPercent() {
            return (this.completedCount / 4) * 100;
        }
     }"
     @notifications-updated.window="hasNotifications = $event.detail.hasNotifications"
     class="bg-white border border-[#e8e8e7] rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] p-6">
    
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-[18px] font-medium text-[#1e1d1d] tracking-[-0.36px]">Setup checklist</h3>
        <div class="flex items-center gap-3">
            <span class="text-[14px] text-[#464646]" x-text="completedCount + '/4'"></span>
            <div class="w-[110px] bg-[#e8e8e7] rounded-full h-[6px] relative">
                <div class="bg-[#1447d4] h-full rounded-full transition-all duration-500" :style="'width: ' + progressPercent + '%'"></div>
            </div>
        </div>
    </div>

    <div class="space-y-3">
        {{-- Email Verification (Static for now as it usually requires a reload/new tab) --}}
        <div class="bg-[#f9f9f8] rounded-[4px] h-[55px] px-4 flex items-center gap-4">
            <img alt="checkmark" class="w-[23px] h-[23px]" src="{{ asset('images/white_checkmark_on_green.svg') }}">
            <span class="font-medium text-[16px] text-[#1e1d1d]">Verify your email address</span>
        </div>

        {{-- Bio --}}
        <div @click="$dispatch('open-edit-bio-modal')" 
             class="rounded-[4px] h-[55px] px-4 flex items-center gap-4 cursor-pointer hover:bg-gray-100 transition-colors"
             :class="hasBio ? 'bg-[#f9f9f8]' : 'bg-white border border-[#e8e8e7]'">
            <template x-if="hasBio">
                <img alt="checkmark" class="w-[23px] h-[23px]" src="{{ asset('images/white_checkmark_on_green.svg') }}">
            </template>
            <template x-if="!hasBio">
                <div class="w-[23px] h-[23px] rounded-full border border-[#e8e8e7]"></div>
            </template>
            <span class="font-medium text-[16px] text-[#1e1d1d]">Write a bio</span>
        </div>

        {{-- Photo --}}
        <div @click="$dispatch('open-profile-photo-modal')" 
             class="rounded-[4px] h-[55px] px-4 flex items-center gap-4 cursor-pointer hover:bg-gray-100 transition-colors"
             :class="hasPhoto ? 'bg-[#f9f9f8]' : 'bg-white border border-[#e8e8e7]'">
            <template x-if="hasPhoto">
                <img alt="checkmark" class="w-[23px] h-[23px]" src="{{ asset('images/white_checkmark_on_green.svg') }}">
            </template>
            <template x-if="!hasPhoto">
                <div class="w-[23px] h-[23px] rounded-full border border-[#e8e8e7]"></div>
            </template>
            <span class="font-medium text-[16px] text-[#1e1d1d]">Upload a profile photo</span>
        </div>

        {{-- Notifications --}}
        <div @click="$dispatch('open-notifications-modal')" 
             class="rounded-[4px] h-[73px] px-4 flex items-center gap-4 cursor-pointer hover:bg-gray-100 transition-colors"
             :class="hasNotifications ? 'bg-[#f9f9f8]' : 'bg-white border border-[#e8e8e7]'">
            <template x-if="hasNotifications">
                <img alt="checkmark" class="w-[23px] h-[23px]" src="{{ asset('images/white_checkmark_on_green.svg') }}">
            </template>
            <template x-if="!hasNotifications">
                <div class="w-[23px] h-[23px] rounded-full border border-[#e8e8e7]"></div>
            </template>
            <div class="flex-grow">
                <span class="font-medium text-[16px] text-[#1e1d1d]">Enable notifications</span>
                <p class="text-[14px] text-[#464646]">Stay updated on messages & news</p>
            </div>
            <img alt="info" class="w-[22px] h-[22px]" src="{{ asset('images/info.svg') }}">
        </div>
    </div>

    <div class="text-center mt-6">
        <button class="text-[14px] text-[#464646] underline decoration-solid">Hide completed steps</button>
    </div>
</div>
