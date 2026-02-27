@props(['user', 'reviews', 'listings'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $user->name }} - Property Manager Profile</title>
    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@200,300,400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'General Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">

<x-header />

<main class="max-w-[1440px] mx-auto px-8 lg:px-[120px] pt-[60px] pb-20">
    
    <div class="max-w-[792px] ml-[84px]">
        {{-- Profile Header --}}
        <x-profile.public.header :user="$user" />

        {{-- Stats Bar --}}
        <div class="mt-8">
            <x-profile.public.stats-bar :user="$user" />
        </div>

        {{-- Bio --}}
        <div class="mt-8 text-[16px] text-[#1e1d1d] leading-[1.5]">
            <p>{{ $user->bio }}</p>
        </div>

        {{-- Verification Banner --}}
        <div class="mt-8">
            <x-profile.public.verification-banner />
        </div>

        {{-- Reviews Section --}}
        <div class="mt-[48px]">
            <x-profile.public.reviews-summary :user="$user" />
            
            {{-- Review Filters --}}
            <div class="mt-8 flex gap-2">
                <button class="px-4 py-2 bg-electric-blue text-white rounded-full text-[14px]">All ({{ $user->review_count }})</button>
                <button class="px-4 py-2 bg-white text-electric-blue border border-electric-blue rounded-full text-[14px]">5 stars ({{ $user->reviews_stats[5] ?? 0 }})</button>
                <button class="px-4 py-2 bg-white text-electric-blue border border-electric-blue rounded-full text-[14px]">4 stars ({{ $user->reviews_stats[4] ?? 0 }})</button>
            </div>

            {{-- Review Cards Grid --}}
            <div class="mt-8 grid grid-cols-2 gap-4">
                @foreach($reviews as $review)
                    <x-profile.public.review-card :review="$review" />
                @endforeach
            </div>

            {{-- Show More Reviews --}}
            <div class="mt-10 flex justify-center">
                <button class="flex items-center gap-2 px-8 py-4 border border-light-gray rounded-full text-[16px] font-medium text-[#1e1d1d] min-w-[280px] justify-center">
                    <img src="{{ asset('images/arrow_downward.svg') }}" alt="Arrow Down" class="w-4 h-4">
                    Show all reviews
                </button>
            </div>
        </div>

        {{-- Listed Properties Section --}}
        <div class="mt-[100px]">
            <div class="flex items-center gap-3 mb-8">
                <h2 class="text-[32px] font-medium text-[#1e1d1d] tracking-[-0.64px]">Listed properties</h2>
                <div class="relative w-[26px] h-[26px]">
                    <img src="{{ asset('images/ellipse.svg') }}" alt="Background" class="w-full h-full" onerror="this.src='{{ asset('images/info.svg') }}'">
                    <span class="absolute inset-0 flex items-center justify-center text-white text-[16px] font-medium">15</span>
                </div>
            </div>

            <div class="flex flex-col gap-6">
                @foreach($listings as $listing)
                    <x-listings.listing-card :listing="$listing" />
                @endforeach
            </div>

            {{-- Show More Properties --}}
            <div class="mt-[60px] flex justify-center">
                <button class="flex items-center gap-2 px-8 py-4 bg-electric-blue text-white rounded-full text-[16px] font-medium min-w-[280px] justify-center">
                    <img src="{{ asset('images/arrow_downward_white.svg') }}" alt="Arrow Down" class="w-4 h-4">
                    Show more properties
                </button>
            </div>
        </div>
    </div>

</main>

<x-footer />

</body>
</html>
