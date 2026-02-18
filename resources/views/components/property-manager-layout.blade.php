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
        <style>
            body { font-family: 'General Sans', sans-serif; }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @php use Illuminate\Support\Facades\Auth; @endphp
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div x-data="{ sidebarOpen: true }" class="min-h-screen bg-off-white">
            <x-header />

            <div class="flex">
                <div x-show="sidebarOpen" class="relative w-[232px] h-screen bg-white border-r border-light-gray shadow-sm pt-24 pb-8 overflow-y-auto transition-all duration-300 ease-in-out">
                    <button @click="sidebarOpen = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 z-50">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    <x-property_manager.property-manager-sidebar />
                </div>
                <main class="flex-1 pt-24 transition-all duration-300 ease-in-out" :class="{ 'ml-[232px]': sidebarOpen, 'ml-0': !sidebarOpen }">
                    <div class="py-12 px-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
            <x-footer />
        </div>
    </body>
</html>