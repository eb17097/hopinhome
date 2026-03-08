@props(['listing'])

<div>
    <h3 class="text-[18px] font-medium text-black tracking-[-0.36px] leading-[1.28]">Location</h3>
    <p class="text-[16px] text-[#464646] leading-[1.5] mt-[8px]">{{ $listing->address }}</p>

    <div id="map-container" class="relative mt-[20px] group">
        <div id="map" class="h-[421px] rounded-[8px] border border-[#e8e8e7] overflow-hidden bg-gray-50"></div>

        {{-- Map Controls Overlay --}}
        <div class="absolute top-4 right-4">
            <button type="button" onclick="toggleFullscreen()" class="flex items-center justify-center">
                <img src="{{ asset('images/location_fullscreen.svg') }}" class="w-12 h-12" alt="Fullscreen">
            </button>
        </div>

        <div class="absolute bottom-4 right-4 flex flex-col gap-2">
            <button type="button" onclick="zoomIn()" class="flex items-center justify-center">
                <img src="{{ asset('images/location_zoom_in_blue.svg') }}" class="w-12 h-12" alt="Zoom In">
            </button>
            <button type="button" onclick="zoomOut()" class="flex items-center justify-center">
                <img src="{{ asset('images/location_zoom_out_blue.svg') }}" class="w-12 h-12" alt="Zoom Out">
            </button>
        </div>
    </div>

    <style>
        #map-container:fullscreen {
            width: 100% !important;
            height: 100% !important;
            margin-top: 0 !important;
            background: white;
        }
        #map-container:fullscreen #map {
            height: 100vh !important;
            border-radius: 0 !important;
            border: none !important;
        }
    </style>

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

        function toggleFullscreen() {
            const container = document.getElementById('map-container');
            if (!document.fullscreenElement) {
                if (container.requestFullscreen) {
                    container.requestFullscreen();
                } else if (container.webkitRequestFullscreen) {
                    container.webkitRequestFullscreen();
                } else if (container.msRequestFullscreen) {
                    container.msRequestFullscreen();
                }
            } else {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                }
            }
        }

        document.addEventListener('fullscreenchange', () => {
            if (map) {
                google.maps.event.trigger(map, "resize");
            }
        });
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
</div>
