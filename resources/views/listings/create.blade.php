<x-property-manager-layout>
    <div class="bg-white min-h-screen">
        <div class="max-w-[1440px] mx-auto">
            
                                    <form action="{{ route('property_manager.listings.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div id="listing-form-container" 
                                             x-data="{ 
                                                step: 1, 
                                                formData: {
                                                    property_type: '',
                                                    address: '',
                                                    latitude: 25.1972,
                                                    longitude: 55.2744,
                                                    name: '',
                                                    description: '',
                                                    bedrooms: 'Studio',
                                                    bathrooms: 1,
                                                    area: '',
                                                    floor_number: '',
                                                    total_floors: '',
                                                    construction_year: new Date().getFullYear(),
                                                    features: [],
                                                    amenities: [],
                                                    photos: [],
                                                    video_url: '',
                                                    payment_option: 'Yearly',
                                                    utilities_option: 'Included',
                                                    price: '',
                                                    duration: 30,
                                                    renewal_type: 'Monthly'
                                                } 
                                             }"
                                             x-init="window.listingForm = $data">
                    
                    {{-- Header Area with Stepper --}}
                    <div class="max-w-[728px] mx-auto pt-10">
                        <div class="flex justify-between items-center mb-4">
                            <button type="button" class="text-[14px] text-[#464646] underline decoration-solid">Save & exit</button>
                            <h1 class="text-[18px] font-medium text-[#1e1d1d] tracking-[-0.36px]">Create a listing</h1>
                            <div class="w-6">
                                <img src="{{ asset('images/info.svg') }}" alt="Info" class="w-6 h-6">
                            </div>
                        </div>
                        
                        {{-- Stepper --}}
                        <div class="w-full bg-[#e8e8e7] h-[6px] rounded-full overflow-hidden">
                            <div class="bg-[#1447d4] h-full transition-all duration-500" :style="'width:' + (step / 10 * 100) + '%'"></div>
                        </div>
                    </div>

                    {{-- Content Area --}}
                    <div class="max-w-[728px] mx-auto py-16">
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
                        <div x-show="step === 7" style="display: none;"><x-listings.create.step7 /></div>
                        <div x-show="step === 8" style="display: none;"><x-listings.create.step8 /></div>
                        <div x-show="step === 9" style="display: none;"><x-listings.create.step9 /></div>
                        <div x-show="step === 10" style="display: none;"><x-listings.create.step10 /></div>

                        {{-- Hidden inputs to bridge Alpine data with the form submission --}}
                        <input type="hidden" name="features" :value="JSON.stringify(formData.features)">
                        <input type="hidden" name="amenities" :value="JSON.stringify(formData.amenities)">
                        <input type="hidden" name="latitude" :value="formData.latitude">
                        <input type="hidden" name="longitude" :value="formData.longitude">
                    </div>

                    {{-- Sticky Footer Navigation --}}
                    <div class="fixed bottom-0 left-[232px] right-0 bg-white border-t border-[#e8e8e7] h-[88px] flex items-center z-40 transition-all duration-300"
                         :class="{'left-0': !sidebarOpen}">
                        <div class="max-w-[728px] mx-auto w-full flex justify-between items-center px-4">
                            <button type="button" x-show="step > 1" @click="step--" class="flex items-center gap-2 group">
                                <img src="{{ asset('images/arrow_forward.svg') }}" alt="Back" class="w-4 h-4 transform rotate-180 opacity-60 group-hover:opacity-100 transition-opacity">
                                <span class="text-[16px] font-medium text-[#707070] group-hover:text-[#1e1d1d] transition-colors tracking-[-0.48px]">Back</span>
                            </button>
                            <div x-show="step === 1" class="w-10"></div> {{-- Spacer --}}

                            <button type="button" x-show="step < 10" @click="step++" 
                                    class="bg-[#1447d4] hover:bg-[#04247b] text-white font-medium px-10 py-2.5 rounded-full transition-all text-[16px] tracking-[-0.48px] w-[149px] h-[40px] flex items-center justify-center">
                                Next
                            </button>
                            
                            <button type="submit" x-show="step === 10" 
                                    class="bg-[#1447d4] hover:bg-[#04247b] text-white font-medium px-10 py-2.5 rounded-full transition-all text-[16px] tracking-[-0.48px] h-[40px] flex items-center justify-center">
                                Submit Listing
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-property-manager-layout>