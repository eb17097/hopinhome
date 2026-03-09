@props(['listing'])

<x-modal name="report-listing" maxWidth="xl">
    <div x-data="{
        step: 1,
        reason: '',
        comment: '',
        reasons: [
            'Incorrect information',
            'Scam or fraud',
            'Duplicate listing',
            'A different reason'
        ],
        reset() {
            this.step = 1;
            this.reason = '';
            this.comment = '';
        },
        submit() {
            // Here you would typically make an AJAX request to save the report
            this.step = 3;
        }
    }"
    x-on:close-modal.window="if($event.detail == 'report-listing') setTimeout(() => reset(), 500)"
    class="bg-white rounded-[14px] overflow-hidden"
    >
        {{-- Modal Header --}}
        <div class="flex items-center justify-between px-[24px] py-[21px] border-b border-[#E8E8E7]">
            <button @click="$dispatch('close-modal', 'report-listing')" class="p-1 hover:bg-gray-100 rounded-full transition-colors">
                <img src="{{ asset('images/close_blue.svg') }}" alt="Close" class="w-[25px] h-[25px]">
            </button>
            <h2 class="text-[18px] font-medium text-black leading-[1.28] tracking-[-0.36px]" x-text="step === 3 ? 'Report submitted' : 'Report this listing'"></h2>
            <div class="w-[20px]"></div> {{-- Spacer for centering --}}
        </div>

        {{-- Modal Content --}}
        <div class="px-[24px] py-[40px]">

            {{-- Step 1: Why are you reporting? --}}
            <template x-if="step === 1">
                <div>
                    <h3 class="text-[20px] tracking-[-0.4px] leading-[1.28] font-medium text-black mb-[4px]">Why are you reporting this listing?</h3>
                    <p class="text-[14px] text-gray-500 mb-[16px]">Reports aren’t shared with listing owners.</p>

                    <div class="flex flex-col gap-[16px]">
                        <template x-for="r in reasons" :key="r">
                            <button
                                @click="reason = r"
                                :class="reason === r ? 'border-electric-blue bg-white' : 'border-[#E8E8E7] bg-white'"
                                class="flex items-center justify-between px-[16px] py-[20px] border rounded-[10px] text-left transition-all group"
                            >
                                <span class="text-[16px] text-black" x-text="r"></span>
                                <div class="w-[24px] h-[24px]">
                                    <template x-if="reason === r">
                                        <img src="{{ asset('images/white_checkmark_on_blue.svg') }}" class="w-full h-full">
                                    </template>
                                    <template x-if="reason !== r">
                                        <div class="w-full h-full rounded-full border border-[#E8E8E7]"></div>
                                    </template>
                                </div>
                            </button>
                        </template>
                    </div>
                </div>
            </template>

            {{-- Step 2: Please tell us more --}}
            <template x-if="step === 2">
                <div>
                    <h3 class="text-[20px] font-medium text-black mb-[4px] leading-[1.28] tracking-[-0.4px]">Please tell us more</h3>
                    <p class="text-[14px] text-gray-500 mb-[16px]">Any extra information will help us make this a safer platform for everyone.</p>

                    <textarea
                        x-model="comment"
                        placeholder="Write your comment here..."
                        class="w-full h-[320px] p-[24px] border border-[#E8E8E7] rounded-[10px] focus:ring-electric-blue focus:border-electric-blue text-[16px] placeholder:text-gray-400 resize-none"
                    ></textarea>
                </div>
            </template>

            {{-- Step 3: We've Received Your Report --}}
            <template x-if="step === 3">
                <div class="py-[16px]">
                    <div class="flex items-center gap-[6px] mb-[12px]">
                        <h3 class="text-[20px] font-medium text-black">We’ve Received Your Report</h3>
                        <img src="{{ asset('images/check_circle_small.svg') }}" class="w-[20px] h-[20px]">
                    </div>
                    <p class="text-[16px] leading-[1.5] text-gray-600 leading-relaxed">
                        Thank you for helping keep HopInHome safe and transparent. Our team will review your report and take action if needed.
                    </p>
                </div>
            </template>

        </div>

        {{-- Modal Footer --}}
        <div class="px-[24px] py-[22px] border-t border-[#E8E8E7] flex items-center justify-between">
            <div>
                <template x-if="step === 2">
                    <button @click="step = 1" class="flex items-center gap-[8px] text-gray-500 hover:text-black transition-colors">
                        <img src="{{ asset('images/arrow_back_gray.svg') }}" class="w-[16px] h-[16px]">
                        <span class="text-[16px] font-medium">Back</span>
                    </button>
                </template>
            </div>

            <div>
                <template x-if="step === 1">
                    <button
                        @click="step = 2"
                        :disabled="!reason"
                        :class="!reason ? 'opacity-50 cursor-not-allowed' : 'hover:bg-opacity-90'"
                        class="leading-[1.22] tracking-[-0.48px] h-[40px] w-[149px] bg-electric-blue text-white rounded-full text-[16px] font-medium transition-all"
                    >
                        Next
                    </button>
                </template>

                <template x-if="step === 2">
                    <button
                        @click="submit()"
                        class="bg-electric-blue text-white h-[40px] w-[149px] leading-[1.22] tracking-[-0.48px] rounded-full text-[16px] font-medium hover:bg-opacity-90 transition-all"
                    >
                        Submit report
                    </button>
                </template>

                <template x-if="step === 3">
                    <button
                        @click="$dispatch('close-modal', 'report-listing')"
                        class="bg-electric-blue text-white w-[149px] h-[40px] rounded-full text-[16px] font-medium hover:bg-opacity-90 transition-all"
                    >
                        OK
                    </button>
                </template>
            </div>
        </div>
    </div>
</x-modal>
