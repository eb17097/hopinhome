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
    <body class="font-sans antialiased bg-white">
        <div x-data="{ sidebarOpen: true }" @toggle-sidebar.window="sidebarOpen = !sidebarOpen" class="min-h-screen bg-white">


            <div class="flex overflow-hidden">
                <div x-show="sidebarOpen" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="-translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transition ease-in duration-300"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="-translate-x-full"
                     id="property-manager-sidebar" 
                     class="relative w-[232px] h-screen bg-white border-r border-light-gray shadow-[0px_0px_64px_0px_rgba(0,0,0,0.03)] pb-8 overflow-y-auto shrink-0">
                    <div class="flex justify-between items-center px-4 pt-[27px] pb-4">
                        <div class="flex items-center gap-2">
                            <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopInHome Logo" class="h-6 w-auto">
                        </div>
                        <button @click="sidebarOpen = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                            <img src="{{ asset('images/left_panel_close.svg') }}" alt="Close" class="h-6 w-6">
                        </button>
                    </div>
                    <div class="pt-4">
                        <x-property_manager.property-manager-sidebar />
                    </div>
                </div>
                <main class="flex-1 h-screen overflow-y-auto transition-all duration-300 ease-in-out bg-white">
                    <x-property_manager.property-manager-header />
                    <div class="px-8 py-6">
                        {{ $slot }}
                    </div>
                </main>
            </div>

        </div>
        <x-modals.change-profile-photo-modal />
        <x-modals.profile-photo-success-modal />
        <x-modals.edit-bio-modal />
        <x-modals.enable-notifications-modal />
        <x-modals.notification-preferences-modal />
        <x-modals.regional-preferences-modal />
    </body>
</html>
