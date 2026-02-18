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


            <div class="flex">
                <div x-show="sidebarOpen" id="property-manager-sidebar" class="relative w-[336px] h-screen bg-white border-r border-light-gray shadow-sm pb-8 overflow-y-auto transition-all duration-300 ease-in-out">
                    <div class="flex justify-between items-center px-4 py-4">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopInHome Logo" class="h-6 w-auto">
                        </div>
                        <button @click="sidebarOpen = false" class="text-gray-400 hover:text-gray-600">
                            <img src="{{ asset('images/left_panel_close.svg') }}" alt="Close" class="h-6 w-6">
                        </button>
                    </div>
                    <div class="pt-4">
                        <x-property_manager.property-manager-sidebar />
                    </div>
                </div>
                <main class="flex-1 pt-24 transition-all duration-300 ease-in-out" :class="{ 'ml-[336px]': sidebarOpen, 'ml-0': !sidebarOpen }">
                    <button x-show="!sidebarOpen" @click="sidebarOpen = true" class="absolute top-4 left-4 z-50 p-2 rounded-full bg-white shadow-sm hover:bg-gray-100 transition">
                        <img src="{{ asset('images/left_panel_close.svg') }}" alt="Open Menu" class="w-6 h-6">
                    </button>
                    <div class="py-12 px-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>

        </div>
    </body>
</html>
