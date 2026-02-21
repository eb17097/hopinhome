@props(['listings'])

<div class="bg-white py-[80px]">
    <div class="max-w-[1204px] mx-auto px-4 lg:px-0">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-[40px] gap-4">
            <div>
                <h2 class="text-[32px] font-medium leading-[1.28] tracking-[-0.64px] text-[#1E1D1D] font-['General_Sans',_sans-serif]">
                    Popular homes in <span class="text-[#1447D4]">the UAE</span>
                </h2>
            </div>

            <a href="{{ route('listings.index') }}" class="inline-flex items-center justify-center px-[32px] py-[16px] border border-[#E8E8E7] rounded-[29.5px] text-[16px] font-medium text-[#1E1D1D] bg-white hover:bg-gray-50 transition tracking-[-0.48px] shadow-sm font-['General_Sans',_sans-serif]">
                View more properties
            </a>
        </div>

        @if($listings->isNotEmpty())
            <div class="grid grid-cols-1 md:grid-cols-3 gap-x-[32px] gap-y-[40px]">
                @foreach($listings->take(3) as $listing)
                    <x-listings.compact-listing-card :listing="$listing" />
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-lg">No properties found at the moment.</p>
        @endif
    </div>
</div>


