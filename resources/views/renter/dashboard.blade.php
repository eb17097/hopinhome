<x-renter-layout>
    <div class="max-w-7xl mx-auto py-12 sm:px-6 lg:px-8">
        <div class="flex">
            <div class="w-1/4">
                <x-renter.renter-sidebar />
            </div>
            <div class="w-3/4 pl-12">
                <h2 class="text-3xl font-medium text-black tracking-tight mb-6">
                    My profile
                </h2>
                <div class="space-y-8">
                    <x-renter.renter-profile-header />
                    <x-renter.renter-setup-checklist />
                    <x-renter.renter-reviews />
                    <div class="flex justify-center">
                        <button class="bg-white border border-light-gray rounded-full flex items-center gap-2 h-12 px-8">
                            <img alt="arrow downward" class="h-4 w-4" src="{{ asset('images/arrow_downward.svg') }}">
                            <span class="font-medium text-base text-black">Show all reviews</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-renter-layout>

