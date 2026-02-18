<div>
    <h3 class="text-[20px] font-medium text-[#1e1d1d] tracking-[-0.4px]">My reviews</h3>
    
    {{-- Summary Card --}}
    <div class="bg-white border border-[#e8e8e7] rounded-[8px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] mt-4 h-[233px] flex">
        <div class="w-1/3 flex flex-col items-center justify-center p-6">
            <div class="flex mb-2">
                @for ($i = 0; $i < 5; $i++)
                    <img alt="star" class="w-[28px] h-[28px]" src="{{ asset('images/star_filled.svg') }}">
                @endfor
            </div>
            <p class="text-[64px] font-medium text-[#1447d4] leading-[1.3]">4.7</p>
            <p class="text-[14px] font-medium text-[#464646] tracking-tight">Based on 15 reviews</p>
        </div>
        
        <div class="border-l border-[#e8e8e7] h-full"></div>
        
        <div class="flex-1 p-6 flex flex-col justify-center space-y-2">
            {{-- 5 Stars --}}
            <div class="flex items-center gap-3">
                <span class="text-[16px] font-medium text-[#464646] w-3">5</span>
                <img alt="star" class="w-[14px] h-[14px]" src="{{ asset('images/star_filled.svg') }}">
                <div class="flex-1 bg-[#d9d9d9] rounded-full h-[5px] relative">
                    <div class="bg-[#04247b] h-full rounded-full" style="width: 73%"></div>
                </div>
                <span class="text-[16px] font-medium text-[#464646] w-4 text-right">11</span>
            </div>
            {{-- 4 Stars --}}
            <div class="flex items-center gap-3">
                <span class="text-[16px] font-medium text-[#464646] w-3">4</span>
                <img alt="star" class="w-[14px] h-[14px]" src="{{ asset('images/star_filled.svg') }}">
                <div class="flex-1 bg-[#d9d9d9] rounded-full h-[5px] relative">
                    <div class="bg-[#04247b] h-full rounded-full" style="width: 27%"></div>
                </div>
                <span class="text-[16px] font-medium text-[#464646] w-4 text-right">4</span>
            </div>
            {{-- 3 Stars --}}
            <div class="flex items-center gap-3">
                <span class="text-[16px] font-medium text-[#464646] w-3">3</span>
                <img alt="star" class="w-[14px] h-[14px]" src="{{ asset('images/star_filled.svg') }}">
                <div class="flex-1 bg-[#d9d9d9] rounded-full h-[5px]"></div>
                <span class="text-[16px] font-medium text-[#464646] w-4 text-right">0</span>
            </div>
            {{-- 2 Stars --}}
            <div class="flex items-center gap-3">
                <span class="text-[16px] font-medium text-[#464646] w-3">2</span>
                <img alt="star" class="w-[14px] h-[14px]" src="{{ asset('images/star_filled.svg') }}">
                <div class="flex-1 bg-[#d9d9d9] rounded-full h-[5px]"></div>
                <span class="text-[16px] font-medium text-[#464646] w-4 text-right">0</span>
            </div>
            {{-- 1 Star --}}
            <div class="flex items-center gap-3">
                <span class="text-[16px] font-medium text-[#464646] w-3">1</span>
                <img alt="star" class="w-[14px] h-[14px]" src="{{ asset('images/star_filled.svg') }}">
                <div class="flex-1 bg-[#d9d9d9] rounded-full h-[5px]"></div>
                <span class="text-[16px] font-medium text-[#464646] w-4 text-right">0</span>
            </div>
        </div>
    </div>
    
    {{-- Filter Buttons --}}
    <div class="flex gap-2 items-center mt-8">
        <button class="bg-[#1447d4] text-white rounded-full px-4 py-2 text-[14px]">All (15)</button>
        <button class="bg-white border border-[#1447d4] text-[#1447d4] rounded-full px-4 py-2 text-[14px]">5 stars (11)</button>
        <button class="bg-white border border-[#1447d4] text-[#1447d4] rounded-full px-4 py-2 text-[14px]">4 stars (4)</button>
    </div>
    
    {{-- Review List --}}
    <div class="space-y-4 mt-6">
        {{-- Review 1 --}}
        <div class="bg-white border border-[#e8e8e7] rounded-[8px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] p-8">
            <div class="flex justify-between items-start">
                <div class="flex gap-0.5">
                    @for ($i = 0; $i < 5; $i++)
                        <img alt="star" class="w-[21px] h-[21px]" src="{{ asset('images/star_filled.svg') }}">
                    @endfor
                </div>
                <img alt="flag" class="w-[25px] h-[25px]" src="{{ asset('images/flag.svg') }}">
            </div>
            <p class="text-[14px] text-[#464646] mt-6 leading-[1.5]">Very professional and helpful throughout the application process. One small repair took a bit longer than expected, but overall I had a great experience.</p>
            <div class="mt-6">
                <p class="font-medium text-[16px] text-[#1e1d1d] leading-[1.3]">Emily T.</p>
                <p class="text-[14px] text-[#464646] leading-[1.5]">June 12, 2025</p>
            </div>
        </div>
        
        {{-- Review 2 --}}
        <div class="bg-white border border-[#e8e8e7] rounded-[8px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] p-8">
            <div class="flex justify-between items-start">
                <div class="flex gap-0.5">
                    @for ($i = 0; $i < 4; $i++)
                        <img alt="star" class="w-[21px] h-[21px]" src="{{ asset('images/star_filled.svg') }}">
                    @endfor
                    <img alt="star" class="w-[21px] h-[21px] opacity-20" src="{{ asset('images/star_filled.svg') }}">
                </div>
                <img alt="flag" class="w-[25px] h-[25px]" src="{{ asset('images/flag.svg') }}">
            </div>
            <p class="text-[14px] text-[#464646] mt-6 leading-[1.5]">Sarah made the whole process stress-free. She was a bit slow to respond but explained the contract clearly, and checked in after I moved in to make sure everything was fine.</p>
            <div class="mt-6">
                <p class="font-medium text-[16px] text-[#1e1d1d] leading-[1.3]">James R.</p>
                <p class="text-[14px] text-[#464646] leading-[1.5]">April 3, 2025</p>
            </div>
        </div>
    </div>
</div>

