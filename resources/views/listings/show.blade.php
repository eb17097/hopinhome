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
    @include('listings.partials.listing-content')
</main>

<x-footer />

</body>
</html>