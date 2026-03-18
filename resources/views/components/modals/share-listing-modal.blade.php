@props(['listing'])

<x-modal name="share-listing" maxWidth="sm:max-w-[586px]" class="rounded-[14px]">
    <div x-data="{
        copied: false,
        url: '{{ route('listings.show', $listing) }}',
        title: '{{ $listing->name }}',
        text: 'Check out this property on HopInHome: {{ $listing->name }}',
        copyToClipboard() {
            navigator.clipboard.writeText(this.url).then(() => {
                this.copied = true;
                setTimeout(() => this.copied = false, 2000);
            });
        },
        shareNatively() {
            if (navigator.share) {
                navigator.share({
                    title: this.title,
                    text: this.text,
                    url: this.url
                }).catch(() => {});
            } else {
                this.copyToClipboard();
            }
        }
    }"
    class="w-full"
    >
        {{-- Modal Header --}}
        <div class="h-[66px] flex items-center justify-between px-[24px] py-[22px] border-b border-[#E8E8E7]">
            <button @click="$dispatch('close-modal', 'share-listing')" class="p-1 hover:bg-gray-100 rounded-full transition-colors">
                <img src="{{ asset('images/close_blue.svg') }}" alt="Close" class="w-[25px] h-[25px]">
            </button>
            <h2 class="text-[18px] font-medium text-black">Share this listing</h2>
            <div class="w-[20px]"></div> {{-- Spacer for centering --}}
        </div>

        {{-- Modal Content --}}
        <div class="p-[24px]">

            {{-- Listing Preview --}}
            <div class="flex gap-[21px]">
                <div class="w-[174px] h-[109px] rounded-[10px] overflow-hidden flex-shrink-0">
                    @php
                        $firstImage = $listing->images->first();
                        $imageUrl = $firstImage ? (str_starts_with($firstImage->image_url, 'http') ? $firstImage->image_url : asset('storage/' . $firstImage->image_url)) : asset('images/about_landing_img.png');
                    @endphp
                    <img src="{{ $imageUrl }}" alt="{{ $listing->name }}" class="w-full h-full object-cover">
                </div>
                <div class="flex flex-col mt-[16px] items-baseline min-w-0">
                    <p class="text-[16px] leading-[1.3] text-[#464646] mb-[4px]">{{ $listing->property_type ?? 'Apartment' }} for rent</p>
                    <h3 class="text-[18px] leading-[1.28] tracking-[-0.36px] font-medium text-[#1E1D1D] mb-[8px] truncate" title="{{ $listing->name }}">{{ $listing->name }}</h3>
                    <p class="text-[14px] leading-[1.5] text-[#464646]">
                        {{ $listing->area }} sqft • {{ $listing->bedrooms }} beds • {{ $listing->bathrooms }} bath
                    </p>
                </div>
            </div>
        </div>

        <hr class="border-[#E8E8E7]">

        <div class="p-[24px]">

            {{-- Action Buttons --}}
            <div class="flex flex-col gap-[20px]">
                {{-- Copy Link --}}
                <button
                    @click="copyToClipboard()"
                    class="h-[52px] w-[538px] w-full flex items-center justify-center gap-[6px] py-[16px] border border-electric-blue rounded-[6px] text-electric-blue text-[16px] font-medium transition-all hover:bg-blue-50"
                >
                    <img src="{{ asset('images/copy_blue.svg') }}" class="w-[17px] h-[17px]">
                    <span x-text="copied ? 'Link copied!' : 'Copy link'"></span>
                </button>

                {{-- Social Grid --}}
                <div class="grid grid-cols-2 gap-y-[20px] gap-x-[24px]">
                    <a :href="'https://wa.me/?text=' + encodeURIComponent(text + ' ' + url)" target="_blank" class="h-[52px] w-[257px] flex items-center justify-center gap-[6px] py-[16px] border border-[#E8E8E7] rounded-[6px] text-black text-[16px] font-medium transition-all hover:bg-gray-50">
                        <img src="{{ asset('images/whatsapp_black.svg') }}" class="w-[17px] h-[17px]">
                        <span>WhatsApp</span>
                    </a>
                    <a :href="'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(url)" target="_blank" class="h-[52px] w-[257px] flex items-center justify-center gap-[6px] py-[16px] border border-[#E8E8E7] rounded-[6px] text-black text-[16px] font-medium transition-all hover:bg-gray-50">
                        <img src="{{ asset('images/facebook_black.svg') }}" class="w-[17px] h-[17px]">
                        <span>Facebook</span>
                    </a>
                    <a :href="'mailto:?subject=' + encodeURIComponent(title) + '&body=' + encodeURIComponent(text + ' ' + url)" class="h-[52px] w-[257px] flex items-center justify-center gap-[6px] py-[16px] border border-[#E8E8E7] rounded-[6px] text-black text-[16px] font-medium transition-all hover:bg-gray-50">
                        <img src="{{ asset('images/mail_black.svg') }}" class="w-[17px] h-[17px]">
                        <span>Email</span>
                    </a>
                    <button @click="shareNatively()" class="h-[52px] w-[257px] flex items-center justify-center gap-[6px] py-[16px] border border-[#E8E8E7] rounded-[6px] text-black text-[16px] font-medium transition-all hover:bg-gray-50">
                        <img src="{{ asset('images/more_options_dots_black.svg') }}" class="w-[17px] h-[17px]">
                        <span>More options</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-modal>
