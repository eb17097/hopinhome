<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $listing->title }} - Hopinhome</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">

<nav class="bg-white border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <a href="/" class="text-2xl font-bold text-rose-500">Hopinhome</a>
        <div class="flex space-x-4">
            <a href="/" class="text-gray-600 hover:text-gray-900">Back to Search</a>
        </div>
    </div>
</nav>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="rounded-xl overflow-hidden h-96">
            <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}" class="object-cover w-full h-full">
        </div>

        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $listing->title }}</h1>
            <p class="text-lg text-gray-600 mt-2">{{ $listing->city }}</p>

            <div class="mt-4 flex items-center space-x-1">
                <span class="text-rose-500">★</span>
                <span class="font-semibold">4.9</span>
                <span class="text-gray-400">•</span>
                <span class="underline">12 reviews</span>
            </div>

            <div class="border-t border-gray-200 my-6"></div>

            <div class="border border-gray-200 rounded-xl p-6 shadow-sm bg-white max-w-sm">
                <div class="flex justify-between items-end mb-4">
                    <div>
                        <span class="text-2xl font-bold">€{{ $listing->price }}</span>
                        <span class="text-gray-500"> night</span>
                    </div>
                </div>

                <button class="w-full bg-rose-500 text-white font-bold py-3 rounded-lg hover:bg-rose-600 transition">
                    Reserve
                </button>

                <p class="text-center text-gray-400 text-sm mt-3">You won't be charged yet</p>
            </div>
        </div>

    </div>
</div>

</body>
</html>
