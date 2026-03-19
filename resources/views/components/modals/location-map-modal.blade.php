@props(['listing'])

<x-modal name="location-map" maxWidth="max-w-[calc(100%-80px)]" class="!rounded-[14px] my-[40px]">
    <div x-data="{
        map: null,
        initModalMap() {
            if (this.map) {
                // Resize if already initialized
                google.maps.event.trigger(this.map, 'resize');
                return;
            }
            const latitude = {{ $listing->latitude ?? 25.1972 }};
            const longitude = {{ $listing->longitude ?? 55.2744 }};
            const location = { lat: parseFloat(latitude), lng: parseFloat(longitude) };

            this.map = new google.maps.Map(this.$refs.modalMap, {
                zoom: 15,
                center: location,
                disableDefaultUI: true,
                styles: [
                    { 'featureType': 'poi', 'elementType': 'labels', 'stylers': [{ 'visibility': 'off' }] },
                    { 'featureType': 'transit', 'elementType': 'labels', 'stylers': [{ 'visibility': 'off' }] }
                ]
            });

            new google.maps.Marker({
                position: location,
                map: this.map,
                icon: {
                    url: '{{ asset('images/location_pin_blue.svg') }}',
                    scaledSize: new google.maps.Size(48, 48),
                    anchor: new google.maps.Point(24, 43)
                },
                title: '{{ $listing->address }}',
            });
        },
        zoomIn() { if(this.map) this.map.setZoom(this.map.getZoom() + 1); },
        zoomOut() { if(this.map) this.map.setZoom(this.map.getZoom() - 1); }
    }"
    x-on:open-modal.window="if($event.detail == 'location-map') { setTimeout(() => initModalMap(), 100) }"
    class="bg-white rounded-[14px] overflow-hidden h-full"
    >
        {{-- Modal Header --}}
        <div class="h-[65px] flex items-center justify-between px-[24px] py-[21px] border-b border-[#E8E8E7]">
            <button @click="$dispatch('close-modal', 'location-map')" class="p-1 relative -left-1 hover:bg-gray-100 rounded-full transition-colors">
                <img src="{{ asset('images/close_blue.svg') }}" alt="Close" class="w-[25px] h-[25px]">
            </button>
            <h2 class="text-[18px] font-medium text-black leading-[1.28] tracking-[-0.36px]">{{ $listing->address }}</h2>
            <div class="w-[25px]"></div> {{-- Spacer for centering --}}
        </div>

        {{-- Modal Content --}}
        <div class="p-[20px]">
            <div class="relative w-full h-full rounded-[8px] overflow-hidden shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)]">
                <div x-ref="modalMap" class="w-full h-[624px] bg-gray-50"></div>

                {{-- Map Internal Close Button --}}
                <div class="absolute top-3 right-3">
                    <button type="button" @click="$dispatch('close-modal', 'location-map')" class="flex items-center justify-center">
                        <img src="{{ asset('images/white_bg_blue_cross.svg') }}" class="w-12 h-12" alt="Close">
                    </button>
                </div>

                {{-- Map Controls Overlay --}}
                <div class="absolute bottom-3 right-3 flex flex-col">
                    <button type="button" @click="zoomIn()" class="flex items-center justify-center">
                        <img src="{{ asset('images/location_zoom_in_blue.svg') }}" class="w-12 h-12" alt="Zoom In">
                    </button>
                    <button type="button" @click="zoomOut()" class="flex items-center justify-center">
                        <img src="{{ asset('images/location_zoom_out_blue.svg') }}" class="w-12 h-12" alt="Zoom Out">
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-modal>
