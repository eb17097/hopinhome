@props(['listing'])

<div x-data="{ open: false }">
    <h3 class="text-lg font-medium text-black">About this apartment</h3>
    <div class="mt-4 text-gray-700 leading-relaxed" :class="{ 'max-h-24 overflow-hidden': !open }">
        <p>{{ $listing->description }}</p>
    </div>
    <button @click="open = !open" class="mt-4 text-electric-blue font-medium flex items-center space-x-2">
        <span x-text="open ? 'Read less' : 'Read the full description'"></span>
        <img src="{{ asset('images/arrow_downward.svg') }}" alt="Arrow" class="w-4 h-4 transition-transform" :class="{ 'transform rotate-180': open }">
    </button>
</div>
