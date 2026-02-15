<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $listing->name }} - HopInHome</title>

    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@200,300,400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body { font-family: 'General Sans', sans-serif; }
        .sticky-card {
            position: sticky;
            top: 120px; /* Adjust based on header height */
        }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">

<x-header />

<main class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <x-listings.show.header :listing="$listing" />
        <x-listings.show.gallery :listing="$listing" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 mt-8">
            {{-- Main Content --}}
            <div class="lg:col-span-2">
                <x-listings.show.details :listing="$listing" />
                <hr class="my-8">
                <x-listings.show.about :listing="$listing" />
                <hr class="my-8">
                <x-listings.show.amenities :listing="$listing" />
                <hr class="my-8">
                <x-listings.show.location :listing="$listing" />
                <hr class="my-8">
                <x-listings.show.regulatory-info :listing="$listing" />
            </div>

            {{-- Sidebar --}}
            <div>
                <x-listings.show.booking-card :listing="$listing" />
            </div>
        </div>

        <hr class="my-12">

        <x-listings.show.similar-listings :listing="$listing" />

        <x-listings.faq-section />
    </div>

</main>

<x-footer />

</body>
</html>
