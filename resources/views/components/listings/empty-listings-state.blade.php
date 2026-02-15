<div class="flex flex-col items-center justify-center py-20">
    <h3 class="text-2xl font-medium text-black tracking-tight mb-4 text-center">You have no active listings</h3>
    <p class="text-base text-gray-600 mb-8 text-center">
        Once you create a listing,<br>it will appear here.
    </p>
    <a href="{{ route('listings.create') }}" class="bg-electric-blue text-white font-medium px-8 py-3 rounded-md flex items-center space-x-2 hover:bg-blue-700 transition">
        <img alt="add" class="h-4 w-4" src="{{ asset('images/add.svg') }}">
        <span>Create a listing</span>
    </a>
</div>