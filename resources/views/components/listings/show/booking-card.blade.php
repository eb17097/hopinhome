@props(['listing'])

<div class="sticky top-28">
    <div class="p-6 rounded-lg shadow-lg bg-white">
        <div class="flex justify-between items-center mb-4">
            <span class="text-2xl font-semibold">AED {{ number_format($listing->price) }}</span>
            <span class="text-sm">/ Yearly</span>
        </div>

        <div class="space-y-2 text-sm text-gray-600 mb-4">
            <div class="flex justify-between">
                <span>Rental period</span>
                <span class="font-medium">Year</span>
            </div>
            <div class="flex justify-between">
                <span>Utilities</span>
                <span class="font-medium">Excluded</span>
            </div>
            <div class="flex justify-between">
                <span>Security deposit</span>
                <span class="font-medium">AED 20,000</span>
            </div>
        </div>

        <button class="w-full bg-electric-blue text-white py-3 rounded-full font-medium hover:bg-blue-700 transition">
            Send a message
        </button>
        <p class="text-xs text-gray-500 text-center mt-2">Send a message request to the property manager</p>
    </div>

    <div class="p-6 mt-4 rounded-lg shadow-lg bg-white">
        <div class="flex items-center mb-4">
            <img src="{{ asset('images/agent.png') }}" alt="Agent" class="w-16 h-16 rounded-full mr-4">
            <div>
                <h3 class="font-medium text-lg">Jane Smith</h3>
                <div class="flex items-center text-sm text-gray-500">
                    <img src="{{ asset('images/verified_user.svg') }}" alt="Verified" class="w-4 h-4 mr-1">
                    <span>Property owner</span>
                </div>
            </div>
        </div>
        <p class="text-sm text-gray-600 mb-4">This property is being rented out by the owner without an agent or real estate business.</p>
        <button class="w-full bg-white border border-gray-300 py-3 rounded-full font-medium hover:bg-gray-100 transition">
            View full profile
        </button>
    </div>
</div>
