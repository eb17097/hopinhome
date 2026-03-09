@props(['title'])

<div class="bg-white">
    <div class="max-w-[1204px] mx-auto flex min-h-screen">
        {{-- Left Sidebar --}}
        <aside class="w-[320px] shrink-0 pt-[40px] pr-[16px]">
            <x-renter.renter-sidebar />
        </aside>

        {{-- Vertical Divider --}}
        <div class="w-px bg-[#e8e8e7] self-stretch"></div>

        {{-- Main Content --}}
        <main {{ $attributes->merge(['class' => 'flex-1 ml-[24px] pt-[40px] max-w-[567px]']) }}>
            @isset($title)
                <h2 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px] mb-[24px] leading-[1.28]">
                    {{ $title }}
                </h2>
            @endisset

            {{ $slot }}
        </main>
    </div>
</div>
