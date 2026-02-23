<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://api.fontshare.com/v2/css?f[]=general-sans@200,300,400,500,600,700&display=swap" rel="stylesheet">
        @php use Illuminate\Support\Facades\Auth; @endphp

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'General Sans', sans-serif; }
        </style>
    </head>
    <body class="font-sans antialiased bg-white">
        <div x-data="{}" class="min-h-screen">
            <x-header />
            {{ $slot }}
            <x-footer />
        </div>
        <x-modals.change-profile-photo-modal />
        <x-modals.profile-photo-success-modal />
        <x-modals.edit-bio-modal />
        <x-modals.enable-notifications-modal />
        <x-modals.notification-preferences-modal />
        <x-modals.regional-preferences-modal />
        <x-modals.reset-password-modal />
    </body>
</html>
