@props(['listing'])

<div>
    <h3 class="text-lg font-medium text-black">Location</h3>
    <p class="text-gray-600 mt-1">{{ $listing->address }}</p>
    <div class="mt-4 h-96 rounded-lg overflow-hidden">
        {{-- Placeholder for a map. A real implementation would use Google Maps or Mapbox --}}
        <img src="{{ asset('images/map.png') }}" alt="Map" class="w-full h-full object-cover">
    </div>
</div>
