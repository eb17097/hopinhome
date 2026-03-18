@props(['listing'])

<div x-data>
    <h3 class="text-[18px] font-medium text-black tracking-[-0.36px] leading-[1.28]">Location</h3>
    <p class="text-[16px] text-[#464646] leading-[1.5] mt-[8px]">{{ $listing->address }}</p>

    <div id="map-container" class="relative mt-[20px] group">
        <div id="map" class="h-[421px] rounded-[8px] border border-[#e8e8e7] overflow-hidden bg-gray-50"></div>

        {{-- Map Controls Overlay --}}
        <div class="absolute top-3 right-3">
            <button type="button" @click="$dispatch('open-modal', 'location-map')" class="flex items-center justify-center">
                <img src="{{ asset('images/location_fullscreen.svg') }}" class="w-12 h-12" alt="Fullscreen">
            </button>
        </div>

        <div class="absolute bottom-3 right-3 flex flex-col">
            <button type="button" onclick="zoomIn()" class="flex items-center justify-center">
                <img src="{{ asset('images/location_zoom_in_blue.svg') }}" class="w-12 h-12" alt="Zoom In">
            </button>
            <button type="button" onclick="zoomOut()" class="flex items-center justify-center">
                <img src="{{ asset('images/location_zoom_out_blue.svg') }}" class="w-12 h-12" alt="Zoom Out">
            </button>
        </div>
    </div>

    <x-modals.location-map-modal :listing="$listing" />

    <script>
        let map;

        function initMap() {
            const defaultLat = 25.1972; // Default to Burj Khalifa latitude
            const defaultLng = 55.2744; // Default to Burj Khalifa longitude
            const latitude = {{ $listing->latitude ?? 'defaultLat' }};
            const longitude = {{ $listing->longitude ?? 'defaultLng' }};

            const location = { lat: parseFloat(latitude), lng: parseFloat(longitude) };

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 15,
                center: location,
                disableDefaultUI: true,
                styles: [
                    { "featureType": "poi", "elementType": "labels", "stylers": [{ "visibility": "off" }] },
                    { "featureType": "transit", "elementType": "labels", "stylers": [{ "visibility": "off" }] }
                ]
            });

            new google.maps.Marker({
                position: location,
                map: map,
                icon: {
                    url: "{{ asset('images/location_pin_blue.svg') }}",
                    scaledSize: new google.maps.Size(48, 48),
                    anchor: new google.maps.Point(24, 43)
                },
                title: "{{ $listing->address }}",
            });
        }

        function zoomIn() { if(map) map.setZoom(map.getZoom() + 1); }
        function zoomOut() { if(map) map.setZoom(map.getZoom() - 1); }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
</div>
