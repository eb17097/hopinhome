<div>
    <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">Where is your property located?</h3>
    <p class="text-[16px] text-[#464646] mb-8">Enter the address of your property.</p>

    <div class="space-y-[20px]" x-data="locationSearch(formData.address, {
        world: '{{ asset('images/world_one.svg') }}',
        downtown: '{{ asset('images/downtown_loc.svg') }}',
        location: '{{ asset('images/location_loc.svg') }}',
        street: '{{ asset('images/street_loc.svg') }}'
    })">
        {{-- Address Input with Autocomplete --}}
        <div>
            <label for="address-input" class="block text-[14px] font-medium text-[#1e1d1d] mb-[6px]">Address</label>
            <div class="relative">
                {{-- Trigger Container --}}
                <div
                    class="relative z-20 w-full h-[51px] bg-white border border-[#E8E8E7] flex items-center px-[12px] gap-[8px] cursor-text transition-all duration-200"
                    :class="openFilter === 'location' ? 'border-[#1447D4] rounded-t-[6px] border-b-transparent' : 'rounded-[6px] shadow-[0px_2px_6px_0px_rgba(0,0,0,0.06)]'"
                    @click.stop="$refs.locationInput.focus()"
                >
                    <div class="flex items-center gap-[8px] flex-grow overflow-hidden">
                        {{-- Selected Location Tag --}}
                        <div x-show="location" x-cloak class="flex items-center gap-2 bg-[#F9F9F8] border border-[#E8E8E7] rounded-[4px] px-2 py-[6px] h-[32px] min-w-0">
                            <span class="text-[16px] leading-[1.2] text-[#464646] font-normal truncate block min-w-0" x-text="location"></span>
                            <button type="button" @click.stop="location = ''; locationQuery = ''; formData.address = ''" class="flex items-center justify-center hover:bg-gray-200 rounded-[2px] size-5 transition-colors shrink-0">
                                <img src="{{ asset('images/close.svg') }}" class="h-[14px] w-[14px] opacity-60" alt="Clear">
                            </button>
                        </div>

                        <input
                            x-ref="locationInput"
                            id="address-input"
                            type="text"
                            x-model="locationQuery"
                            @focus="openFilter = 'location'"
                            :placeholder="location ? '' : 'Enter full address'"
                            class="flex-grow min-w-0 bg-transparent border-none focus:ring-0 p-0 placeholder-[#464646] text-[16px] text-[#1E1D1D] font-normal"
                        >
                    </div>

                    <img src="{{ asset('images/gray_search.svg') }}" class="h-[24px] w-[24px] opacity-40 shrink-0" alt="Location">
                </div>

                {{-- Unified Dropdown Panel --}}
                <div x-show="openFilter === 'location'"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="absolute top-full left-0 w-full bg-white overflow-hidden border border-[#E8E8E7] rounded-b-[10px] z-30 shadow-[0px_4px_16px_0px_rgba(0,0,0,0.1)]"
                     @click.stop
                     @click.away="openFilter = null"
                     x-cloak
                >
                    <div class="py-2">
                        <template x-for="loc in filteredLocations" :key="loc.id">
                            <div class="flex items-center py-2 px-3 gap-3 hover:bg-[#F9F9F8] cursor-pointer transition-colors"
                                 @click="selectLocation(loc); handleLocationSelect(loc)">
                                <div class="shrink-0">
                                    <img :src="loc.icon" class="size-[40px]" alt="">
                                </div>
                                <div>
                                    <p class="text-[14px] font-medium text-[#1E1D1D]" x-text="loc.name"></p>
                                    <p class="text-[12px] text-[#707070]" x-text="loc.area"></p>
                                </div>
                            </div>
                        </template>
                        <div x-show="filteredLocations.length === 0" class="py-4 px-3 text-center text-[#707070] text-[14px]">
                            No locations found
                        </div>
                    </div>
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
        }

        /**
         * Bridge function: Called by the Alpine dropdown (selectLocation)
         * to update the Map and Marker.
         */
        function handleLocationSelect(loc) {
            if (!loc || !map || !marker) return;

            const geocoder = new google.maps.Geocoder();
            // We search by the specific ID if available, or name/area string
            const request = loc.id && !loc.id.startsWith('rcn-')
                ? { placeId: loc.id }
                : { address: loc.name + (loc.area ? ', ' + loc.area : '') };

            geocoder.geocode(request, (results, status) => {
                if (status === "OK" && results[0]) {
                    const place = results[0];
                    if (!place.geometry || !place.geometry.location) return;

                    map.setCenter(place.geometry.location);
                    map.setZoom(17);
                    marker.setPosition(place.geometry.location);

                    updateLocation(
                        place.geometry.location.lat(),
                        place.geometry.location.lng(),
                        place.formatted_address
                    );
                }
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
