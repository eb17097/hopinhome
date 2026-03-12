<div class="py-[38px] px-[24px]">
    <h4 class="font-medium text-gray-900 mb-[12px] text-[20px]">Popular searches</h4>
    <ul class="space-y-[12px]">
        <li><a href="{{ route('listings.search', ['location' => 'dubai', 'property_type' => 'apartment', 'bedrooms' => '2']) }}" class="text-sm text-gray-500 hover:text-blue-600 transition">2 bedroom apartments for rent in Dubai</a></li>
        <li><a href="{{ route('listings.search', ['location' => 'all', 'property_type' => 'house', 'bedrooms' => '3']) }}" class="text-sm text-gray-500 hover:text-blue-600 transition">3 bedroom houses for rent in the UAE</a></li>
        <li><a href="{{ route('listings.search', ['location' => 'dubai', 'property_type' => 'villa']) }}" class="text-sm text-gray-500 hover:text-blue-600 transition">Villas for rent in Dubai</a></li>
        <li><a href="{{ route('listings.search', ['location' => 'abu-dhabi', 'property_type' => 'apartment', 'bedrooms' => '2']) }}" class="text-sm text-gray-500 hover:text-blue-600 transition">2 bedroom apartments in Abu Dhabi</a></li>
        <li><a href="{{ route('listings.search', ['location' => 'downtown-dubai', 'property_type' => 'penthouse']) }}" class="text-sm text-gray-500 hover:text-blue-600 transition">Penthouses for rent in Downtown Dubai</a></li>
    </ul>
</div>
