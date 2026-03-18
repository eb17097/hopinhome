<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $listing->name }} - HopInHome</title>

    @php
        $firstImage = $listing->images->first();
        $imageUrl = $firstImage ? (str_starts_with($firstImage->image_url, 'http') ? $firstImage->image_url : asset('storage/' . $firstImage->image_url)) : asset('images/about_landing_img.png');
        $description = ($listing->bedrooms ? $listing->bedrooms . ' beds • ' : '') . ($listing->bathrooms ? $listing->bathrooms . ' bath • ' : '') . ($listing->area ? $listing->area . ' sqft. ' : '') . 'Check out this property on HopInHome.';
    @endphp

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ route('listings.show', $listing) }}">
    <meta property="og:title" content="{{ $listing->name }} - HopInHome">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ $imageUrl }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ route('listings.show', $listing) }}">
    <meta property="twitter:title" content="{{ $listing->name }} - HopInHome">
    <meta property="twitter:description" content="{{ $description }}">
    <meta property="twitter:image" content="{{ $imageUrl }}">

    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@200,300,400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body { font-family: 'General Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">

<x-header />

<main>
    <div class="max-w-[1204px] mt-[40px] mx-auto">

        <x-listings.show.breadcrumbs :listing="$listing" />

        <x-listings.show.header :listing="$listing" />
        <x-listings.show.gallery :listing="$listing" />

        <div class="flex gap-x-[72px] mt-[32px]">
            {{-- Main Content --}}
            <div class="w-[742px]">
                <x-listings.show.details :listing="$listing" />
                <hr class="my-[40px] border-[#E8E8E7]">
                <x-listings.show.about :listing="$listing" />
                <hr class="my-[40px] border-[#E8E8E7]">
                <x-listings.show.amenities :listing="$listing" />
                <hr class="my-[40px] border-[#E8E8E7]">
                <x-listings.show.location :listing="$listing" />
                <hr class="my-[40px] border-[#E8E8E7]">
                <x-listings.show.regulatory-info :listing="$listing" />
            </div>

            {{-- Sidebar --}}
            <div class="w-[390px]">
                <div class="sticky top-[120px] flex flex-col gap-[24px]">
                    <x-listings.show.booking-card :listing="$listing" />
                    @if ($listing->user && $listing->user->is_agent)
                        <x-listings.show.agent-card :listing="$listing" />
                    @else
                        <x-listings.show.owner-card :listing="$listing" />
                    @endif
                </div>
            </div>
        </div>

    </div>

    <x-listings.show.similar-listings :listing="$listing" />

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-[96px]">
        <div class="flex gap-x-[60px]">
            <div class="w-[746px]">
                <x-listings.faq-section />
            </div>
        </div>
    </div>

    <x-modals.report-listing-modal :listing="$listing" />
    <x-modals.share-listing-modal :listing="$listing" />

</main>

<x-footer />

</body>
</html>
