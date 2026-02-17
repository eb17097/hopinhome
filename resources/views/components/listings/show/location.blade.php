@props(['listing'])

<div>
    <h3 class="text-[18px] font-medium text-black tracking-[-0.36px] leading-[1.28]">Location</h3>
    <p class="text-[16px] text-[#464646] leading-[1.5] mt-[8px]">{{ $listing->address }}</p>
        <div id="map" class="mt-[20px] h-[421px] rounded-[8px] overflow-hidden"></div>

        <script>
            function initMap() {
                const defaultLat = 25.1972; // Default to Burj Khalifa latitude
                const defaultLng = 55.2744; // Default to Burj Khalifa longitude
                const latitude = {{ $listing->latitude ?? 'defaultLat' }};
                const longitude = {{ $listing->longitude ?? 'defaultLng' }};

                const location = { lat: parseFloat(latitude), lng: parseFloat(longitude) };
                const map = new google.maps.Map(document.getElementById("map"), {
                    zoom: 15,
                    center: location,
                    styles: [
                        { "featureType": "poi", "elementType": "labels", "stylers": [{ "visibility": "off" }] },
                        { "featureType": "transit", "elementType": "labels", "stylers": [{ "visibility": "off" }] },
                        { "featureType": "road", "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] },
                        { "featureType": "road.local", "elementType": "labels", "stylers": [{ "visibility": "off" }] },
                        { "featureType": "administrative", "elementType": "labels", "stylers": [{ "visibility": "off" }] }
                    ]
                });
                new google.maps.Marker({
                    position: location,
                    map: map,
                    title: "{{ $listing->address }}",
                });
            }
        </script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap"></script>
</div>
