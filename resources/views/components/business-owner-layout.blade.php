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
            [x-cloak] { display: none !important; }

            /* Hide scrollbar for Chrome, Safari and Opera */
            #business-owner-sidebar::-webkit-scrollbar {
                display: none;
            }

            /* Hide scrollbar for IE, Edge and Firefox */
            #business-owner-sidebar {
                -ms-overflow-style: none;  /* IE and Edge */
                scrollbar-width: none;  /* Firefox */
            }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @php use Illuminate\Support\Facades\Auth; @endphp
    </head>
    <body class="font-sans antialiased bg-white select-none">
        <div x-data="{ sidebarOpen: true }" @toggle-sidebar.window="sidebarOpen = !sidebarOpen" class="min-h-screen bg-white">


            <div class="flex overflow-hidden">
                <div id="business-owner-sidebar"
                     class="relative h-screen bg-white border-r border-light-gray shadow-[0px_0px_64px_0px_rgba(0,0,0,0.03)] pb-8 overflow-y-auto shrink-0 transition-all duration-300 ease-in-out"
                     :class="sidebarOpen ? 'w-[232px]' : 'w-[51px]'">
                    <div class="border-b h-[74px] flex items-center px-[16px] py-[27px] transition-all duration-300 ease-in-out"
                         :class="sidebarOpen ? 'justify-between' : 'justify-center'">
                        <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopInHome Logo" class="h-[20px] w-auto transition-all duration-300" x-show="sidebarOpen" x-cloak>
                        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-400 hover:text-gray-600 transition-colors shrink-0">
                            <img src="{{ asset('images/left_panel_close.svg') }}" alt="Toggle" class="h-[20px] w-[20px] transition-transform duration-300" :class="!sidebarOpen && 'rotate-180'">
                        </button>
                    </div>
                    <div class="pt-4">
                        <x-dashboard.sidebar />
                    </div>
                </div>
                <main class="flex-1 h-screen overflow-y-auto transition-all duration-300 ease-in-out bg-white">
                    <x-dashboard.header />
                    <div>
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
        <x-modals.reset-password-modal />
        <x-modals.delete-account-modal />
    </body>
</html>
