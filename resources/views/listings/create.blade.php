<x-property-manager-layout>
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <div class="bg-white">
        <div class="max-w-[1440px] mx-auto">
            <form id="listing-creation-form" 
                  action="{{ isset($listing) ? route('property_manager.listings.update', $listing) : route('property_manager.listings.store') }}" 
                  method="POST" 
                  enctype="multipart/form-data">
                @csrf
                @if(isset($listing))
                    @method('PUT')
                @endif
                @php
                    $oldFeatures = old('features');
                    if (is_string($oldFeatures)) $oldFeatures = json_decode($oldFeatures, true);
                    $featuresVal = $oldFeatures ?? (isset($listing) ? $listing->features->pluck('id')->toArray() : []);

                    $oldAmenities = old('amenities');
                    if (is_string($oldAmenities)) $oldAmenities = json_decode($oldAmenities, true);
                    $amenitiesVal = $oldAmenities ?? (isset($listing) ? $listing->amenities->pluck('id')->toArray() : []);
                @endphp
                <div id="listing-form-container"
                     x-data="{
                        step: 1,
                        stepTitles: {
                            1: '{{ isset($listing) ? 'Edit listing' : 'Create listing' }}',
                            2: 'Property location',
                            3: 'Property description',
                            4: 'Property details',
                            5: 'Property features',
                            6: 'Building amenities',
                            7: 'Photos',
                            8: 'Video tour',
                            9: 'Price details',
                            10: 'Publishing settings'
                        },
                        nextUrl: null,
                        formData: {
                            property_type: {{ json_encode(old('property_type', $listing->property_type ?? '')) }},
                            address: {{ json_encode(old('address', $listing->address ?? '')) }},
                            latitude: {{ old('latitude', $listing->latitude ?? 25.1972) ?: 25.1972 }},
                            longitude: {{ old('longitude', $listing->longitude ?? 55.2744) ?: 55.2744 }},
                            name: {{ json_encode(old('name', $listing->name ?? '')) }},
                            description: {{ json_encode(old('description', $listing->description ?? '')) }},
                            bedrooms: {{ json_encode(old('bedrooms', $listing->bedrooms ?? 'Studio')) }},
                            bathrooms: {{ old('bathrooms', $listing->bathrooms ?? 1) ?: 1 }},
                            area: {{ json_encode(old('area', $listing->area ?? '')) }},
                            floor_number: {{ json_encode(old('floor_number', $listing->floor_number ?? '')) }},
                            total_floors: {{ json_encode(old('total_floors', $listing->total_floors ?? '')) }},
                            construction_year: {!! is_numeric($year = old('construction_year', $listing->construction_year ?? '')) ? $year : 'new Date().getFullYear()' !!},
                            features: {{ json_encode($featuresVal) }},
                            amenities: {{ json_encode($amenitiesVal) }},
                            photos: [],
                            video_url: {{ json_encode($listing->video_url ?? '') }},
                            payment_option: {{ json_encode(old('payment_option', $listing->payment_option ?? 'Yearly')) }},
                            utilities_option: {{ json_encode(old('utilities_option', $listing->utilities_option ?? 'Included')) }},
                            price: {{ json_encode(old('price', $listing->price ?? '')) }},
                            duration: {{ old('duration', $listing->duration ?? 30) ?: 30 }},
                            renewal_type: {{ json_encode(old('renewal_type', $listing->renewal_type ?? 'Monthly')) }}
                        },
                                                saveAsDraft() {
                                                    let form = document.getElementById('listing-creation-form');
                                                    let statusInput = document.createElement('input');
                                                    statusInput.type = 'hidden';
                                                    statusInput.name = 'status';
                                                    statusInput.value = 'Draft';
                                                    form.appendChild(statusInput);
                                                    
                                                    if (this.nextUrl) {
                                                        let redirectInput = document.createElement('input');
                                                        redirectInput.type = 'hidden';
                                                        redirectInput.name = 'redirect_to';
                                                        redirectInput.value = this.nextUrl;
                                                        form.appendChild(redirectInput);
                                                    }
                                                    form.submit();
                                                },
                                                initInterceptors() {
                                                    document.addEventListener('click', (e) => {
                                                        const link = e.target.closest('a');
                                                        if (link && !link.hasAttribute('data-no-intercept') && link.href && !link.href.startsWith('#') && !link.href.startsWith('javascript:') && !link.href.includes(window.location.pathname) && link.target !== '_blank') {
                                                            e.preventDefault();
                                                            this.nextUrl = link.href;
                                                            this.$dispatch('open-exit-listing-creation-modal', { nextUrl: this.nextUrl });
                                                        }
                                                    });
                                                }
                                             }"
                                             x-init="window.listingForm = $data; initInterceptors()"
                                             @save-as-draft="saveAsDraft()">

                    {{-- Header Area with Stepper --}}
                    <div class="max-w-[728px] mx-auto">
                        <div class="flex justify-between items-center my-[20px]">
                            <button type="button" @click="$dispatch('open-exit-listing-creation-modal', { nextUrl: null })" class="text-[14px] text-[#464646] underline decoration-solid">Save & exit</button>
                            <h1 class="text-[18px] font-medium text-[#1e1d1d] leading-[1.28] tracking-[-0.36px]" x-text="stepTitles[step]">
                                {{ isset($listing) ? 'Edit listing' : 'Create a listing' }}
                            </h1>
                            <div class="w-6">
                                <img src="{{ asset('images/info.svg') }}" alt="Info" class="w-6 h-6">
                            </div>
                        </div>

                        {{-- Stepper --}}
                        <div class="w-full bg-[#e8e8e7] h-[6px] rounded-full overflow-hidden">
                            <div class="bg-[#1447d4] h-full transition-all duration-500" :style="'width:' + (step / 10 * 100) + '%'"></div>
                        </div>
                    </div>

                    <x-modals.exit-listing-creation />

                    {{-- Content Area --}}
                    <div class="max-w-[728px] mx-auto pt-[40px] pb-[108px]">
                        {{-- Display Validation Errors --}}
                        @if ($errors->any())
                            <div class="mb-8 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-[6px]" role="alert">
                                <ul class="list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Step Components --}}
                        <div x-show="step === 1"><x-listings.create.step1 :propertyTypes="$propertyTypes" /></div>
                        <div x-show="step === 2" style="display: none;"><x-listings.create.step2 /></div>
                        <div x-show="step === 3" style="display: none;"><x-listings.create.step3 /></div>
                        <div x-show="step === 4" style="display: none;"><x-listings.create.step4 /></div>
                        <div x-show="step === 5" style="display: none;"><x-listings.create.step5 :features="$features" /></div>
                        <div x-show="step === 6" style="display: none;"><x-listings.create.step6 :amenities="$amenities" /></div>
                        <div x-show="step === 7" style="display: none;"><x-listings.create.step7 :listing="$listing ?? null" /></div>
                        <div x-show="step === 8" style="display: none;"><x-listings.create.step8 :listing="$listing ?? null" /></div>
                        <div x-show="step === 9" style="display: none;"><x-listings.create.step9 /></div>
                        <div x-show="step === 10" style="display: none;"><x-listings.create.step10 /></div>

                        {{-- Hidden inputs to bridge Alpine data with the form submission --}}
                        <div class="hidden">
                            <input type="hidden" name="property_type" x-model="formData.property_type">
                            <input type="hidden" name="address" x-model="formData.address">
                            <input type="hidden" name="latitude" x-model="formData.latitude">
                            <input type="hidden" name="longitude" x-model="formData.longitude">
                            <input type="hidden" name="name" x-model="formData.name">
                            <input type="hidden" name="description" x-model="formData.description">
                            <input type="hidden" name="bedrooms" x-model="formData.bedrooms">
                            <input type="hidden" name="bathrooms" x-model="formData.bathrooms">
                            <input type="hidden" name="area" x-model="formData.area">
                            <input type="hidden" name="floor_number" x-model="formData.floor_number">
                            <input type="hidden" name="total_floors" x-model="formData.total_floors">
                            <input type="hidden" name="construction_year" x-model="formData.construction_year">
                            <input type="hidden" name="features" :value="JSON.stringify(formData.features)">
                            <input type="hidden" name="amenities" :value="JSON.stringify(formData.amenities)">
                            <input type="hidden" name="video_url" x-model="formData.video_url">
                            <input type="hidden" name="payment_option" x-model="formData.payment_option">
                            <input type="hidden" name="utilities_option" x-model="formData.utilities_option">
                            <input type="hidden" name="price" x-model="formData.price">
                            <input type="hidden" name="duration" x-model="formData.duration">
                            <input type="hidden" name="renewal_type" x-model="formData.renewal_type">
                        </div>
                    </div>

                    {{-- Navigation Footer --}}
                    <x-listings.create.navigation />
                </div>
            </form>
        </div>
    </div>
</x-property-manager-layout>
