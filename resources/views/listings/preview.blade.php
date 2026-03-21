<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Preview: {{ $listing->name }} - HopInHome</title>

    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@200,300,400,500,600,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>

    <style>
        body { font-family: 'General Sans', sans-serif; }
    </style>
</head>
<body class="bg-white text-gray-900 antialiased">

{{-- Preview Header --}}
<header class="bg-white border-b border-[#e8e8e7] h-[64px] sticky top-0 z-50">
    <div class="max-w-[1440px] mx-auto h-full px-[118px] flex items-center justify-between">
        <div class="flex items-center gap-4">
            <a href="{{ route('property_manager.listings.edit', $listing) }}" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                <img src="{{ asset('images/arrow_forward.svg') }}" class="w-6 h-6 rotate-180" alt="Back">
            </a>
            <h1 class="text-[18px] font-medium text-[#1e1d1d] tracking-[-0.36px]">Listing preview</h1>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('property_manager.listings.index') }}" 
               class="h-[43px] px-[32px] border border-[#e8e8e7] rounded-full flex items-center justify-center text-[16px] font-medium text-[#1e1d1d] hover:bg-gray-50 transition-colors tracking-[-0.48px]">
                Save as draft
            </a>
            <form action="{{ route('property_manager.listings.publish', $listing) }}" method="POST">
                @csrf
                <button type="submit" 
                        class="h-[43px] px-[32px] bg-[#1447d4] text-white rounded-full flex items-center justify-center text-[16px] font-medium hover:bg-[#04247b] transition-colors tracking-[-0.48px]">
                    Publish listing
                </button>
            </form>
        </div>
    </div>
</header>

{{-- Preview Banner --}}
<div class="bg-[#1447d4] h-[28px] flex items-center justify-center">
    <p class="text-white text-[14px] font-medium">This is a preview of your listing</p>
</div>

<main class="pb-[144px]">
    @include('listings.partials.listing-content', ['isPreview' => true])
</main>

</body>
</html>