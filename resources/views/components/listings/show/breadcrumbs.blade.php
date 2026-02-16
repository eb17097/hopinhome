@props(['listing'])

<nav class="text-sm text-[#464646] mb-4">
    <ol class="list-none p-0 inline-flex items-center">
        <li class="flex items-center">
            <a href="/" class="hover:underline">Home</a>
        </li>
        <li class="flex items-center">
            <img src="{{ asset('images/arrow_forward_dark_blue.svg') }}" class="h-3 w-3 mx-2" alt=">">
            <a href="#" class="hover:underline">{{ $listing->city ?? 'Dubai' }}</a>
        </li>
        <li class="flex items-center">
            <img src="{{ asset('images/arrow_forward_dark_blue.svg') }}" class="h-3 w-3 mx-2" alt=">">
            <span class="font-medium text-black">Apartments for Rent</span>
        </li>
    </ol>
</nav>
