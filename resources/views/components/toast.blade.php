<div x-data="{
    show: false,
    message: 'Settings updated',
    timeout: null,
    init() {
        const sessionStatus = '{{ session('status') }}';
        if (sessionStatus === 'profile-updated' || sessionStatus === 'profile-photo-updated') {
            this.showToast('Settings updated');
        }
    },
    showToast(message = 'Settings updated') {
        this.message = message;
        this.show = true;
        clearTimeout(this.timeout);
        this.timeout = setTimeout(() => {
            this.show = false;
        }, 3000);
    }
}"
@show-toast.window="showToast($event.detail.message)"
x-show="show"
x-transition:enter="transition ease-out duration-300"
x-transition:enter-start="opacity-0 translate-y-2"
x-transition:enter-end="opacity-100 translate-y-0"
x-transition:leave="transition ease-in duration-200"
x-transition:leave-start="opacity-100 translate-y-0"
x-transition:leave-end="opacity-0 translate-y-2"
class="fixed bottom-8 left-1/2 -translate-x-1/2 z-[100]"
style="display: none;"
>
    <div class="h-[77px] bg-white border border-[#e8e8e7] rounded-[8px] shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] px-[16px] py-[15px] flex items-center gap-[16px] w-[250px]">
        <div class="w-[46px] h-[46px] bg-[#F4F4F3] rounded-[6px] flex items-center justify-center">
            <img src="{{ asset('images/gray_bg_blue_check.svg') }}" class="w-[24px] h-[24px]" alt="Success">
        </div>
        <span class="leading-[1.28] tracking-[-0.36px] text-[18px] font-medium text-[#1e1d1d]" x-text="message"></span>
    </div>
</div>
