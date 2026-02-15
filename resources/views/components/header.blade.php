<nav class="bg-white border-b border-gray-100 fixed top-0 left-0 right-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @auth
        <div class="flex justify-between items-center h-22 py-4">
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopInHome Logo" class="h-7 w-auto">
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-lg font-medium text-gray-900 hover:text-blue-600 transition">Home</a>
                <a href="#" class="text-lg font-medium text-gray-500 hover:text-blue-600 transition">Find Properties</a>
                <a href="#" class="text-lg font-medium text-gray-500 hover:text-blue-600 transition">Articles & Insights</a>
                <a href="#" class="text-lg font-medium text-gray-500 hover:text-blue-600 transition">About Us</a>
            </div>

            <div class="flex items-center space-x-4">
                <div class="relative">
                    <img src="{{ asset('images/notifications.svg') }}" alt="Notifications" class="w-6 h-6">
                    <div class="absolute -top-1 -right-1">
                        <img src="{{ asset('images/notification_dot.svg') }}" alt="Notification Dot" class="w-4 h-4">
                        <span class="absolute text-white text-xs font-medium" style="top: 1px; left: 4.5px;">5</span>
                    </div>
                </div>
                <div class="w-11 h-11 rounded-full border border-light-gray overflow-hidden">
                    <img alt="profile picture" class="h-full w-full object-cover" src="{{ asset('images/profile_picture.png') }}">
                </div>
                <div class="bg-light-gray rounded-full p-2">
                    <img src="{{ asset('images/hamburger.svg') }}" alt="Menu" class="w-6 h-6">
                </div>
            </div>
        </div>
        @else
        <div class="flex justify-between h-22 py-4">
            <div class="flex items-center">
                <a href="/" class="flex items-center gap-2">
                    <img src="{{ asset('images/hopinhome_logo_blue.svg') }}" alt="HopInHome Logo" class="h-7 w-auto">
                </a>
            </div>

            <div class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-lg font-medium text-gray-900 hover:text-blue-600 transition">Home</a>

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center text-lg font-medium text-gray-500 hover:text-blue-600 transition">
                        <span>Find Properties</span>
                        <img src="{{ asset('images/chevron.svg') }}" alt="Dropdown Arrow" class="w-5 h-5 ml-1 transform" :class="{'rotate-180': open}">
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute z-10 mt-2 w-48 bg-white rounded-md shadow-lg" style="display: none;">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">For Sale</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">For Rent</a>
                    </div>
                </div>

                <a href="#" class="text-lg font-medium text-gray-500 hover:text-blue-600 transition">Articles & Insights</a>
                <a href="#" class="text-lg font-medium text-gray-500 hover:text-blue-600 transition">About Us</a>
            </div>

            <div class="flex items-center space-x-4">
                <button>
                    <img src="{{ asset('images/language_black.svg') }}" alt="Language" class="w-6 h-6">
                </button>
                <a href="{{ route('login') }}" class="bg-blue-600 text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-blue-700 transition">
                    Log in or sign up
                </a>
            </div>
        </div>
        @endauth
    </div>
</nav>
