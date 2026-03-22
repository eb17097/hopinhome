@php
    $user = auth()->user();
    $notificationSettings = $user->notificationSettings;

    $hasPhone = !empty($user->phone);
    $hasBio = !empty($user->bio);
    $hasPhoto = !empty($user->profile_photo_url);
    $hasListing = $user->listings()->exists();
    $hasNotifications = $notificationSettings->push_enabled || $notificationSettings->email_enabled;

    $steps = [
        [
            'id' => 'phone',
            'label' => 'Verify your phone number',
            'completed' => $hasPhone,
            'action' => 'open-phone-modal',
            'description' => 'Security & communication'
        ],
        [
            'id' => 'bio',
            'label' => 'Write a bio',
            'completed' => $hasBio,
            'action' => 'open-edit-bio-modal',
            'description' => 'Help others know you'
        ],
        [
            'id' => 'photo',
            'label' => 'Upload a profile photo',
            'completed' => $hasPhoto,
            'action' => 'open-profile-photo-modal',
            'description' => 'Personalize your profile'
        ],
        [
            'id' => 'listing',
            'label' => 'Publish your first listing',
            'completed' => $hasListing,
            'action' => null, // Will be a direct link
            'url' => route('property_manager.listings.create'),
            'description' => 'Start renting out'
        ],
        [
            'id' => 'notifications',
            'label' => 'Enable notifications',
            'completed' => $hasNotifications,
            'action' => 'open-notification-preferences-modal',
            'description' => 'Stay updated on messages & news'
        ],
    ];
@endphp

<div x-data="{ 
        hasPhone: {{ $hasPhone ? 'true' : 'false' }},
        hasBio: {{ $hasBio ? 'true' : 'false' }},
        hasPhoto: {{ $hasPhoto ? 'true' : 'false' }},
        hasListing: {{ $hasListing ? 'true' : 'false' }},
        hasNotifications: {{ $hasNotifications ? 'true' : 'false' }},
        showCompleted: true,

        get completedCount() {
            return (this.hasPhone ? 1 : 0) +
                   (this.hasBio ? 1 : 0) +
                   (this.hasPhoto ? 1 : 0) +
                   (this.hasListing ? 1 : 0) +
                   (this.hasNotifications ? 1 : 0);
        },
        get progressPercent() {
            return (this.completedCount / 5) * 100;
        }
     }"
     x-show="completedCount < 5"
     x-cloak
     @notifications-updated.window="hasNotifications = $event.detail.hasNotifications"
     class="bg-white border border-light-gray rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] px-[16px] py-[28px]">
    
    <div class="flex justify-between items-center mb-[25px]">
        <h3 class="text-[18px] font-medium text-[#1e1d1d]">Setup checklist</h3>
        <div class="flex items-center gap-4">
            <span class="text-[14px] text-[#464646]" x-text="completedCount + '/5'"></span>
            <div class="w-[114px] bg-[#e8e8e7] rounded-full h-[6px] relative">
                <div class="bg-electric-blue h-full rounded-full transition-all duration-500" :style="'width: ' + progressPercent + '%'"></div>
            </div>
        </div>
    </div>

    <div class="space-y-[12px]">
        @foreach($steps as $step)
            @if($step['id'] === 'listing')
                <a href="{{ $step['url'] }}"
                   x-show="showCompleted || !hasListing"
                   :class="hasListing ? 'bg-[#f9f9f8] border-transparent' : 'bg-white border-light-gray'"
                   class="relative border rounded-[6px] px-[16px] py-[14px] flex items-center gap-[10px] cursor-pointer hover:bg-gray-50 transition-colors">
                    
                    <div x-show="!hasListing" class="w-6 h-6 rounded-full border border-light-gray flex items-center justify-center shrink-0">
                        <div class="w-5 h-5 rounded-full border border-light-gray/20"></div>
                    </div>
                    
                    <div x-show="hasListing" class="w-6 h-6 rounded-full bg-like-green flex items-center justify-center shrink-0">
                        <img alt="checkmark" class="h-4 w-4" src="{{ asset('images/checkmark.svg') }}">
                    </div>

                    <div class="flex-grow">
                        <span class="font-medium text-[16px] text-[#1e1d1d]">{{ $step['label'] }}</span>
                        <p x-show="!hasListing" class="text-[14px] text-[#464646]">{{ $step['description'] }}</p>
                    </div>
                    <img x-show="!hasListing" alt="info" class="absolute top-1/2 -translate-y-1/2 right-[16px] h-[22px] w-[22px]" src="{{ asset('images/info.svg') }}">
                </a>
            @else
                <div @click="{{ $step['action'] ? '$dispatch(\'' . $step['action'] . '\')' : '' }}"
                     x-show="showCompleted || !has{{ ucfirst($step['id']) }}"
                     :class="has{{ ucfirst($step['id']) }} ? 'bg-[#f9f9f8] border-transparent' : 'bg-white border-light-gray'"
                     class="relative border rounded-[6px] px-[16px] py-[14px] flex items-center gap-[10px] cursor-pointer hover:bg-gray-50 transition-colors">
                    
                    <div x-show="!has{{ ucfirst($step['id']) }}" class="w-6 h-6 rounded-full border border-light-gray flex items-center justify-center shrink-0">
                        <div class="w-5 h-5 rounded-full border border-light-gray/20"></div>
                    </div>
                    
                    <div x-show="has{{ ucfirst($step['id']) }}" class="w-6 h-6 rounded-full bg-like-green flex items-center justify-center shrink-0">
                        <img alt="checkmark" class="h-4 w-4" src="{{ asset('images/checkmark.svg') }}">
                    </div>

                    <div class="flex-grow">
                        <span class="font-medium text-[16px] text-[#1e1d1d]">{{ $step['label'] }}</span>
                        <p x-show="!has{{ ucfirst($step['id']) }}" class="text-[14px] text-[#464646]">{{ $step['description'] }}</p>
                    </div>
                    <img x-show="!has{{ ucfirst($step['id']) }}" alt="info" class="absolute top-1/2 -translate-y-1/2 right-[16px] h-[22px] w-[22px]" src="{{ asset('images/info.svg') }}">
                </div>
            @endif
        @endforeach
    </div>

    <div class="text-center mt-[24px]">
        <button @click="showCompleted = !showCompleted" 
                class="text-[14px] text-[#464646] underline hover:text-black transition-colors"
                x-text="showCompleted ? 'Hide completed steps' : 'Show completed steps'">
        </button>
    </div>
</div>
