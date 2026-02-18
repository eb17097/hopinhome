<x-main-layout title="Apartments for Rent in Dubai - HopInHome">

<x-header />

<x-listings.search-filters />

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <x-listings.heading-section />

    <x-listings.area-filters />

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

        <div class="lg:col-span-8">

            <x-listings.listings-header />

            <div class="space-y-6">

                @foreach($listings as $listing)
                    <x-listings.listing-card :listing="$listing" />
                @endforeach

                <x-listings.show-more-button />

            </div>
        </div>

        <div class="lg:col-span-4 space-y-8">

            <x-listings.we-got-your-back />

            <x-listings.recommended-for-you />

            <x-listings.popular-searches />

        </div>

    </div>
</div>

<x-listings.find-ideal-home />
<div>
    <div class="bg-white pb-20 pt-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                <div class="lg:col-span-8 space-y-12">
                    <x-listings.why-rent-in-dubai />
                    <x-listings.popular-areas />
                    <x-listings.faq-section />
                </div>
                <div class="lg:col-span-4">
                    <x-listings.uae-insights-section />
                </div>
            </div>
        </div>
    </div>

</div>

<x-footer />

</x-main-layout>
