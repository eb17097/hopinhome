@props(['listing'])

<div>
    <h2 class="text-3xl font-medium text-black tracking-tight">Explore similar properties</h2>
    
    @if($similarListings->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mt-8">
            @foreach($similarListings as $similar)
                <x-listings.listing-card :listing="$similar" />
            @endforeach
        </div>
    @else
        <p class="mt-4 text-gray-500">No similar properties found at the moment.</p>
    @endif
</div>
