@props([
    'title' => '',
    'showBack' => false,
    'backStep' => 'email',
    'onClose' => 'showModal = false'
])

<div {{ $attributes->merge(['class' => 'bg-white relative']) }}>
    <!-- Header -->
    <div class="px-[24px] py-[21px] border-b border-[#e8e8e7] flex items-center justify-between relative">
        @if($showBack)
            <button @click="step = '{{ $backStep }}'; error = ''; passwordError = ''; otpError = ''; otpSuccessMessage = ''; clearInterval(resendInterval); resendTimer = 60; registerError = ''; verifyCode = ['', '', '', '', '', '']" 
                    class="absolute left-[24px] text-[#1e1d1d] hover:opacity-70 transition-opacity z-10">
                <img src="{{ asset('images/close_blue.svg') }}" class="w-6 h-6" alt="Back">
            </button>
        @else
            <button @click="{{ $onClose }}" class="text-[#1e1d1d] hover:opacity-70 transition-opacity z-10">
                <img src="{{ asset('images/close_blue.svg') }}" class="w-6 h-6" alt="Close">
            </button>
        @endif
        
        <h2 class="absolute inset-0 flex items-center justify-center text-[18px] font-medium text-[#1e1d1d] pointer-events-none">
            {{ $title }}
        </h2>
    </div>

    <!-- Content -->
    <div class="px-[24px] pt-[32px] pb-[40px]">
        {{ $slot }}
    </div>
</div>
