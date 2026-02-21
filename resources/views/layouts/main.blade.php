<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Hopinhome' }}</title>

    {{-- Meta tags for SEO can be added here --}}
    <meta name="robots" content="noindex, nofollow">

    {{-- Fonts --}}
    <link href="https://api.fontshare.com/v2/css?f[]=general-sans@200,300,400,500,600,700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'General Sans', sans-serif; }
    </style>

    {{-- Scripts & Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Additional Head Content --}}
    {{ $head ?? '' }}
</head>
<body class="antialiased">

    {{ $slot }}

</body>
</html>
