@php
    $settings = auth()->user()?->notificationSettings;
@endphp

<x-modals.layout
    name="notification-preferences"
    title="Notification preferences"
    x-data="{
        show: false,
        loading: false,
        pushNotifications: {{ $settings?->push_enabled ? 'true' : 'false' }},
        emailNotifications: {{ $settings?->email_enabled ? 'true' : 'false' }},
        selectAll: false,
        marketing: {{ $settings?->marketing_enabled ? 'true' : 'false' }},
        announcements: {{ $settings?->announcements_enabled ? 'true' : 'false' }},
        newsletter: {{ $settings?->newsletter_enabled ? 'true' : 'false' }},

        init() {
            this.updateSelectAll();
        },

        toggleSelectAll() {
            this.marketing = this.selectAll;
            this.announcements = this.selectAll;
            this.newsletter = this.selectAll;
        },

        updateSelectAll() {
            this.selectAll = this.marketing && this.announcements && this.newsletter;
        },

        async saveSettings() {
            this.loading = true;
            try {
                const response = await fetch('{{ route('notification-settings.update') }}', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        push_enabled: this.pushNotifications,
                        email_enabled: this.emailNotifications,
                        marketing_enabled: this.marketing,
                        announcements_enabled: this.announcements,
                        newsletter_enabled: this.newsletter
                    })
                });

                if (response.ok) {
                    const data = await response.json();
                    this.$dispatch('notifications-updated', {
                        hasNotifications: data.settings.push_enabled ||
                                         data.settings.email_enabled ||
                                         data.settings.marketing_enabled ||
                                         data.settings.announcements_enabled ||
                                         data.settings.newsletter_enabled
                    });
                    this.$dispatch('show-toast', { message: 'Settings updated' });
                    this.show = false;
                } else {
                    console.error('Failed to save settings');
                }
            } catch (error) {
                console.error('Error saving settings:', error);
            } finally {
                this.loading = false;
            }
        },

        close() {
            this.show = false;
        }
     }"
>
    <div class="mb-[32px]">
        <h4 class="text-[18px] font-medium text-[#1e1d1d] mb-[12px]">Choose where you get notified</h4>
        <div class="space-y-4">
            {{-- Push Notifications --}}
            <div class="flex items-center gap-[12px]">
                <button @click="pushNotifications = !pushNotifications"
                        class="relative inline-flex h-[26px] w-[44px] shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                        :class="pushNotifications ? 'bg-[#1447d4]' : 'bg-[#e8e8e7]'">
                    <span class="pointer-events-none inline-block h-[20px] w-[20px] transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                          :class="pushNotifications ? 'translate-x-[19px]' : 'translate-x-[1px]'"></span>
                </button>
                <span class="text-[14px] text-[#1e1d1d] font-medium">Push notifications</span>
            </div>
            {{-- Email Notifications --}}
            <div class="flex items-center gap-[12px]">
                <button @click="emailNotifications = !emailNotifications"
                        class="relative inline-flex h-[26px] w-[44px] shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                        :class="emailNotifications ? 'bg-[#1447d4]' : 'bg-[#e8e8e7]'">
                    <span class="pointer-events-none inline-block h-[20px] w-[20px] transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                    :class="emailNotifications ? 'translate-x-[19px]' : 'translate-x-[1px]'"></span>
                </button>
                <span class="text-[14px] text-[#1e1d1d] font-medium">Email notifications</span>
            </div>
        </div>
    </div>

    <div>
        <h4 class="text-[18px] font-medium text-[#1e1d1d] mb-[12px]">Choose which notifications you receive</h4>
        <div class="space-y-4">
            {{-- Select All --}}
            <div class="flex items-center gap-[12px]">
                <button @click="selectAll = !selectAll; toggleSelectAll()"
                        class="relative inline-flex h-[26px] w-[44px] shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                        :class="selectAll ? 'bg-[#1447d4]' : 'bg-[#e8e8e7]'">
                    <span class="pointer-events-none inline-block h-[20px] w-[20px] transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                    :class="selectAll ? 'translate-x-[19px]' : 'translate-x-[1px]'"></span>
                </button>
                <span class="text-[14px] text-[#1e1d1d] font-medium">Select all</span>
            </div>
            {{-- Marketing --}}
            <div class="flex items-center gap-[12px]">
                <button @click="marketing = !marketing; updateSelectAll()"
                        class="relative inline-flex h-[26px] w-[44px] shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                        :class="marketing ? 'bg-[#1447d4]' : 'bg-[#e8e8e7]'">
                    <span class="pointer-events-none inline-block h-[20px] w-[20px] transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                          :class="marketing ? 'translate-x-[19px]' : 'translate-x-[1px]'"></span>
                </button>
                <span class="text-[14px] text-[#1e1d1d] font-medium">Marketing</span>
            </div>
            {{-- Announcements --}}
            <div class="flex items-center gap-[12px]">
                <button @click="announcements = !announcements; updateSelectAll()"
                        class="relative inline-flex h-[26px] w-[44px] shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                        :class="announcements ? 'bg-[#1447d4]' : 'bg-[#e8e8e7]'">
                    <span class="pointer-events-none inline-block h-[20px] w-[20px] transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                          :class="announcements ? 'translate-x-[19px]' : 'translate-x-[1px]'"></span>
                </button>
                <span class="text-[14px] text-[#1e1d1d] font-medium">Announcements & updates</span>
            </div>
            {{-- Monthly newsletter --}}
            <div class="flex items-center gap-[12px]">
                <button @click="newsletter = !newsletter; updateSelectAll()"
                        class="relative inline-flex h-[26px] w-[44px] shrink-0 cursor-pointer items-center rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none"
                        :class="newsletter ? 'bg-[#1447d4]' : 'bg-[#e8e8e7]'">
                    <span class="pointer-events-none inline-block h-[20px] w-[20px] transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                          :class="newsletter ? 'translate-x-[19px]' : 'translate-x-[1px]'"></span>
                </button>
                <span class="text-[14px] text-[#1e1d1d] font-medium">Monthly newsletter</span>
            </div>
        </div>
    </div>

    <div class="mt-[40px]">
        <button @click="saveSettings()"
                :disabled="loading"
                class="h-[51px] leading-[1.18] tracking-[-0.48px] w-full bg-[#1447d4] hover:bg-[#04247b] text-white font-medium rounded-[8px] transition-all text-[16px] flex items-center justify-center disabled:opacity-70">
            <span x-show="!loading">Save changes</span>
            <svg x-show="loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" style="display: none;">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
        </button>
    </div>
</x-modals.layout>
