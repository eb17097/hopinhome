<div class="bg-white border border-[#e8e8e7] rounded-[6px] shadow-[0px_1px_6px_0px_rgba(0,0,0,0.08)] p-6">
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-[18px] font-medium text-[#1e1d1d] tracking-[-0.36px]">Setup checklist</h3>
        <div class="flex items-center gap-3">
            <span class="text-[14px] text-[#464646]">3/4</span>
            <div class="w-[110px] bg-[#e8e8e7] rounded-full h-[6px] relative">
                <div class="bg-[#1447d4] h-full rounded-full" style="width: 75%"></div>
            </div>
        </div>
    </div>
    
    <div class="space-y-3">
        <div class="bg-[#f9f9f8] rounded-[4px] h-[55px] px-4 flex items-center gap-4">
            <img alt="checkmark" class="w-[23px] h-[23px]" src="{{ asset('images/checkmark.svg') }}">
            <span class="font-medium text-[16px] text-[#1e1d1d]">Verify your email address</span>
        </div>
        
        <div class="bg-[#f9f9f8] rounded-[4px] h-[55px] px-4 flex items-center gap-4">
            <img alt="checkmark" class="w-[23px] h-[23px]" src="{{ asset('images/checkmark.svg') }}">
            <span class="font-medium text-[16px] text-[#1e1d1d]">Write a bio</span>
        </div>
        
        <div class="bg-[#f9f9f8] rounded-[4px] h-[55px] px-4 flex items-center gap-4">
            <img alt="checkmark" class="w-[23px] h-[23px]" src="{{ asset('images/checkmark.svg') }}">
            <span class="font-medium text-[16px] text-[#1e1d1d]">Upload a profile photo</span>
        </div>
        
        <div class="bg-white border border-[#e8e8e7] rounded-[4px] h-[73px] px-4 flex items-center gap-4">
            <div class="w-[23px] h-[23px] rounded-full border border-[#e8e8e7]"></div>
            <div class="flex-grow">
                <span class="font-medium text-[16px] text-[#1e1d1d]">Enable notifications</span>
                <p class="text-[14px] text-[#464646]">Stay updated on messages & news</p>
            </div>
            <img alt="info" class="w-[22px] h-[22px]" src="{{ asset('images/info.svg') }}">
        </div>
    </div>
    
    <div class="text-center mt-6">
        <button class="text-[14px] text-[#464646] underline decoration-solid">Hide completed steps</button>
    </div>
</div>

