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
                    <div x-data="{ step: 1 }">
                        {{-- Stepper --}}
                        <x-listings.create.stepper />

                        {{-- Step 1 --}}
                        <div x-show="step === 1">
                            <x-listings.create.step1 />
                        </div>

                        {{-- Step 2 --}}
                        <div x-show="step === 2" style="display: none;">
                            <x-listings.create.step2 />
                        </div>

                        {{-- Step 3 --}}
                        <div x-show="step === 3" style="display: none;">
                            <x-listings.create.step3 />
                        </div>

                        {{-- Navigation --}}
                        <div class="flex justify-between mt-8">
                            <button x-show="step > 1" @click="step--" class="bg-gray-200 text-gray-700 font-bold py-2 px-4 rounded">
                                Back
                            </button>
                            <button x-show="step < 3" @click="step++" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Next
                            </button>
                            <button x-show="step === 3" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
