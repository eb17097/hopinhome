<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                <div class="w-1/4">
                    <x-manager.sidebar />
                </div>
                <div class="w-3/4 ml-8">
                    <h2 class="font-semibold text-3xl text-black leading-tight mb-4">
                        My profile
                    </h2>
                    <div class="relative">
                        <x-manager.profile-header />
                    </div>
                    <div class="mt-8">
                        <x-manager.setup-checklist />
                    </div>
                    <div class="mt-8">
                        <x-manager.reviews />
                    </div>
                    <div class="mt-8 flex justify-center">
                        <button class="bg-white border border-light-gray border-solid content-stretch flex gap-[6px] h-[52px] items-center justify-center min-w-[160px] px-[32px] py-[16px] rounded-[29.5px]">
                            <img alt="arrow downward" class="relative shrink-0 size-[17px]" src="{{ asset('images/arrow_downward.svg') }}">
                            <span class="font-medium leading-[1.22] not-italic relative shrink-0 text-[16px] text-black text-center tracking-[-0.48px]">Show all reviews</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
