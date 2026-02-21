@props(['listing'])

<div>
    <h3 class="text-[18px] font-medium text-black tracking-[-0.36px] leading-[1.28]">Location</h3>
    <p class="text-[16px] text-[#464646] leading-[1.5] mt-[8px]">{{ $listing->address }}</p>
    
    <div class="relative mt-[20px]">
        <div id="map" class="h-[421px] rounded-[8px] border border-[#e8e8e7] overflow-hidden bg-gray-50"></div>

        {{-- Map Controls Overlay --}}
        <div class="absolute bottom-4 right-4 flex flex-col gap-2">
            <button type="button" onclick="zoomIn()" class="w-10 h-10 bg-white rounded-[6px] shadow-md flex items-center justify-center hover:bg-gray-50 transition-colors border border-[#e8e8e7]">
                <img src="{{ asset('images/add_zoom.svg') }}" class="w-4 h-4" alt="Zoom In">
            </button>
            <button type="button" onclick="zoomOut()" class="w-10 h-10 bg-white rounded-[6px] shadow-md flex items-center justify-center hover:bg-gray-50 transition-colors border border-[#e8e8e7]">
                <img src="{{ asset('images/remove.svg') }}" class="w-4 h-4" alt="Zoom Out">
            </button>
        </div>
    </div>

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
                    url: "{{ asset('images/map-location-icon.svg') }}",
                    scaledSize: new google.maps.Size(40, 40)
                },
                title: "{{ $listing->address }}",
            });
        }

        function zoomIn() { if(map) map.setZoom(map.getZoom() + 1); }
        function zoomOut() { if(map) map.setZoom(map.getZoom() - 1); }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
</div>
