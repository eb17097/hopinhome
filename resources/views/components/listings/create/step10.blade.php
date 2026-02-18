<div>
    <div class="flex justify-between items-start mb-2">
        <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px]">Listing publishing</h3>
        
        {{-- Credits Available Badge --}}
        <div class="bg-white border border-[#e8e8e7] rounded-[6px] px-4 py-2 flex items-center gap-3">
            <span class="text-[14px] font-medium text-[#464646]">Listing credits available</span>
            <div class="flex items-center gap-1">
                <span class="text-[18px] font-medium text-[#1e1d1d]">12</span>
                <img src="{{ asset('images/toll.svg') }}" alt="Toll" class="w-[22px] h-[22px]">
            </div>
        </div>
    </div>
    <p class="text-[16px] text-[#464646] mb-8">Set up publishing settings.</p>

    <input type="hidden" name="duration" x-model="formData.duration">
    <input type="hidden" name="renewal_type" x-model="formData.renewal_type">

    <div class="space-y-10">
        {{-- Listing Duration --}}
        <div>
            <label class="block text-[18px] font-medium text-[#1e1d1d] mb-1">Listing duration</label>
            <p class="text-[16px] text-[#464646] mb-6">Choose the total amount of days to show this listing before having to extend it.</p>
            
            <div class="grid grid-cols-3 gap-4">
                @foreach([30, 60, 90] as $duration)
                <div @click="formData.duration = {{ $duration }}" 
                     :class="{'border-[#1447d4] bg-white shadow-md': formData.duration === {{ $duration }}, 'border-[#e8e8e7] bg-white': formData.duration !== {{ $duration }} }" 
                     class="border rounded-[6px] p-6 text-center cursor-pointer transition-all hover:border-[#1447d4] relative group">
                    
                    {{-- Credit count badge --}}
                    <div class="absolute top-2 right-2 flex items-center gap-0.5 opacity-60">
                        <span class="text-[12px] font-medium">{{ $duration / 30 }}</span>
                        <img src="{{ asset('images/toll_gray.svg') }}" alt="" class="w-[13px] h-[13px]">
                    </div>

                    <p class="text-[20px] font-medium text-[#1e1d1d] mb-1">{{ $duration }} days</p>
                    <p class="text-[14px] text-[#464646]">
                        @switch($duration)
                            @case(30) Standard @break
                            @case(60) Extended @break
                            @case(90) Long term @break
                        @endswitch
                    </p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Renewal Settings --}}
        <div>
            <label class="block text-[18px] font-medium text-[#1e1d1d] mb-1">Renewal settings</label>
            <p class="text-[16px] text-[#464646] mb-6">Listing renewal acts as a republished listing that counts as published today.</p>
            
            <div class="grid grid-cols-3 gap-4">
                @foreach(['Monthly', 'Bi-weekly', 'Weekly'] as $type)
                <div @click="formData.renewal_type = '{{ $type }}'" 
                     :class="{'border-[#1447d4] bg-white shadow-md': formData.renewal_type === '{{ $type }}', 'border-[#e8e8e7] bg-white': formData.renewal_type !== '{{ $type }}'}" 
                     class="border rounded-[6px] p-6 text-center cursor-pointer transition-all hover:border-[#1447d4] relative group">
                    
                    {{-- Multiplier badge --}}
                    <div class="absolute top-2 right-2 opacity-60">
                        <span class="text-[12px] font-medium">x{{ $type === 'Monthly' ? '1' : ($type === 'Bi-weekly' ? '2' : '4') }}</span>
                    </div>

                    <p class="text-[20px] font-medium text-[#1e1d1d] mb-1">{{ $type }}</p>
                    <p class="text-[14px] text-[#464646]">
                        @switch($type)
                            @case('Monthly') 1 credit / mo. @break
                            @case('Bi-weekly') 2 credits / mo. @break
                            @case('Weekly') 4 credits / mo. @break
                        @endswitch
                    </p>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Total Cost Summary --}}
        <div class="pt-6 border-t border-[#e8e8e7] flex justify-between items-center">
            <span class="text-[18px] font-medium text-[#1e1d1d]">Listing cost</span>
            <div class="flex items-center gap-2">
                <span class="text-[22px] font-medium text-[#1e1d1d]" 
                      x-text="(formData.duration / 30) * (formData.renewal_type === 'Monthly' ? 1 : (formData.renewal_type === 'Bi-weekly' ? 2 : 4))">
                    0
                </span>
                <img src="{{ asset('images/toll.svg') }}" alt="Toll" class="w-[22px] h-[22px]">
            </div>
        </div>
    </div>
</div>