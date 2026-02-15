@props(['listing'])

<div class="sticky-card bg-white p-6 rounded-lg shadow-lg border border-light-gray">
    <div class="flex justify-between items-center">
        <div>
            <span class="text-3xl font-semibold text-black">AED {{ number_format($listing->price) }}</span>
            <span class="text-base text-gray-600">/ {{ $listing->payment_option }}</span>
        </div>
        @if($listing->user)
        <a href="#" class="w-12 h-12 rounded-full overflow-hidden border border-light-gray">
            <img src="{{ $listing->user->profile_photo_url ?? asset('images/profile_picture.png') }}" alt="{{ $listing->user->name }}" class="w-full h-full object-cover">
        </a>
        @endif
    </div>

    <div class="mt-6 space-y-3">
        <div class="flex justify-between text-gray-700">
            <span>Rental period</span>
            <span class="font-medium text-black">{{ $listing->payment_option }}</span>
        </div>
        <div class="flex justify-between text-gray-700">
            <span>Utilities</span>
            <span class="font-medium text-black">{{ $listing->utilities_option }}</span>
        </div>
        <div class="flex justify-between text-gray-700">
            <span>Security deposit</span>
            <span class="font-medium text-black">AED {{ number_format($listing->price * 0.1) }}</span>
        </div>
    </div>

    <div class="mt-6 space-y-3">
        <button class="w-full bg-electric-blue text-white font-medium py-3 rounded-full hover:bg-blue-700 transition">Send a message</button>
        <button class="w-full bg-white text-black font-medium py-3 rounded-full border border-light-gray hover:bg-gray-50 transition">Request a tour</button>
    </div>

    <p class="text-xs text-gray-500 text-center mt-4">Send a message request to the property manager</p>
</div>
