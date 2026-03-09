@props(['listing'])

<x-modal name="share-listing" maxWidth="xl">
    <div x-data="{
        copied: false,
        url: '{{ route('listings.show', $listing) }}',
        copyToClipboard() {
            navigator.clipboard.writeText(this.url).then(() => {
                this.copied = true;
                setTimeout(() => this.copied = false, 2000);
            });
        }
    }" 
    class="bg-white rounded-[14px] overflow-hidden"
    >
        {{-- Modal Header --}}
        <div class="flex items-center justify-between px-[24px] py-[20px] border-b border-[#E8E8E7]">
            <button @click="$dispatch('close-modal', 'share-listing')" class="p-1 hover:bg-gray-100 rounded-full transition-colors">
                <img src="{{ asset('images/close_blue.svg') }}" alt="Close" class="w-[20px] h-[20px]">
            </button>
            <h2 class="text-[18px] font-medium text-black">Share this listing</h2>
            <div class="w-[20px]"></div> {{-- Spacer for centering --}}
        </div>

        {{-- Modal Content --}}
        <div class="px-[24px] py-[32px]">
            
            {{-- Listing Preview --}}
            <div class="flex gap-[20px] mb-[32px]">
                <div class="w-[180px] h-[120px] rounded-[10px] overflow-hidden flex-shrink-0">
                    @php
                        $firstImage = $listing->images->first();
                        $imageUrl = $firstImage ? (str_starts_with($firstImage->image_url, 'http') ? $firstImage->image_url : asset('storage/' . $firstImage->image_url)) : asset('images/about_landing_img.png');
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $listing->name }}" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col justify-center">
                    <p class="text-[14px] text-gray-500 mb-[4px]">{{ $listing->property_type ?? 'Apartment' }} for rent</p>
                    <h3 class="text-[18px] font-semibold text-black mb-[8px]">{{ $listing->name }}</h3>
                    <p class="text-[14px] text-gray-500">
                        {{ $listing->area }} sqft • {{ $listing->bedrooms }} beds • {{ $listing->bathrooms }} bath
                    </p>
                </div>
            </div>

            <hr class="border-[#E8E8E7] mb-[32px]">

            {{-- Action Buttons --}}
            <div class="flex flex-col gap-[16px]">
                {{-- Copy Link --}}
                <button 
                    @click="copyToClipboard()"
                    class="w-full flex items-center justify-center gap-[10px] py-[16px] border border-electric-blue rounded-[10px] text-electric-blue text-[16px] font-medium transition-all hover:bg-blue-50"
                >
                    <img src="{{ asset('images/content_copy.svg') }}" class="w-[20px] h-[20px]">
                    <span x-text="copied ? 'Link copied!' : 'Copy link'"></span>
                </button>

                {{-- Social Grid --}}
                <div class="grid grid-cols-2 gap-[16px]">
                    <a href="https://wa.me/?text={{ urlencode(route('listings.show', $listing)) }}" target="_blank" class="flex items-center justify-center gap-[10px] py-[16px] border border-[#E8E8E7] rounded-[10px] text-black text-[16px] font-medium transition-all hover:bg-gray-50">
                        <img src="{{ asset('images/whatsapp.svg') }}" class="w-[20px] h-[20px]">
                        <span>WhatsApp</span>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('listings.show', $listing)) }}" target="_blank" class="flex items-center justify-center gap-[10px] py-[16px] border border-[#E8E8E7] rounded-[10px] text-black text-[16px] font-medium transition-all hover:bg-gray-50">
                        <img src="{{ asset('images/facebook.svg') }}" class="w-[20px] h-[20px]">
                        <span>Facebook</span>
                    </a>
                    <a href="mailto:?subject=Check out this listing: {{ $listing->name }}&body={{ route('listings.show', $listing) }}" class="flex items-center justify-center gap-[10px] py-[16px] border border-[#E8E8E7] rounded-[10px] text-black text-[16px] font-medium transition-all hover:bg-gray-50">
                        <img src="{{ asset('images/mail.svg') }}" class="w-[20px] h-[20px]">
                        <span>Email</span>
                    </a>
                    <button class="flex items-center justify-center gap-[10px] py-[16px] border border-[#E8E8E7] rounded-[10px] text-black text-[16px] font-medium transition-all hover:bg-gray-50">
                        <img src="{{ asset('images/dots.svg') }}" class="w-[20px] h-[20px]">
                        <span>More options</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-modal>
