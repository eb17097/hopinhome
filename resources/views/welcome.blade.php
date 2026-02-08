<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hopinhome</title>
    <meta name="robots" content="noindex, nofollow">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <span class="text-2xl font-bold text-rose-500">Hopinhome</span>
            </div>

            <div class="flex items-center space-x-4">
                <a href="#" class="text-gray-600 hover:text-gray-900 font-medium">Become a Host</a>

                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-gray-900 font-medium">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 font-medium">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="rounded-md bg-rose-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-rose-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-500">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">Stays in Latvia & Italy</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

        @foreach($listings as $listing)
            <a href="{{ route('listings.show', $listing) }}" class="group cursor-pointer block">
                <div class="relative w-full overflow-hidden rounded-xl aspect-square mb-3">
                    <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}" class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300">
                </div>
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-bold text-gray-900">{{ $listing->city }}</h3>
                        <p class="text-gray-500 text-sm">{{ $listing->title }}</p>
                    </div>
                    <div class="flex items-center space-x-1">
                        <span>★</span>
                        <span>4.9</span>
                    </div>
                </div>
                <div class="mt-1">
                    <span class="font-semibold text-gray-900">€{{ $listing->price }}</span>
                    <span class="text-gray-500"> night</span>
                </div>
            </a>
        @endforeach

    </div>
</div>

</body>
</html>
