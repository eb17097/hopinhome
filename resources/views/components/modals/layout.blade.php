@props([
    'name',
    'title' => '',
    'maxWidth' => '444px',
    'closeIcon' => 'images/close_blue.svg',
    'paddingClass' => 'pt-[32px] pb-[40px] px-[24px]'
])

<div x-show="show"
     x-on:keydown.escape.window="close()"
     class="fixed inset-0 z-[60] overflow-y-auto"
     style="display: none;"
     {{ $attributes->merge(['x-on:open-'.$name.'-modal.window' => 'show = true']) }}>

    <div class="flex items-center justify-center min-h-screen px-4 py-4 text-center">
        {{-- Background overlay --}}
        <div x-show="show"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="close()"
             class="fixed inset-0 transition-opacity bg-black bg-opacity-40"></div>

        {{-- Modal panel --}}
        <div x-show="show"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             class="inline-block w-full max-w-[{{ $maxWidth }}] overflow-hidden text-left align-middle transition-all transform bg-white shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)] rounded-[14px] relative z-10">

            {{-- Header --}}
            <div class="h-[66px] px-6 py-4 border-b border-[#e8e8e7] flex items-center justify-between relative">
                <button @click="close()" class="text-[#1447d4] hover:opacity-70 transition-opacity z-10">
                    <img src="{{ asset($closeIcon) }}" class="w-[25px] h-[25px]" alt="Close">
                </button>
                <h3 class="absolute inset-0 flex items-center justify-center text-[18px] font-medium text-[#1e1d1d] pointer-events-none">
                    {{ $title }}
                </h3>
                <div class="w-6"></div>
            </div>

            {{-- Content --}}
            <div class="{{ $paddingClass }}">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
