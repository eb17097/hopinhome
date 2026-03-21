<div>
    <div class="flex justify-between items-start">
        <div>
            <h3 class="text-[22px] font-medium text-[#1e1d1d] tracking-[-0.44px] mb-2">Listing publishing</h3>
            <p class="text-[16px] text-[#464646] mb-8">Set up publishing settings.</p>
        </div>
        {{-- Credits Available Badge --}}
        <div class="h-[54px] w-[276px] justify-between bg-[#F9F9F8] rounded-[6px] px-4 py-2 flex items-center gap-3">
            <span class="leading-[1.5] text-[14px] font-medium text-[#1E1D1D]">Listing credits available</span>
            <div class="flex items-center gap-1">
                <span class="text-[18px] font-medium text-[#1e1d1d]">12</span>
                <img src="{{ asset('images/toll.svg') }}" alt="Toll" class="w-[22px] h-[22px]">
            </div>
        </div>
    </div>

    <input type="hidden" name="duration" x-model="formData.duration">
    <input type="hidden" name="renewal_type" x-model="formData.renewal_type">

    <div class="space-y-10">
        {{-- Listing Duration --}}
        <div>
            <label class="block text-[16px] font-medium text-[#1e1d1d] mb-1">Listing duration</label>
            <p class="text-[16px] text-[#464646] mb-[20px]">Choose the total amount of days to show this listing before having to extend it.</p>

            <div class="grid grid-cols-3 gap-4">
                @foreach([30, 60, 90] as $duration)
                <div @click="formData.duration = {{ $duration }}"
                     :class="{'border-[#1447d4] bg-white shadow-md': formData.duration === {{ $duration }}, 'border-[#e8e8e7] bg-white': formData.duration !== {{ $duration }} }"
                     class="h-[96px] border rounded-[6px] px-[24px] pb-[24px] pt-[22px] text-center cursor-pointer transition-all hover:border-[#1447d4] relative group">

                    {{-- Credit count badge --}}
                    <div class="absolute top-[4px] right-[8px] flex items-center gap-0.5">
                        <span class="text-[16px] font-medium leading-[1.3]"
                              :class="formData.duration === {{ $duration }} ? 'text-[#1447d4]' : 'text-[#464646]'">
                            {{ $duration / 30 }}
                        </span>
                        <img :src="formData.duration === {{ $duration }} ? '{{ asset('images/toll_blue.svg') }}' : '{{ asset('images/toll_gray.svg') }}'"
                             alt="" class="w-[13px] h-[13px]">
                    </div>

                    <p class="leading-[1.5] text-[20px] font-medium text-[#1e1d1d]">{{ $duration }} days</p>
                    <p class="leading-[1.5] text-[14px] text-[#464646]">
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
            <label class="block text-[16px] font-medium text-[#1e1d1d] mb-1">Renewal settings</label>
            <p class="text-[16px] text-[#464646] mb-[20px]">Listing renewal acts as a republished listing that counts as published today.</p>

            <div class="grid grid-cols-3 gap-4">
                @foreach(['Monthly', 'Bi-weekly', 'Weekly'] as $type)
                <div @click="formData.renewal_type = '{{ $type }}'"
                     :class="{'border-[#1447d4] bg-white shadow-md': formData.renewal_type === '{{ $type }}', 'border-[#e8e8e7] bg-white': formData.renewal_type !== '{{ $type }}'}"
                     class="h-[96px] border rounded-[6px] px-[24px] pb-[24px] pt-[22px] text-center cursor-pointer transition-all hover:border-[#1447d4] relative group">

                    {{-- Multiplier badge --}}
                    <span class="absolute top-[4px] right-[8px] text-[16px] leading-[1.3] font-medium transition-colors"
                          :class="formData.renewal_type === '{{ $type }}' ? 'text-[#1447d4]' : 'text-[#464646] opacity-80'">
                        x{{ $type === 'Monthly' ? '1' : ($type === 'Bi-weekly' ? '2' : '4') }}
                    </span>

                    <p class="leading-[1.5] text-[20px] font-medium text-[#1e1d1d]">{{ $type }}</p>
                    <p class="leading-[1.5] text-[14px] text-[#464646]">
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
        <div class="flex justify-between items-center">
            <span class="text-[20px] font-medium text-[#1e1d1d]">Listing cost</span>
            <div class="flex items-center gap-2">
                <div class="text-[20px] font-medium tracking-[-0.4px]">
                    <span class="text-[#707070]">
                        <span x-text="formData.duration / 30">1</span>
                        x
                        <span x-text="formData.renewal_type === 'Monthly' ? 1 : (formData.renewal_type === 'Bi-weekly' ? 2 : 4)">1</span>
                        =
                    </span>
                    <span class="text-[#1e1d1d]"
                          x-text="(formData.duration / 30) * (formData.renewal_type === 'Monthly' ? 1 : (formData.renewal_type === 'Bi-weekly' ? 2 : 4))">
                        0
                    </span>
                </div>
                <img src="{{ asset('images/toll.svg') }}" alt="Toll" class="w-[22px] h-[22px]">
            </div>
        </div>
    </div>
</div>
