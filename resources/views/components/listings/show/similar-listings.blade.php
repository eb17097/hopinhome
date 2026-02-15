<div class="mt-16">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-3xl font-medium text-gray-900">Explore similar properties</h2>
        <a href="#" class="text-electric-blue font-medium">View more properties like this</a>
    </div>
    <div class="grid grid-cols-3 gap-8">
        {{-- In a real app, you would loop through actual similar listings --}}
        @for ($i = 0; $i < 3; $i++)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="https://via.placeholder.com/400x250" alt="Listing" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="font-medium text-lg">Cozy apartment with great views</h3>
                    <p class="text-sm text-gray-500">Down Town rd 2, Dubai</p>
                    <div class="flex items-center gap-4 mt-2 text-sm text-gray-600">
                        <span>861 sqft</span>
                        <span>2 beds</span>
                        <span>1 bath</span>
                    </div>
                    <div class="mt-4">
                        <span class="font-semibold text-xl">AED 200,000</span>
                        <span class="text-sm">/ Yearly</span>
                    </div>
                </div>
            </div>
        @endfor
    </div>
</div>
