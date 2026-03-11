<div>
    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">Where is your property located?</h3>
    <p class="text-[16px] text-[#464646] mb-8">Enter the address of your property.</p>

    <div class="space-y-[20px]">
        {{-- Address Input with Autocomplete --}}
        <div>
            <label for="address-input" class="block text-[14px] font-medium text-[#1e1d1d] mb-[6px]">Address</label>
            <div class="relative">
                <input
                    type="text"
                    id="address-input"
                    x-model="formData.address"
                    name="address"
                    class="w-full px-4 py-3 border border-[#e8e8e7] rounded-[6px] focus:ring-2 focus:ring-[#1447d4] focus:border-transparent transition-all outline-none text-[16px]"
                    placeholder="Enter full address"
                >
                <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none opacity-40">
                    <img src="{{ asset('images/search.svg') }}" class="w-5 h-5" alt="">
                </div>
            </div>
        </div>

        {{-- Map Picker --}}
        <div class="relative">
            <div id="create-listing-map" class="w-full h-[400px] rounded-[8px] border border-[#e8e8e7] overflow-hidden bg-gray-50"></div>

            {{-- Map Controls Overlay --}}
            <div class="absolute bottom-4 right-4 flex flex-col gap-2">
                <button type="button" onclick="zoomIn()" class="flex items-center justify-center">
                    <img src="{{ asset('images/location_zoom_in_blue.svg') }}" class="w-12 h-12" alt="Zoom In">
                </button>
                <button type="button" onclick="zoomOut()" class="flex items-center justify-center">
                    <img src="{{ asset('images/location_zoom_out_blue.svg') }}" class="w-12 h-12" alt="Zoom Out">
                </button>
            </div>
        </div>
    </div>

    <script>
        let map;
        let marker;
        let autocomplete;

        function initCreateMap() {
            // Safety check: wait for Alpine and Google Maps
            if (!window.listingForm || typeof google === 'undefined') {
                setTimeout(initCreateMap, 100);
                return;
            }

            const defaultLocation = {
                lat: parseFloat(window.listingForm.formData.latitude) || 25.1972,
                lng: parseFloat(window.listingForm.formData.longitude) || 55.2744
            };

            map = new google.maps.Map(document.getElementById("create-listing-map"), {
                center: defaultLocation,
                zoom: 13,
                disableDefaultUI: true,
                styles: [
                    { "featureType": "poi", "elementType": "labels", "stylers": [{ "visibility": "off" }] },
                    { "featureType": "transit", "elementType": "labels", "stylers": [{ "visibility": "off" }] }
                ]
            });

            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true,
                icon: {
                    url: "{{ asset('images/location_pin_blue.svg') }}",
                    scaledSize: new google.maps.Size(48, 48),
                    anchor: new google.maps.Point(24, 43)
                }
            });

            marker.addListener("dragend", () => {
                const pos = marker.getPosition();
                updateLocation(pos.lat(), pos.lng());
                reverseGeocode(pos);
            });

            const input = document.getElementById("address-input");
            autocomplete = new google.maps.places.Autocomplete(input, {
                fields: ["formatted_address", "geometry"],
                componentRestrictions: { country: "ae" }
            });

            autocomplete.addListener("place_changed", () => {
                const place = autocomplete.getPlace();
                if (!place.geometry || !place.geometry.location) return;

                map.setCenter(place.geometry.location);
                map.setZoom(17);
                marker.setPosition(place.geometry.location);

                updateLocation(
                    place.geometry.location.lat(),
                    place.geometry.location.lng(),
                    place.formatted_address
                );
            });
        }

        function updateLocation(lat, lng, address = null) {
            if (window.listingForm) {
                window.listingForm.formData.latitude = lat;
                window.listingForm.formData.longitude = lng;
                if (address) window.listingForm.formData.address = address;
            }
        }

        function reverseGeocode(pos) {
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({ location: pos }, (results, status) => {
                if (status === "OK" && results[0]) {
                    updateLocation(pos.lat(), pos.lng(), results[0].formatted_address);
                }
            });
        }

        function zoomIn() { if(map) map.setZoom(map.getZoom() + 1); }
        function zoomOut() { if(map) map.setZoom(map.getZoom() - 1); }

        // Start initialization
        if (document.readyState === 'complete') {
            initCreateMap();
        } else {
            window.addEventListener('load', initCreateMap);
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initCreateMap"></script>
</div>
