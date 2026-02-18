<div>
    <h3 class="text-xl font-medium text-black">My reviews</h3>
    <div class="bg-white border border-light-gray rounded-lg shadow-sm mt-4">
        <div class="p-6 flex items-center">
            <div class="flex flex-col items-center">
                <div class="flex">
                    @for ($i = 0; $i < 5; $i++)
                        <img alt="star" class="h-7 w-7" src="{{ asset('images/star_filled.svg') }}">
                    @endfor
                </div>
                <p class="text-6xl font-medium text-electric-blue">4.7</p>
                <p class="text-sm text-gray-600">Based on 15 reviews</p>
            </div>
            <div class="border-l border-light-gray self-stretch mx-6"></div>
            <div class="flex-grow">
                <div class="flex items-center gap-2">
                    <span class="text-base font-medium text-gray-600">5</span>
                    <img alt="star" class="h-3.5 w-3.5" src="{{ asset('images/star_filled.svg') }}">
                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div class="bg-navy-blue h-1.5 rounded-full" style="width: 73%"></div>
                    </div>
                    <span class="text-base font-medium text-gray-600 w-4 text-right">11</span>
                </div>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-base font-medium text-gray-600">4</span>
                    <img alt="star" class="h-3.5 w-3.5" src="{{ asset('images/star_filled.svg') }}">
                    <div class="w-full bg-gray-200 rounded-full h-1.5">
                        <div class="bg-navy-blue h-1.5 rounded-full" style="width: 27%"></div>
                    </div>
                    <span class="text-base font-medium text-gray-600 w-4 text-right">4</span>
                </div>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-base font-medium text-gray-600">3</span>
                    <img alt="star" class="h-3.5 w-3.5" src="{{ asset('images/star_filled.svg') }}">
                    <div class="w-full bg-gray-200 rounded-full h-1.5"></div>
                    <span class="text-base font-medium text-gray-600 w-4 text-right">0</span>
                </div>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-base font-medium text-gray-600">2</span>
                    <img alt="star" class="h-3.5 w-3.5" src="{{ asset('images/star_filled.svg') }}">
                    <div class="w-full bg-gray-200 rounded-full h-1.5"></div>
                    <span class="text-base font-medium text-gray-600 w-4 text-right">0</span>
                </div>
                <div class="flex items-center gap-2 mt-1">
                    <span class="text-base font-medium text-gray-600">1</span>
                    <img alt="star" class="h-3.5 w-3.5" src="{{ asset('images/star_filled.svg') }}">
                    <div class="w-full bg-gray-200 rounded-full h-1.5"></div>
                    <span class="text-base font-medium text-gray-600 w-4 text-right">0</span>
                </div>
            </div>
        </div>
    </div>
    <div class="flex gap-2 items-center mt-6">
        <button class="bg-electric-blue text-white rounded-full px-4 py-2 text-sm">All (15)</button>
        <button class="bg-white border border-electric-blue text-electric-blue rounded-full px-4 py-2 text-sm">5 stars (11)</button>
        <button class="bg-white border border-electric-blue text-electric-blue rounded-full px-4 py-2 text-sm">4 stars (4)</button>
    </div>
    <div class="space-y-6 mt-6">
        <div class="bg-white border border-light-gray rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-start">
                <div class="flex">
                    @for ($i = 0; $i < 5; $i++)
                        <img alt="star" class="h-5 w-5" src="{{ asset('images/star_filled.svg') }}">
                    @endfor
                </div>
                <img alt="flag" class="h-6 w-6" src="{{ asset('images/flag.svg') }}">
            </div>
            <p class="text-sm text-gray-600 mt-4">Very professional and helpful throughout the application process. One small repair took a bit longer than expected, but overall I had a great experience.</p>
            <p class="font-medium text-base text-black mt-4">Emily T.</p>
            <p class="text-sm text-gray-600">June 12, 2025</p>
        </div>
        <div class="bg-white border border-light-gray rounded-lg shadow-sm p-6">
            <div class="flex justify-between items-start">
                <div class="flex">
                    @for ($i = 0; $i < 4; $i++)
                        <img alt="star" class="h-5 w-5" src="{{ asset('images/star_filled.svg') }}">
                    @endfor
                    {{-- Placeholder for empty star --}}
                    <svg class="h-5 w-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                </div>
                <img alt="flag" class="h-6 w-6" src="{{ asset('images/flag.svg') }}">
            </div>
            <p class="text-sm text-gray-600 mt-4">Sarah made the whole process stress-free. She was a bit slow to respond but explained the contract clearly, and checked in after I moved in to make sure everything was fine.</p>
            <p class="font-medium text-base text-black mt-4">James R.</p>
            <p class="text-sm text-gray-600">April 3, 2025</p>
        </div>
    </div>
</div>

