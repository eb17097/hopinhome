@props(['similarListings'])

<div class="bg-[#F9F9F8] py-[96px]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-[32px]">
            <h2 class="text-[32px] font-medium text-black tracking-[-0.64px] leading-[1.28]">Explore similar properties</h2>
            <a href="#" class="px-[32px] py-[16px] bg-white rounded-[29.5px] border border-[#E8E8E7] text-black font-medium text-[16px] leading-[1.22] tracking-[-0.48px] hover:bg-gray-50 transition">
                View more properties like this
            </a>
        </div>
        
        @if($similarListings->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-[32px] gap-y-[32px]">
                @foreach($similarListings as $similar)
                    <x-listings.compact-listing-card :listing="$similar" />
                @endforeach
            </div>
        @else
            <p class="mt-4 text-gray-500">No similar properties found at the moment.</p>
        @endif
    </div>
</div>
