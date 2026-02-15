<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-listings.show.header :listing="$listing" />
                    <x-listings.show.gallery :listing="$listing" />

                    <div class="flex gap-8">
                        <div class="w-2/3">
                            <x-listings.show.details :listing="$listing" />
                            <x-listings.show.about :listing="$listing" />
                            <x-listings.show.amenities :listing="$listing" />
                            <x-listings.show.location :listing="$listing" />
                            <x-listings.show.regulatory-info :listing="$listing" />
                        </div>
                        <div class="w-1/3">
                            <x-listings.show.booking-card :listing="$listing" />
                        </div>
                    </div>

                    <x-listings.show.similar-listings />
                    <x-listings.show.faq />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
