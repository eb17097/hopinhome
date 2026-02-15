@props(['listing'])

{{-- In a real application, you would pass a collection of similar listings from the controller --}}
{{-- For now, we will just show a placeholder --}}

<div>
    <h2 class="text-3xl font-medium text-black tracking-tight">Explore similar properties</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
        {{-- You would loop through $similarListings here --}}
        {{-- Using the public listing card --}}
        {{-- <x-listings.listing-card :listing="$similar" /> --}}
    </div>
</div>
