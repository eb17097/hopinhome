<x-main-layout title="Apartments for Rent in Dubai - HopInHome">

<x-header />

<x-listings.search-filters />

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-[40px] pb-[96px]">

    <x-listings.heading-section />

    <x-listings.area-filters />

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

        <div class="lg:col-span-8">

            <x-listings.listings-header />

            <div class="space-y-6">

                @foreach($listings as $listing)
                    <x-listings.listing-card :listing="$listing" />
                @endforeach

                <x-listings.show-more-button />

            </div>
        </div>

        <div style="margin-top:69px;" class="lg:col-span-4">

            <x-listings.we-got-your-back />

            <x-listings.recommended-for-you />

            <x-listings.popular-searches />

        </div>

    </div>
</div>

<x-listings.find-ideal-home />
<div>
    <div class="bg-white pb-[128px] pt-[96px]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex gap-[80px]">
                <div class="w-[744px]">
                    <x-listings.why-rent-in-dubai />
                    <x-listings.popular-areas />
                    <div class="pt-[96px]">
                        <x-listings.faq-section />
                    </div>
                </div>
                <div class="w-[380px]">
                    <x-listings.uae-insights-section />
                </div>
            </div>
        </div>
    </div>

</div>

<x-footer />

</x-main-layout>
