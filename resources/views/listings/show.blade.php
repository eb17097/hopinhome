<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $listing->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid grid-cols-1 md:grid-cols-2 gap-8">

                    <div class="relative h-96 rounded-xl overflow-hidden shadow-lg">
                        <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}" class="absolute inset-0 w-full h-full object-cover">
                    </div>

                    <div class="flex flex-col justify-center">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="text-3xl font-bold mb-2">{{ $listing->title }}</h3>
                                <p class="text-gray-500 text-lg flex items-center">
                                    <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $listing->city }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-3xl font-bold text-rose-500">€{{ $listing->price }}</p>
                                <p class="text-sm text-gray-400">per night</p>
                            </div>
                        </div>

                        <hr class="my-6 border-gray-100">

                        <p class="text-gray-700 leading-relaxed mb-8">
                            This is a beautiful apartment located in the heart of {{ $listing->city }}.
                            It offers modern amenities, a cozy atmosphere, and is perfect for your next stay.
                        </p>

                        <div class="flex space-x-4 mt-auto">
                            <button class="flex-1 bg-rose-500 text-white px-6 py-4 rounded-xl font-bold hover:bg-rose-600 transition shadow-lg shadow-rose-200">
                                Book Now
                            </button>

                            @if(auth()->id() === $listing->user_id)
                                <a href="#" class="px-6 py-4 rounded-xl font-bold text-gray-700 border border-gray-300 hover:bg-gray-50 transition">
                                    Edit
                                </a>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
