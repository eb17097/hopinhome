@props([
    'title' => 'Onboarding - HopinHome',
    'step',
    'totalSteps' => 4,
    'backUrl' => null,
])

<x-main-layout :title="$title">
    <div class="flex h-screen overflow-hidden bg-white" {{ $attributes }}>
        <!-- Left Side -->
        <div class="w-1/2 flex flex-col p-8 pb-[64px] justify-between items-center overflow-y-auto">
            <div class="w-full max-w-[560px] mb-16">
                <!-- Logo & Back Button -->
                <div class="mb-[18px] flex items-center gap-6">
                    @if($backUrl)
                        <a href="{{ $backUrl }}" class="hover:opacity-70 transition-opacity">
                            <img src="{{ asset('images/arrow_left_blue.svg') }}" alt="Back" class="w-[25px] h-[25px]">
                        </a>
                    @endif
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopinHome" class="h-[24px]">
                    </a>
                </div>
                <!-- Progress Bar -->
                <div class="h-1.5 w-full bg-[#e8e8e7] rounded-full overflow-hidden">
                    <div class="h-full bg-[#1447d4] rounded-full transition-all duration-500" style="width: {{ ($step / $totalSteps) * 100 }}%"></div>
                </div>
            </div>

            <!-- Content Area -->
            <div class="max-w-[560px] w-full mx-auto lg:mx-0">
                {{ $slot }}
            </div>

            <!-- Next Button / Actions -->
            @if(isset($actions))
                <div class="max-w-[560px] w-full pt-8 flex flex-col">
                    {{ $actions }}
                </div>
            @else
                {{-- Spacer to maintain layout if no actions provided --}}
                <div class="h-12"></div>
            @endif
        </div>

        <!-- Right Side (Blue) -->
        <div class="hidden lg:block w-1/2 bg-[#1447d4] relative overflow-hidden">
            <div style="bottom:-20%; right:-25%; width: 120%;" class="absolute opacity-10">
                <img src="{{ asset('images/hopinhome_symbol_white.svg') }}" alt="" class="w-full h-auto" style="max-height: 80vh;">
            </div>
        </div>
    </div>
</x-main-layout>
