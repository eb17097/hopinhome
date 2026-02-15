<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Apartments for Rent in Dubai - HopInHome</title>

    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@200,300,400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body { font-family: 'General Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">

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

</body>
</html>
