<div class="fixed bottom-0 left-0 right-0 bg-white border-t border-light-gray shadow-lg p-4 flex justify-around items-center md:hidden">
    <a href="{{ route('dashboard') }}" class="flex flex-col items-center text-electric-blue">
        <img alt="speed" class="h-6 w-6" src="{{ asset('images/speed_sidebar.svg') }}">
        <span class="text-xs font-medium mt-1">Dashboard</span>
    </a>
    <a href="{{ route('listings.index') }}" class="flex flex-col items-center opacity-70 text-black">
        <img alt="apartment" class="h-6 w-6" src="{{ asset('images/apartment_sidebar.svg') }}">
        <span class="text-xs font-medium mt-1">Listings</span>
    </a>
    <a href="#" class="flex flex-col items-center opacity-70 text-black">
        <img alt="chat" class="h-6 w-6" src="{{ asset('images/chat_sidebar.svg') }}">
        <span class="text-xs font-medium mt-1">Messages</span>
    </a>
    <a href="#" class="flex flex-col items-center opacity-70 text-black">
        <img alt="notifications" class="h-6 w-6" src="{{ asset('images/notifications_mobile.svg') }}">
        <span class="text-xs font-medium mt-1">Notifications</span>
    </a>
    <a href="#" class="flex flex-col items-center opacity-70 text-black">
        <img alt="person" class="h-6 w-6" src="{{ asset('images/person.svg') }}">
        <span class="text-xs font-medium mt-1">Profile</span>
    </a>
</div>