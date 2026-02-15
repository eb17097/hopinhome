<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a Listing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    {{-- Display Validation Errors --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Whoops! Something went wrong.</strong>
                            <ul class="mt-3 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('listings.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div x-data="{ step: 1, formData: {
                            property_type: '',
                            address: '',
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
                        } }">
                            {{-- Stepper --}}
                            <x-listings.create.stepper />

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

                            {{-- Navigation --}}
                            <div class="flex justify-between mt-8">
                                <button type="button" x-show="step > 1" @click="step--" class="bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded">
                                    Back
                                </button>
                                <button type="button" x-show="step < 10" @click="step++" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-auto">
                                    Next
                                </button>
                                <button type="submit" x-show="step === 10" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-auto">
                                    Submit Listing
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
